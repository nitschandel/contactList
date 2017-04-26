<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContactTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function get_user()
    {
    	$user = factory(User::class)->create(array('uuid' => ''));

    	return $user;
    }

    public function testCreate()
    {
    	$response = $this->actingAs($this->get_user())->json('GET', '/contacts/create');

    	$response
            ->assertStatus(200);
    }

    public function testStore()
    {

    	$response = $this->actingAs($this->get_user())->json('POST', '/contacts', ['name' => 'Test Contact','email' => rand().'@test.com','phone' => '1234567890','dob' => '1990-01-01','address' => 'Test Address','organization' => 'Test Company','gender' => 'male']);

        $response
            ->assertStatus(302)
            ->assertRedirect('/contacts/create')
            ->assertSessionMissing('error')
            ->assertSessionHas('success');
    }
}
