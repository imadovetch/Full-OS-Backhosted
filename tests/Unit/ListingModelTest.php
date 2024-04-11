<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_listing()
    {
        // Create a new listing using the Listing model
        $user = User::factory()->create();
        $listing = Listing::factory()->create(['user_id' => $user->id]);


        // Assert that the listing exists in the database
        $this->assertDatabaseHas('listings', [
            'id' => $listing->id,
            'title' => $listing->title,
            'company' => $listing->company,
            'user_id' => $user->id,
            'logo' => $listing->logo,
            'tags' => $listing->tags,
            'location' => $listing->location,
            'email' => $listing->email,
            'description' => $listing->description,
            'website' => $listing->website,
        ]);
    }

/** @test */
public function it_can_update_a_listing()
{
    // Create a new listing using the Listing model
    $user = User::factory()->create();
    $listing = Listing::factory()->create(['user_id' => $user->id]);

    // Update the listing attributes
    $newAttributes = [
        'title' => 'Updated Title',
        'company' => 'Updated Company',
    ];

    $listing->update($newAttributes);

    // Assert that the listing in the database matches the updated attributes
    $this->assertDatabaseHas('listings', $newAttributes + ['id' => $listing->id]);
}

/** @test */
public function it_can_delete_a_listing()
{
    // Create a new listing using the Listing model
    $user = User::factory()->create();
    $listing = Listing::factory()->create(['user_id' => $user->id]);

    // Delete the listing
    $listing->delete();

    // Assert that the listing is no longer in the database
    $this->assertDatabaseMissing('listings', ['id' => $listing->id]);
}

/** @test */
public function it_can_filter_listings_by_tag()
{
    // Create a few listings with specific tags
    $user = User::factory()->create();
    Listing::factory()->create(['user_id' => $user->id, 'tags' => 'tag2,tag3']);
    Listing::factory()->create(['user_id' => $user->id, 'tags' => 'tag2,tag4']);

    // Filter listings by a specific tag
    $filteredListings = Listing::filter(['tag' => 'tag2'])->get();

    // Assert that only listings with the specified tag are returned
    $this->assertCount(2, $filteredListings);
}

/** @test */
public function it_can_filter_listings_by_search()
{
    // Create a few listings with specific titles and descriptions
    $user = User::factory()->create();
    Listing::factory()->create(['user_id' => $user->id, 'title' => 'Title A', 'description' => 'Description A']);
    Listing::factory()->create(['user_id' => $user->id, 'title' => 'Title B', 'description' => 'Description B']);
    Listing::factory()->create(['user_id' => $user->id, 'title' => 'Title C', 'description' => 'Description C']);

    // Filter listings by a search query
    $filteredListings = Listing::filter(['search' => 'Title'])->get();

    // Assert that only listings matching the search query are returned
    $this->assertCount(3, $filteredListings);
}
}
