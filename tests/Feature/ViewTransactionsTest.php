<?php

namespace Tests\Feature;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewTransactionsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function it_can_display_all_transactions()
    {
        $transaction = Transaction::factory()->create();

        $this->get('/transactions')->assertSee($transaction->description)->assertSee($transaction->category->name);
    }
}