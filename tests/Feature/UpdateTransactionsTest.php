<?php

namespace Tests\Feature;

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
        $transaction = Transaction::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $newTransaction = Transaction::factory()->make(
            [
                'user_id' => $this->user->id,
            ]
        );

        $this->put("/transactions/{$transaction->id}", $newTransaction->toArray())->assertRedirect('/transactions');

        $this->get('/transactions')->assertSee($newTransaction->description);
    }
}