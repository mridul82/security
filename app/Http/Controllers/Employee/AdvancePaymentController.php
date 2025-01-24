<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\AdvancePayment;
use App\Models\Salary;


class AdvancePaymentController extends Controller
{
    public function index(Employee $employee)
    {
        $advances = $employee->advances()->latest()->paginate(10);
        $totalPendingAdvance = $employee->advances()
            ->where('status', 'pending')
            ->sum('amount');
        $currentSalary = $employee->salaries()->latest()->first()?->amount ?? 0;

        return view('advances.index', compact('employee', 'advances', 'totalPendingAdvance', 'currentSalary'));
    }

    public function store(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'date' => 'required|date|before_or_equal:today',
        ]);

        // Get current salary and total pending advances
        $currentSalary = $employee->salaries()->latest()->first()?->amount ?? 0;
        $pendingAdvances = $employee->advances()
            ->where('status', 'pending')
            ->sum('amount');

        // Check if total advances (including new one) exceeds current salary
        if (($pendingAdvances + $validated['amount']) > $currentSalary) {
            return back()->withErrors([
                'amount' => 'Total advances cannot exceed current salary of ' . number_format($currentSalary, 2)
            ])->withInput();
        }

        $advance = new AdvancePayment([
            'amount' => $validated['amount'],
            'date' => $validated['date'],
            'status' => 'pending'
        ]);

        $employee->advances()->save($advance);

        return redirect()->route('employees.advances.index', $employee)
            ->with('success', 'Advance payment recorded successfully');
    }
    public function update(Request $request, Employee $employee, AdvancePayment $advance)
    {
        if ($advance->status === 'deducted') {
            return back()->withErrors(['status' => 'Cannot modify a deducted advance payment']);
        }

        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'date' => 'required|date|before_or_equal:today',
        ]);

        // Calculate total pending advances excluding current advance
        $pendingAdvances = $employee->advances()
            ->where('status', 'pending')
            ->where('id', '!=', $advance->id)
            ->sum('amount');

        $currentSalary = $employee->salaries()->latest()->first()?->amount ?? 0;

        // Check if total advances (including updated one) exceeds current salary
        if (($pendingAdvances + $validated['amount']) > $currentSalary) {
            return back()->withErrors([
                'amount' => 'Total advances cannot exceed current salary of ' . number_format($currentSalary, 2)
            ])->withInput();
        }

        $advance->update($validated);

        return redirect()->route('employees.advances.index', $employee)
            ->with('success', 'Advance payment updated successfully');
    }

    public function destroy(Employee $employee, AdvancePayment $advance)
    {
        if ($advance->status === 'deducted') {
            return back()->withErrors(['status' => 'Cannot delete a deducted advance payment']);
        }

        $advance->delete();

        return redirect()->route('employees.advances.index', $employee)
            ->with('success', 'Advance payment deleted successfully');
    }
}
