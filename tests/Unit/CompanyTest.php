<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_company()
    {
        $companyData = [
            'name' => 'Test Company',
            'email' => 'test@company.com',
            'logo' => 'logos/test.png',
            'website' => 'http://testcompany.com',
        ];

        $company = Company::create($companyData);

        $this->assertDatabaseHas('companies', $companyData);
    }

    /** @test */
    public function it_can_read_a_company()
    {
        $company = Company::factory()->create();

        $foundCompany = Company::find($company->id);

        $this->assertEquals($company->name, $foundCompany->name);
    }

    /** @test */
    public function it_can_update_a_company()
    {
        $company = Company::factory()->create();

        $updateData = [
            'name' => 'Updated Company Name',
            'email' => 'updated@company.com',
        ];

        $company->update($updateData);

        $this->assertDatabaseHas('companies', $updateData);
    }

    /** @test */
    public function it_can_delete_a_company()
    {
        $company = Company::factory()->create();

        $company->delete();

        $this->assertSoftDeleted($company);
    }
}
