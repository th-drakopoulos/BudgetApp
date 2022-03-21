<?php
namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DeleteCategoriesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function it_can_delete_categories()
    {
        $category = Category::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );

        $this->delete("/categories/{$category->slug}")->assertRedirect('/categories');

        $this->get('/categories')->assertDontSee($category->name);
    }
}