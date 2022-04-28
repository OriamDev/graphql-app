<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_fetch_a_single_category()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $this->getJson(route('api.categories.show', $category))
        ->assertExactJson([
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

    /** @test */
    public function can_fetch_all_categories()
    {
        $this->withoutExceptionHandling();

        $categories = Category::factory()->count(3)->create();

        $this->getJson(route('api.categories.index'))->assertExactJson([
            'data' => [
                [
                    'type' => 'categories',
                    'id' => (string) $categories[0]->getRouteKey(),
                    'attributes' => [
                        'name' => $categories[0]->name,
                        'slug' => $categories[0]->slug,
                        'status' => $categories[0]->status
                    ],
                    'links' => [
                        'self' => route('api.categories.show', $categories[0])
                    ]
                ],
                [
                    'type' => 'categories',
                    'id' => (string) $categories[1]->getRouteKey(),
                    'attributes' => [
                        'name' => $categories[1]->name,
                        'slug' => $categories[1]->slug,
                        'status' => $categories[1]->status
                    ],
                    'links' => [
                        'self' => route('api.categories.show', $categories[1])
                    ]
                ],
                [
                    'type' => 'categories',
                    'id' => (string) $categories[2]->getRouteKey(),
                    'attributes' => [
                        'name' => $categories[2]->name,
                        'slug' => $categories[2]->slug,
                        'status' => $categories[2]->status
                    ],
                    'links' => [
                        'self' => route('api.categories.show', $categories[2])
                    ]
                ]
            ],
            'links' => [
                'self' => route('api.categories.index')
            ]
        ]);
    }
}
