<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    protected $password = '123456';

    public function get_email()
    {
    	$email = 'test'.rand().'@test.com';
    	return $email;	
    }  

    public function testSignUp()
    {
    	$response = $this->json('POST', '/signup', ['name' => 'New Test','email' => $this->get_email(),'password' => $this->password,'confirmPassword' => $this->password]);

        $response
            ->assertStatus(302)
            ->assertRedirect('/');
    }

    public function testLogin()
    {
        $response = $this->json('POST', '/signin', ['email' => 'test@test.com','password' => $this->password]);

        $response
            ->assertStatus(302)
            ->assertRedirect('/contacts');
    }
}
