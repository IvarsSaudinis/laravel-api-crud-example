<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use App\Models\User;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_basic_request_to_list_products()
    {

        $this->seed();

        Sanctum::actingAs(User::factory()->create(), ['*']);

        $response = $this->json('GET', route('product.index'));

        $response->assertStatus(200);

    }

    public function test_basic_request_to_list_one_products()
    {
        $this->seed();

        Sanctum::actingAs(User::factory()->create(), ['*']);

        $response = $this->json('GET', route('product.show', ['product' => 1]));

        $response->assertStatus(200);

    }

    public function test_basic_request_to_create_product()
    {

        Sanctum::actingAs(User::factory()->create(), ['*']);

        $response = $this->json('POST', route('product.store'),[
            'name' => 'new name',
            'description' => 'new description'
        ]);

        $response->assertStatus(201);

    }
    public function test_basic_request_to_update_product()
    {
        $this->seed();

        Sanctum::actingAs(User::factory()->create(), ['*']);

        $response = $this->json('PUT', route('product.update', ['product' => 1 ]),[
            'name' => 'new name',
            'description' => 'new description'
        ]);

        $response->assertStatus(200);
    }

    public function test_basic_request_to_delete_product()
    {
        $this->seed();

        Sanctum::actingAs(User::factory()->create(), ['*']);

        $response = $this->json('DELETE', route('product.update', ['product' => 1 ]));

        $response->assertStatus(200);
    }
}
