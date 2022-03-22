<?php
namespace Tests\Feature;

use App\Models\Budget;
use App\Models\Category;
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