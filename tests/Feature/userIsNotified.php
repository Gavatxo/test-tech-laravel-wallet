<?php

use App\Models\User;
use App\Models\Wallet;
use App\Notifications\balanceIsLow;
use Illuminate\Notifications\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('user is notified when balance is low', function () {
    Notification::fake();
    $user = User::factory()->create();
    $wallet = $user->wallet()->create(['balance' => 8]);

    $wallet->checkLowBalanceAndNotify();

    Notification::assertSentTo(
        $user, 
        balanceIsLow::class,
        function ($notification, $channels) use ($wallet) {
            return $notification->balance === $wallet->balance;
        }
    );
});

test('user is not notified when balance is high', function () {
    Notification::fake();

    $user = User::factory()->create();
    $wallet = $user->wallet()->create(['balance' => 20]);

    $wallet->checkLowBalanceAndNotify();

    Notification::assertNotSentTo(
        $user, 
        balanceIsLow::class
    );
});