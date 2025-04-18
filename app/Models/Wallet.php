<?php

declare(strict_types=1);

namespace App\Models;

use App\Notifications\balanceIsLow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'balance',
    ];

    /**
     * @return BelongsTo<User>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<WalletTransaction>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function checkLowBalanceAndNotify($threshold = 10): bool
    {
        if ($this->balance < $threshold) {
            $this->user->notify(new balanceIsLow($this->balance));

            return true;
        }

        return false;
    }
}
