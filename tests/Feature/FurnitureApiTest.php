<?php

namespace Tests\Feature;

use App\Furniture;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FurnitureApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_fetch_furniture_catalog()
    {
        // Given we have a signed in user
        $this->signIn();
        // .. and a furniture item
        $furniture = factory(Furniture::class)->create([
            'name' => 'Order Name',
            'description' => 'Order Description',
        ]);
        // When we fetch furniture catalog index
        $response = $this->get(route('furniture.index'));
        // Then we see the item's name and description
        $response->assertStatus(200)
            ->assertSee('Order Name')
            ->assertSee('Order Description');
    }

    /** @test */
    public function auhtenticated_user_can_create_furniture_catalog_item()
    {
        // Given we have a user logged in as admin
        $this->loginAdmin();
        // When we make a post request
        $furniture = factory(Furniture::class)->make();
        $this->post(route('furniture.store'), $furniture->toArray())
            ->assertStatus(200);
        // Then new furniture item is created
        $this->assertDatabaseHas('furniture', [
            'name' => $furniture->name,
            'description' => $furniture->description,
        ]);
    }

    /** @test */
    public function auhtenticated_user_can_update_furniture_catalog_item()
    {
        // Given we have a user logged in as admin
        $this->loginAdmin();
        // .. and a furniture item
        $furniture = factory(Furniture::class)->create();
        // When we make a patch request
        $this->patch(route('furniture.update', $furniture), [
            'name' => 'Updated Name',
            'description' => 'Updated Description',
        ])->assertStatus(200);
        // Then the furniture item is updated
        tap($furniture->fresh(), function ($item) {
            $this->assertEquals('Updated Name', $item->name);
            $this->assertEquals('Updated Description', $item->description);
        });
    }

    /** @test */
    public function auhtenticated_user_can_delete_furniture_catalog_item()
    {
        // Given we have a user logged in as admin
        $this->loginAdmin();
        // .. and a furniture item
        $furniture = factory(Furniture::class)->create();
        $this->assertDatabaseHas('furniture', [
            'name' => $furniture->name,
            'description' => $furniture->description,
        ]);
        // When we make a delete request
        $this->delete(route('furniture.destroy', $furniture))
            ->assertStatus(204);
        // Then the furniture item is deleted
        $this->assertDatabaseMissing('furniture', [
            'name' => $furniture->name,
            'description' => $furniture->description,
        ]);
    }
}
