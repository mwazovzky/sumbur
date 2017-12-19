<?php

namespace Tests\Feature;

use App\Order;
use App\Furniture;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdersApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function auhtenticated_user_can_fetch_orders()
    {
        // Given we have a signed in user
        $this->signIn();
        // .. and an order
        $order = factory(Order::class)->create([
            'process' => 'Установка мебели',
            'status' => 'Новая заявка',
        ]);
        // When we fetch orders
        $response = $this->get(route('orders.index'));
        // Then we see the order's data
        $response->assertStatus(200)
            ->assertSee($order->process)
            ->assertSee($order->status)
            ->assertSee($order->furniture->name);
    }

    /** @test */
    public function auhtenticated_user_can_create_order()
    {
        // Given we have a signed in user
        $this->signIn();
        // When we make a post request
        $order = factory(Order::class)->make();

        $this->post(route('orders.store'), $order->toArray())->assertStatus(200);
        // Then new order is created
        $this->assertDatabaseHas('orders', [
            'status' => $order->status,
            'process' => $order->process,
            'furniture_id' => $order->furniture_id,
        ]);
    }

    /** @test */
    public function admin_can_update_order_status()
    {
        $this->withoutExceptionHandling();
        // Given we have a user logged in as admin
        $this->loginAdmin();
        // .. and an order
        $order = factory(Order::class)->create(['status' => 'Новая заявка']);
        // When we make a patch request
        $this->patch(route('orders.update', $order), [
            'status' => 'Выполнение'
        ])->assertStatus(200);
        // Then the order staus is updated
        $this->assertEquals('Выполнение', $order->fresh()->status);
    }
}
