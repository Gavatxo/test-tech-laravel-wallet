<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;


uses(RefreshDatabase::class);


test('wallet is created when users register', function () {

    $userData = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ];

    $response = $this->post('/register', $userData);

    $user = User::where('email', 'test@example.com')->first();
    expect($user)->not()->toBeNull('User should be created');

    expect($user->wallet)->not()->toBeNull('Wallet should be created');

});


