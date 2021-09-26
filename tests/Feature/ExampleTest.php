<?php

namespace Tests\Feature;

use Carbon\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {

        //* route testing *//
        // $response = $this->get('/');
        // $response->assertStatus(200);

        // $response = $this->get('/p-login');
        // $response->assertStatus(200);

        // $response = $this->get('/a-login');
        // $response->assertStatus(200);



        //* after login routes *//
        // $response = $this->get('/d')
        //     ->assertRedirect('/');
        // $response = $this->get('/p')
        //     ->assertRedirect('/');
        // $response = $this->get('/a/dashboard')
        //     ->assertRedirect('/a-login');


        //* after login routes *//
        // $this->actingAs(Factory()->create)






    }






}
