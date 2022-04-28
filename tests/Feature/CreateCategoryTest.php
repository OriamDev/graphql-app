<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_categories()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson(route('api.categories.create'), [
           'data' => [
               'type' => 'categories',
               'attributes' => [
                   'name' => 'New Category',
                   'status' => 1
               ]
           ]
       ]);

        $response->assertCreated();

        $category = Category::first();

        $response->assertExactJson([
            'data' => [
                'type' => 'categories',
                'id' => (string)$category->getRouteKey(),
                'attributes' => [
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'status' => $category->status
                ],
                'links' => [
                    'self' => route('api.categories.show', $category)
                ]
            ]
        ]);
    }
}
