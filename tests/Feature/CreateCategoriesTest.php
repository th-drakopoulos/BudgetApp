<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateCategoriesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function it_can_create_categories()
    {
        $category = Category::factory()->make(
            [
                'user_id' => $this->user->id,
            ]
        );

        $this->post('/categories', $category->toArray())->assertRedirect('/categories');

        $this->get('/categories')->assertSee($category->name);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cannot_create_categories_without_a_name()
    {
        $this->postCategory(['name' => null])->assertSessionHasErrors('name');
    }

    public function postCategory($overrides = [])
    {
        $category = Category::factory()->make($overrides);
        return $this->withExceptionHandling()->post('/categories', $category->toArray());
    }
}