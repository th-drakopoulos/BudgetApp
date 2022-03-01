<?php

namespace Tests\Feature;

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
        $transaction = Transaction::factory()->make();

        $this->post('/transactions', $transaction->toArray())->assertRedirect('/transactions');

        $this->get('/transactions')->assertSee($transaction->description);
    }
}