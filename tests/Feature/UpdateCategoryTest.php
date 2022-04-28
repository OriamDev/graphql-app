<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_update_categories()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $response = $this->patchJson(route('api.categories.update', $category), [
            'data' => [
                'type' => 'categories',
                'attributes' => [
                    'name' => $category->name,
                    'status' => 1
                ]
            ]
        ]);

        $response->assertOk();

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
