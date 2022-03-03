<?php

namespace Tests;

use App\Exceptions\Handler;
use App\Models\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Throwable;

abstract class TestCase extends BaseTestCase
{
    protected $user;
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->signIn($this->user)->disableExceptionHandling();
    }

    protected function disableExceptionHandling()
    {
        $this->oldExceptionHandler = app()->make(ExceptionHandler::class);
        app()->instance(ExceptionHandler::class, new PassThroughHandler);
    }

    protected function withExceptionHandling()
    {
        app()->instance(ExceptionHandler::class, $this->oldExceptionHandler);
        return $this;
    }

    protected function signIn($user)
    {
        $this->actingAs($user);
        return $this;
    }

    protected function signOut()
    {
        $this->post('/logout');
        return $this;
    }
}

class PassThroughHandler extends Handler
{
    public function __construct()
    {}

    public function report(Throwable $e)
    {}

    public function render($request, Throwable $e)
    {
        throw $e;
    }
}