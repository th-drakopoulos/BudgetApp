<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
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
    public function it_allows_only_authenticated_users_to_the_transactions_list()
    {
        $this->signOut()->withExceptionHandling()->get('/transactions')->assertRedirect('/login');
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_only_displays_transactions_that_belong_to_the_currently_logged_in_user()
    {
        $category = Category::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $otherUser = User::factory()->create();
        $transaction = Transaction::factory()->create(
            [
                'user_id' => $this->user->id,
                'category_id' => $category->id,
            ]
        );
        $otherTransaction = Transaction::factory()->create(
            [
                'user_id' => $otherUser->id,
            ]
        );
        $this->get('/transactions')
            ->assertSee($transaction->description)
            ->assertDontSee($otherTransaction->description);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_display_all_transactions()
    {
        $category = Category::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $transaction = Transaction::factory()->create(
            [
                'user_id' => $this->user->id,
                'category_id' => $category->id,
            ]
        );

        $this->get('/transactions')->assertSee($transaction->description)->assertSee($transaction->category->name);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_filter_transactions_by_category()
    {
        $category = Category::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $transaction = Transaction::factory()->create(
            [
                'category_id' => $category->id,
                'user_id' => $this->user->id,
            ]
        );
        $otherTransaction = Transaction::factory()->create();

        $this->get('/transactions/' . $category->slug)->assertSee($transaction->description)->assertDontSee($otherTransaction->description);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_filter_transactions_by_month()
    {
        $category = Category::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $currentTransaction = Transaction::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $pastTransaction = Transaction::factory()->create([
            'user_id' => $this->user->id,
            'category_id' => $category->id,
            'created_at' => Carbon::now()->subMonth(2),
        ]);

        $this->get('/transactions?month=' . Carbon::now()->subMonth(2)->format('M'))
            ->assertSee($pastTransaction->description)
            ->assertDontSee($currentTransaction->description);
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_can_filter_transactions_by_current_month_by_default()
    {
        $category = Category::factory()->create(
            [
                'user_id' => $this->user->id,
            ]
        );
        $currentTransaction = Transaction::factory()->create(
            [
                'user_id' => $this->user->id,
                'category_id' => $category->id,
            ]
        );
        $pastTransaction = Transaction::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => Carbon::now()->subMonth(2),
        ]);

        $this->get('/transactions')
            ->assertSee($currentTransaction->description)
            ->assertDontSee($pastTransaction->description);
    }
}