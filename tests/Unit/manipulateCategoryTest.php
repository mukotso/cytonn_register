<?php

namespace Tests\Unit;

use Tests\TestCase;

class manipulateCategoryTest extends TestCase
{
    public function test_guest_user_cannot_view_categories_page()
    {
        $response = $this->get('/categories');
        $response->assertRedirect('/login');
    }
    public function test_authenticated_user_can_view_categories_page()
    {
        $this->signIn();
        $response = $this->get('/categories');
        $response->assertSuccessful();
        $response->assertViewIs('categories.index');
    }

    public function test_authenticated_user_can_create_categories()
    {
        $this->signIn();
        $category=create('App\Models\Category');
        $this->get('/categories')->assertSee($category->name);
    }

    public function test_guest_user_cannot_create_departments()
    {
        create('App\Models\Category');
        $this->get('/categories')
            ->assertRedirect('/login');
    }

}

