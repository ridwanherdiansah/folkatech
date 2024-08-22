<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployMail;

class EmployeeController extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('employees.index', compact('employees'));
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }

    // Menyimpan data baru
    public function store(StoreEmployeeRequest $request)
    {
        try {
            $data = $request->validated();
            $employee = Employee::create($data);

            // Cek jika company terkait memiliki email
            if ($employee->company && $employee->company->email) {
                $companyAdminEmail = $employee->company->email;

                // Kirim email notifikasi
                Mail::to($companyAdminEmail)->send(new EmployMail([
                    'name' => $employee->name,
                    'email' => $employee->email,
                ]));
            }

            return redirect()->route('employees.index')->with('success', 'success');
        } catch (\Exception $e) {
            return redirect()->route('companies.index')->with('error', 'Failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    // Menampilkan form untuk mengedit data
    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    // Mengupdate data
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        try {
            // Mengambil data yang sudah divalidasi dari UpdateEmployeeRequest
            $data = $request->validated();

            // Menggunakan metode update untuk memperbarui data employee yang ada
            $employee->update($data);

            return redirect()->route('employees.index')->with('success', 'success');
        } catch (\Exception $e) {
            return redirect()->route('employees.index')->with('error', 'failed');
        }
    }

    // Menghapus data
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return redirect()->route('employees.index')->with('success', 'success');
        } catch (\Exception $e) {
            return redirect()->route('employees.index')->with('error', 'failed');
        }
    }
}
