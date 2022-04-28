<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_delete_categories()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $this->deleteJson(route('api.categories.destroy', $category))
            ->assertNoContent();

        $this->assertDatabaseCount('categories', 0);
    }
}
