<?php
namespace Tests\Feature;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateBudgetsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function it_can_create_budgets()
    {
        $category = Category::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $budget = Budget::factory()->make(
            [
                'user_id' => $this->user->id,
                'category_id' => $category->id,
            ]
        );

        $this->post('/budgets', $budget->toArray())->assertRedirect('/budgets');

        $this->get('/budgets')->assertSee((string) $budget->amount);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cannot_create_budgets_without_a_category()
    {
        $this->postBudget(['category_id' => null])->assertSessionHasErrors('category_id');
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cannot_create_budgets_without_an_amount()
    {
        $this->postBudget(['amount' => null])->assertSessionHasErrors('amount');
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cannot_create_budgets_without_a_budget_date()
    {
        $this->postBudget(['budget_date' => null])->assertSessionHasErrors('budget_date');
    }

    public function postBudget($overrides = [])
    {
        $budget = Budget::factory()->make($overrides);
        return $this->withExceptionHandling()->post('/budgets', $budget->toArray());
    }
}