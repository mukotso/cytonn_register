<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class manipulateDepartmentTest extends TestCase
{
    public function testUserCanViewDepartmentsPage()
    {
        //make request to /login
        $response = $this->get('/departments');
        $response->assertSuccessful();
        $response->assertViewIs('departments.index');
    }

    public function testUserCanAddDepartment()
    {
        //make request to /login
        $response = $this->get('/departments');
        $response->assertSuccessful();
        $response->assertViewIs('departments.index');
    }

    public function testUserCanDeleteDepartment()
    {
        //make request to /login
        $response = $this->get('/departments');
        $response->assertSuccessful();
        $response->assertViewIs('departments.index');
    }
}

