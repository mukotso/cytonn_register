<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class manipulateDepartmentTest extends TestCase
{
//    use RefreshDatabase;
    public function test_authenticated_user_can_view_departments_page()
    {
        $this->signIn();
        $response = $this->get('/departments');
        $response->assertSuccessful();
        $response->assertViewIs('departments.index');
    }

    public function test_authenticated_user_can_create_departments()
    {
        $this->signIn();
        $department=create('App\Models\Department');
        $this->get('/departments')->assertSee($department->name);
    }

    public function test_guest_user_cannot_create_departments()
    {
        create('App\Models\Department');
        $this->get('/departments')
            ->assertRedirect('/login');
    }

}

