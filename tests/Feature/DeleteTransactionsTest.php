<?php

namespace Tests\Feature;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DeleteTransactionsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     *
     * @return void
     */
    public function it_can_delete_transactions()
    {
        $transaction = Transaction::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );

        $this->delete("/transactions/{$transaction->id}")->assertRedirect('/transactions');

        $this->get('/transactions')->assertDontSee($transaction->description);
    }
}