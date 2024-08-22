<?php

namespace Tests\Feature;

use App\Mail\EmployeeAddedNotification;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_employee_and_send_notification()
    {
        // Fake email sending
        Mail::fake();

        // Create a company to associate with the employee
        $company = Company::factory()->create([
            'email' => 'adityamustofa20@gmail.com'
        ]);

        // Data untuk pembuatan employee
        $data = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'company_id' => $company->id,
            'email' => 'bubuyyybuyyy@gmail.com',
            'phone' => '1234567890'
        ];

        // Kirim request POST untuk membuat employee baru
        $response = $this->post(route('employees.store'), $data);

        // Pastikan employee telah dibuat
        $this->assertDatabaseHas('employees', $data);

        // Cek bahwa email telah dikirim
        Mail::assertSent(EmployeeAddedNotification::class, function ($mail) use ($company) {
            // Pastikan email yang dikirim adalah untuk email admin perusahaan
            return $mail->employee->company->email === 'adityamustofa20@gmail.com';
        });

        // Verifikasi redirect
        $response->assertRedirect(route('employees.index'));
        $response->assertSessionHas('success', 'Employee created successfully.');
    }
}
