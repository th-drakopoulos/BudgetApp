<?php

namespace Tests\Feature;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UpdateBudgetsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function it_can_update_budgets()
    {
        $category = Category::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $budget = Budget::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $newBudget = Budget::factory()->make(
            [
                'user_id' => $this->user->id,
                'category_id' => $category->id,
            ]
        );

        $this->put("/budgets/{$budget->id}", $newBudget->toArray())->assertRedirect('/budgets');

        $this->get('/budgets')->assertSee($newBudget->description);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cannot_update_budgets_without_a_category()
    {
        $this->updateBudget(['category_id' => null])->assertSessionHasErrors('category_id');
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cannot_update_budgets_without_an_amount()
    {
        $this->updateBudget(['amount' => null])->assertSessionHasErrors('amount');
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cannot_update_budgets_without_a_budget_date()
    {
        $this->updateBudget(['budget_date' => null])->assertSessionHasErrors('budget_date');
    }

    public function updateBudget($overrides = [])
    {
        $budget = Budget::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $newBudget = Budget::factory()->make(
            array_merge(['user_id' => $this->user->id], $overrides)
        );
        return $this->withExceptionHandling()->put("/budgets/{$budget->id}", $newBudget->toArray());

    }
}