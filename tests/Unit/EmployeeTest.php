<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_employee()
    {
        $company = Company::factory()->create();

        $employeeData = [
            'firstname' => 'Test',
            'lastname' => 'Employee',
            'company_id' => $company->id,
            'email' => 'test@employee.com',
            'phone' => '1234567890',
        ];

        $employee = Employee::create($employeeData);

        $this->assertDatabaseHas('employees', $employeeData);
    }

    /** @test */
    public function it_can_read_an_employee()
    {
        $employee = Employee::factory()->create();

        $foundEmployee = Employee::find($employee->id);

        $this->assertEquals($employee->firstname, $foundEmployee->firstname);
    }

    /** @test */
    public function it_can_update_an_employee()
    {
        $employee = Employee::factory()->create();

        $updateData = [
            'firstname' => 'Updated Name',
            'lastname' => 'Updated Lastname',
        ];

        $employee->update($updateData);

        $this->assertDatabaseHas('employees', $updateData);
    }

    /** @test */
    public function it_can_delete_an_employee()
    {
        $employee = Employee::factory()->create();

        $employee->delete();

        $this->assertSoftDeleted($employee);
    }
}
