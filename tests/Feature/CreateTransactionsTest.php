<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateTransactionsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     *
     * @return void
     */
    public function it_can_create_transactions()
    {
        $category = Category::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $transaction = Transaction::factory()->make(
            [
                'user_id' => $this->user->id,
                'category_id' => $category->id,
            ]
        );

        $this->post('/transactions', $transaction->toArray())->assertRedirect('/transactions');

        $this->get('/transactions')->assertSee($transaction->description);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cannot_create_transactions_without_a_description()
    {
        $this->postTransaction(['description' => null])->assertSessionHasErrors('description');
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cannot_create_transactions_without_a_category()
    {
        $this->postTransaction(['category_id' => null])->assertSessionHasErrors('category_id');
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cannot_create_transactions_without_an_amount()
    {
        $this->postTransaction(['amount' => null])->assertSessionHasErrors('amount');
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_cannot_create_transactions_without_a_valid_amount()
    {
        $this->postTransaction(['amount' => 'abc'])->assertSessionHasErrors('amount');
    }

    public function postTransaction($overrides = [])
    {
        $transaction = Transaction::factory()->make($overrides);
        return $this->withExceptionHandling()->post('/transactions', $transaction->toArray());
    }

}