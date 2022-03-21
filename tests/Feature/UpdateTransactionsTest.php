<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UpdateTransactionsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     *
     * @return void
     */
    public function it_can_update_transactions()
    {
        $category = Category::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $transaction = Transaction::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $newTransaction = Transaction::factory()->make(
            [
                'user_id' => $this->user->id,
                'category_id' => $category->id,
            ]
        );

        $this->put("/transactions/{$transaction->id}", $newTransaction->toArray())->assertRedirect('/transactions');

        $this->get('/transactions')->assertSee($newTransaction->description);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cannot_update_transactions_without_a_description()
    {
        $this->updateTransaction(['description' => null])->assertSessionHasErrors('description');
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cannot_update_transactions_without_a_category()
    {
        $this->updateTransaction(['category_id' => null])->assertSessionHasErrors('category_id');
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cannot_update_transactions_without_an_amount()
    {
        $this->updateTransaction(['amount' => null])->assertSessionHasErrors('amount');
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cannot_update_transactions_without_a_valid_amount()
    {
        $this->updateTransaction(['amount' => 'abc'])->assertSessionHasErrors('amount');
    }

    public function updateTransaction($overrides = [])
    {
        $transaction = Transaction::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $newTransaction = Transaction::factory()->make(
            array_merge(['user_id' => $this->user->id], $overrides)
        );
        return $this->withExceptionHandling()->put("/transactions/{$transaction->id}", $newTransaction->toArray());

    }
}