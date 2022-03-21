<?php
namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UpdateCategoriesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function it_can_update_categories()
    {
        $category = Category::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $newCategory = Category::factory()->make(
            [
                'user_id' => $this->user->id,
            ]
        );

        $this->put("/categories/{$category->slug}", $newCategory->toArray())->assertRedirect('/categories');

        $this->get('/categories')->assertSee($newCategory->name);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cannot_update_categories_without_a_name()
    {
        $this->updateCategory(['name' => null])->assertSessionHasErrors('name');
    }

    public function updateCategory($overrides = [])
    {
        $category = Category::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $newCategory = Category::factory()->make(
            array_merge(['user_id' => $this->user->id], $overrides)
        );
        return $this->withExceptionHandling()
            ->put("/categories/{$category->slug}", $newCategory
                    ->toArray());
    }
}