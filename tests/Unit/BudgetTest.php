<?php

namespace Tests\Unit;

use App\Models\Budget;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class BudgetTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     *
     * @return void
     */
    public function it_has_a_balance()
    {
        $category = Category::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $transactions = Transaction::factory(3)->create(
            [
                'user_id' => $this->user->id,
                'category_id' => $category->id,
            ]
        );
        $budget = Budget::factory()->create(
            [
                'user_id' => $this->user->id,
                'category_id' => $category->id,
            ]
        );

        $expectedBalance = $budget->amount - $transactions->sum('amount');

        $this->assertEquals($expectedBalance, $budget->balance());

    }
}