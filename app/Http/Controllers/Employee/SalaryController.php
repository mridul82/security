<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\Salary;
use App\Models\AdvancePayment;

class SalaryController extends Controller
{
    public function index(Employee $employee)
    {
        $salaries = $employee->salaries()->latest()->paginate(10);
        return view('salaries.index', compact('employee', 'salaries'));
    }

    public function store(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'effective_date' => 'required|date'
        ]);

        $previousSalary = $employee->salaries()->latest()->first();
        
        $salary = new Salary([
            'amount' => $validated['amount'],
            'effective_date' => $validated['effective_date'],
            'previous_amount' => $previousSalary ? $previousSalary->amount : null,
            'increment_amount' => $previousSalary ? $validated['amount'] - $previousSalary->amount : null
        ]);

        $employee->salaries()->save($salary);

        return redirect()->route('employees.salaries.index', $employee)
            ->with('success', 'Salary updated successfully');
    }

    public function processMonthly(Employee $employee)
    {
        // Get pending advances
        $pendingAdvances = $employee->advances()
            ->where('status', 'pending')
            ->get();

        $currentSalary = $employee->salaries()->latest()->first();
        $netSalary = $currentSalary->amount;

        // Deduct advances
        foreach ($pendingAdvances as $advance) {
            $netSalary -= $advance->amount;
            $advance->update(['status' => 'deducted']);
        }

        // Store salary payment record
        // Add your salary payment logic here

        return redirect()->back()->with('success', 'Monthly salary processed successfully');
    }

    public function salaries()
    {
        $salaries = Salary::query()
            ->with('employee') 
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('salaries')
                    ->groupBy('employee_id');
            })
            ->get();
       // dd($salaries);
        return view('salaries.viewall', compact('salaries'));
    }
}
