<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        // Get the user's wallet transactions and balance
        if (!$user->wallet) {
            $user->wallet()->create([
                'balance' => 0,
            ]);

            $user->refresh();
        }

        $transactions = $request->user()->wallet->transactions()->with('transfer')->orderByDesc('id')->get();
        $balance = $request->user()->wallet->balance;

        return view('dashboard', compact('transactions', 'balance'));
    }
}
