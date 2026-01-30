<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductControllerTest extends TestCase
{
	use WithoutMiddleware;

	public function testIndexReturnProducts(){

		$response = $this->get(route('product.index'));

		$response->assertStatus(200);
		$response->assertViewHas('products');
		$products = $response->viewData('products');
		$this->assertNotEmpty($products);

	}

	public function testCreateProductsSuccessfully(){
		$data = [
			'name' => 'Test Product1',
			'price' => 100,
			'picture' => 'products/onghuttre.jpg',
			'weight' => 15,
			'description' => 'Test description',
			'discount' => 10,
			'category_id' => 1,
			'inventory_quantity' => 50,
		];

		$response = $this->post(route('product.store'), $data); 

		$response->assertRedirect(route('product.index'));

		$this->assertDatabaseHas('products',['total_price'=>90],);

	}

	public function testFailWhenRequireFieldMissing(){
		$response = $this->post(route('product.store'), []);		
		$response->assertSessionHasErrors([
			'name',
			'price',
		]);
	}

	public function testFailWhenNameIsNotUnique(){
		$response = $this->post(route('product.store'), [
            'name' => 'minima',
            'price' => 100,
            'category_id' => 1,
            'inventory_quantity' => 10,
        ]);
        $response->assertSessionHasErrors('name');
	}


}
