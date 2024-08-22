<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies.index', compact('companies'));
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        return view('companies.create');
    }

    // Menyimpan data baru
    public function store(StoreCompanyRequest $request)
    {
        try {
            $data = $request->validated();
            
            // Cek apakah ada file logo yang diupload
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('logos', 'public');
                $data['logo'] = $logoPath;
            }

            Company::create($data);

            return redirect()->route('companies.index')->with('success', 'Success');
        } catch (\Exception $e) {
            return redirect()->route('companies.index')->with('error', 'Failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    // Menampilkan form untuk mengedit data
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    // Mengupdate data
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        try {
            // Mengambil data yang sudah divalidasi dari UpdateEmployeeRequest
            $data = $request->validated();

            // Periksa apakah ada file logo yang diupload
            if ($request->hasFile('logo')) {
                // Hapus logo lama jika ada
                if ($company->logo && \Storage::exists($company->logo)) {
                    \Storage::delete($company->logo);
                }

                // Simpan file yang diupload dan dapatkan path-nya
                $logoPath = $request->file('logo')->store('logos', 'public');

                // Tambahkan path logo ke data yang akan diupdate
                $data['logo'] = $logoPath;
            }

            // Menggunakan metode update untuk memperbarui data employee yang ada
            $company->update($data);

            return redirect()->route('companies.index')->with('success', 'success');
        } catch (\Exception $e) {
            return redirect()->route('companies.index')->with('error', 'failed');
        }
    }


    // Menghapus data
    public function destroy(Company $company)
    {
        try {
            $company->delete(); // Melakukan soft delete
            return redirect()->route('companies.index')->with('success', 'success');
        } catch (\Exception $e) {
            return redirect()->route('companies.index')->with('error', 'failed');
        }
    }
}
