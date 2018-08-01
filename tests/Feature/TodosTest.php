<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodosTest extends TestCase
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
    function guests_may_not_create_a_todo()
    {
        $user = factory('App\User')->create();
        
        $this->json('POST', route('todos.store'))
            ->assertStatus(401);
    }

    /** @test */
    function a_task_requires_a_body()
    {
        $this->actingAs(factory('App\User')->create())
            ->json('POST', route('todos.store'), ['body' => null])
            ->assertJsonValidationErrors(['body']);   
    }

    /** @test */
    function a_user_can_complete_a_todo()
    {
        $user = factory('App\User')->create();

        $todo = factory('App\Todo')->create([
            'owner_id' => $user->id
        ]);

        $this->actingAs($user)
            ->json('GET', route('todos.complete', $todo))
            ->assertStatus(200);

        $this->assertTrue($todo->fresh()->completed);    
    }

    /** @test */
    function a_user_can_update_the_body_of_a_todo()
    {
        $user = factory('App\User')->create();

        $todo = factory('App\Todo')->create([
            'owner_id' => $user->id
        ]);  

        $newBody = 'This todo was updated.';

        $this->actingAs($user)
            ->json('PUT', route('todos.update', $todo), [ 'body' => $newBody ])
            ->assertStatus(200);

        $this->assertEquals($newBody, $todo->fresh()->body);
    }

    /** @test */
    function a_user_can_delete_a_todo()
    {
        $user = factory('App\User')->create();

        $todo = factory('App\Todo')->create([
            'owner_id' => $user->id
        ]);

        $this->actingAs($user)
            ->json('DELETE', route('todos.destroy', $todo))
            ->assertStatus(200);

        $this->assertDatabaseMissing('todos', $todo->toArray());
    }
}
