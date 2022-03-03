<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{

    /** @test */
    public function test_user_can_view_login_form()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_user_cannot_view_login_form_when_authenticated()
    {
        $user = factory('App\Models\User')->make();
        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');
    }

    public function test_user_login_with_correct_credentials()
    {
        $password = "myPassword@2020";
        $user = factory('App\Models\User')->create([
            'password' => bcrypt($password),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }


    public function test_cannot_login_if_user_dont_exist()
    {

        $response = $this->post(route('login'), [
                'email' => 'funn@gmail.com',
                'password' => 'mastercard',
            ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_user_logout()
    {
        $user =factory('App\Models\User')->create();
        $this->be($user);
        $this->post(route('logout'));
        $this->assertGuest();
    }


}
