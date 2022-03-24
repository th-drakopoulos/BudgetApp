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
}