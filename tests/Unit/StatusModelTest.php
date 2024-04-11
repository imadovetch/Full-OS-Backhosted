<?php

namespace Tests\Unit;

use App\Models\Status;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_status()
    {
        // Create a new user and listing
        $user = User::factory()->create();
        $listing = Listing::factory()->create(['user_id' => $user->id]);

        // Create a new status using the Status model
        $status = Status::create([
            'applied' => 'yes',
            'listing_id' => $listing->id,
            'user_id' => $user->id,
            'applied_on' => now(),
        ]);

        // Assert that the status exists in the database
        $this->assertDatabaseHas('status', [
            'id' => $status->id,
            'applied' => 'yes',
            'listing_id' => $listing->id,
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function it_can_retrieve_related_user()
    {
        // Create a new user and listing
        $user = User::factory()->create();
        $listing = Listing::factory()->create(['user_id' => $user->id]);

        // Create a new status using the Status model
        $status = Status::create([
            'applied' => 'yes',
            'listing_id' => $listing->id,
            'user_id' => $user->id,
            'applied_on' => now(),
        ]);

        // Retrieve the user associated with the status
        $retrievedUser = $status->user;

        // Assert that the retrieved user matches the original user
        $this->assertEquals($user->id, $retrievedUser->id);
    }

    /** @test */
    public function it_can_retrieve_related_listing()
    {
        // Create a new user and listing
        $user = User::factory()->create();
        $listing = Listing::factory()->create(['user_id' => $user->id]);

        // Create a new status using the Status model
        $status = Status::create([
            'applied' => 'yes',
            'listing_id' => $listing->id,
            'user_id' => $user->id,
            'applied_on' => now(),
        ]);

        // Retrieve the listing associated with the status
        $retrievedListing = $status->listing;

        // Assert that the retrieved listing matches the original listing
        $this->assertEquals($listing->id, $retrievedListing->id);
    }

}
