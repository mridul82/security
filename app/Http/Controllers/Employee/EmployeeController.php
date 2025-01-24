<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Models\Salary;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
         // Validate the request
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'relative_phone_number' => 'required|string|max:20',
            'permanent_address' => 'required|string',
            'present_address' => 'required|string',
            'district' => 'required|string',
            'date_of_joining' => 'required|date',
            'registration_fee' => 'required|numeric|min:0',
            'photo' => 'required|image|max:700', // Max size in KB
            'documents' => 'nullable|array',
            'documents.*' => 'file|mimes:jpeg,png,pdf|max:2048',
        ]);
    
        // Check for duplicate entry
        $duplicate = Employee::where('phone_number', $validated['phone_number'])
            ->orWhere('relative_phone_number', $validated['relative_phone_number'])
            ->first();
    
        if ($duplicate) {
            return back()
                ->withInput()
                ->withErrors(['phone_number' => 'An employee with the same phone number or relative\'s phone number already exists.']);
        }
    
        // Create employee
        $employee = Employee::create($validated);
    
        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photosize = $photo->getSize();
    
            // Check size manually
            if ($photo->getSize() > 700 * 1024) { // 700KB
                return back()
                    ->withInput()
                    ->withErrors(['photo' => 'The photo must not be larger than 700KB.']);
            }
    
            // Define the target directory and filename
            $photoDirectory = public_path('uploads/employee_photos/' . $employee->id);
            if (!is_dir($photoDirectory)) {
                mkdir($photoDirectory, 0777, true);
            }
            $photoFilename = $photo->getClientOriginalName();
            $photo->move($photoDirectory, $photoFilename);
    
            // Save photo information to the database
            EmployeeDocument::create([
                'employee_id' => $employee->id,
                'type' => 'photo',
                'file_path' => 'uploads/employee_photos/' . $employee->id . '/' . $photoFilename,
                'file_name' => $photoFilename,
                'mime_type' => $photo->getClientOriginalExtension(), // Use extension as MIME type
                'file_size' => $photosize,
            ]);
        }
    
        // Handle document uploads
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $index => $document) {
                $docsize = $document->getSize();
                // Check size manually
                if ($document->getSize() > 2 * 1024 * 1024) { // 2MB
                    return back()
                        ->withInput()
                        ->withErrors(['documents' => 'Each document must not be larger than 2MB.']);
                }
    
                // Define the target directory and filename
                $documentDirectory = public_path('uploads/employee_documents/' . $employee->id);
                if (!is_dir($documentDirectory)) {
                    mkdir($documentDirectory, 0777, true);
                }
                $documentFilename = $document->getClientOriginalName();
                $document->move($documentDirectory, $documentFilename);
    
                // Save document information to the database
                EmployeeDocument::create([
                    'employee_id' => $employee->id,
                    'type' => 'document',
                    'title' => $request->document_titles[$index] ?? null,
                    'file_path' => 'uploads/employee_documents/' . $employee->id . '/' . $documentFilename,
                    'file_name' => $documentFilename,
                    'mime_type' => $document->getClientOriginalExtension(), // Use extension as MIME type
                    'file_size' => $docsize,
                ]);
            }
        }
    
        return redirect()->route('employees')
            ->with('success', 'Employee created successfully');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    public function show($id)
    {
        $employee = Employee::with('documents')->findOrFail($id);
        //dd($employee);
        return view('employees.show', compact('employee'));
    }
}
