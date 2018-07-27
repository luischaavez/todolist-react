<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function an_authorized_user_can_create_a_todo()
    {
        $user = factory('App\User')->create();
        
        $this->actingAs($user)
            ->json('POST', route('todos.store'), [ 'body' => 'Do the work' ]);

        $this->assertDatabaseHas('todos', [
            'body' => 'Do the work'
        ]);    
    }

    /** @test */
    function an_unauthorized_user_cannot_create_a_todo()
    {
        $user = factory('App\User')->create();
        
        $this->json('POST', route('todos.store'))
            ->assertStatus(401);
    }
}
