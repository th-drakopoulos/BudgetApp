<?php
namespace Tests\Feature;

use App\Models\Budget;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewBudgetsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function it_allows_only_authenticated_users_to_the_budgets_list()
    {
        $this->signOut()->withExceptionHandling()->get('/budgets')->assertRedirect('/login');
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_only_displays_budgets_that_belong_to_the_currently_logged_in_user()
    {
        $category = Category::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $otherUser = User::factory()->create();
        $budget = Budget::factory()->create(
            [
                'user_id' => $this->user->id,
                'category_id' => $category->id,
            ]
        );
        $otherBudget = Budget::factory()->create(
            [
                'user_id' => $otherUser->id,
            ]
        );
        $this->get('/budgets')
            ->assertSee((string) $budget->amount)
            ->assertDontSee((string) $otherBudget->amount);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_should_display_budgets_for_the_current_month_by_default()
    {
        $category = Category::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $budgetForThisMonth = Budget::factory()->create(
            [
                'user_id' => $this->user->id,
                'category_id' => $category->id,
            ]
        );
        $budgetForLastMonth = Budget::factory()->create(
            [
                'user_id' => $this->user->id,
                'budget_date' => Carbon::now()->subMonth(),
                'category_id' => $category->id,
            ]
        );

        $this->get('/budgets')
            ->assertSee((string) $budgetForThisMonth->amount)
            ->assertSee((string) $budgetForThisMonth->balance())
            ->assertDontSee((string) $budgetForLastMonth->amount)
            ->assertDontSee((string) $budgetForLastMonth->balance());
    }
}