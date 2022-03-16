<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewCategoriesTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     *
     * @return void
     */
    public function it_can_display_all_categories()
    {
        $category = Category::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $this->get('/categories')->assertSee($category->name);

    }

    /**
     * @test
     *
     * @return void
     */
    public function it_allows_only_authenticated_users()
    {
        $this->signOut()->withExceptionHandling()->get('/transactions')->assertRedirect('/login');
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_only_displays_categories_that_belong_to_the_currently_logged_in_user()
    {
        $otherUser = User::factory()->create();
        $category = Category::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $otherCategory = Category::factory()->create(
            [
                'user_id' => $otherUser->id,
            ]
        );
        $this->get('/categories')
            ->assertSee($category->name)
            ->assertDontSee($otherCategory->name);
    }

}