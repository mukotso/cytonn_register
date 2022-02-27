<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;


class LoginTest extends TestCase
{

    public function testUserCanViewLoginForm()
    {
        //make request to /login
        $response = $this->get('/login');
        //if request successful
        //check if we have served the correct view
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function testUserCannotViewLoginFormWhenAuthenticated()
    {
        $user = factory('App\Models\User')->make();
        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');
    }

    public function testUserLoginWithCorrectCredentials()
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


    public function testCannotLoginIfUserDontExist()
    {

        $response = $this->post(route('login'), [
                'email' => 'funn@gmail.com',
                'password' => 'mastercard',
            ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function testUserLogout()
    {
        $user =factory('App\Models\User')->create();
        $this->be($user);
        $this->post(route('logout'));
        $this->assertGuest();
    }


}
