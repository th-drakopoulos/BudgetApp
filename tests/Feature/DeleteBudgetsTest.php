<?php
namespace Tests\Feature;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DeleteBudgetsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function it_can_delete_budgets()
    {
        $category = Category::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $budget = Budget::factory()->create(
            [
                'user_id' => $this->user->id,
                'category_id' => $category->id,
            ]
        );

        $this->delete("/budgets/{$budget->id}")->assertRedirect('/budgets');

        $this->get('/budgets')->assertDontSee((string) $budget->amount);
    }
}