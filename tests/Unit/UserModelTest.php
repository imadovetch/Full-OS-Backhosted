<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class UserModelTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    

    use RefreshDatabase; // This trait is used to reset the database after running tests

    /** @test */
    public function it_can_create_a_user()
    {
        // Create a new user using the User model
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
