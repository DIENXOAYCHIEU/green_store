<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductControllerTest extends TestCase
{

	public function testIndexReturnProducts(){

		$response = $this->get(route('product.index'));

		$response->assertStatus(200);
		$response->assertViewHas('products');
		$products = $response->viewData('products');
		$this->assertNotEmpty($products);

	}
}
