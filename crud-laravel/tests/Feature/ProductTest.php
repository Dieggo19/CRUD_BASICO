<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function puede_crear_un_producto()
    {
        $response = $this->postJson('/products', [
            'name'  => 'Cerveza',
            'price' => 2500,
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['nombre' => 'Cerveza']);
    }

    #[Test]
    public function puede_listar_productos()
    {
        Product::factory()->create(['name' => 'Mankeke', 'price' => 1500]);

        $response = $this->getJson('/products');

        $response->assertStatus(200)
                 ->assertJsonFragment(['nombre' => 'Mankeke']);
    }

    #[Test]
    public function puede_ver_un_producto()
    {
        $product = Product::factory()->create(['name' => 'Pepsi', 'price' => 1200]);

        $response = $this->getJson("/products/{$product->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['nombre' => 'Pepsi']);
    }

    #[Test]
    public function puede_actualizar_un_producto()
    {
        $product = Product::factory()->create(['name' => 'Agua', 'price' => 1000]);

        $response = $this->putJson("/products/{$product->id}", [
            'price' => 2000,
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['precio' => 2000]);
    }

    #[Test]
    public function puede_eliminar_un_producto()
    {
        $product = Product::factory()->create(['name' => 'CocaCola', 'price' => 1800]);

        $response = $this->deleteJson("/products/{$product->id}");

        $response->assertStatus(204);
    }
}
