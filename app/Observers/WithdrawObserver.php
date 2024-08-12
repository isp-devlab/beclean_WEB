<?php

namespace App\Observers;

use App\Models\Withdraw;

class WithdrawObserver
{
    /**
     * Handle the Withdraw "created" event.
     */
    public function created(Withdraw $withdraw)
    {
        // Update user's credit when a withdraw is created
        $user = $withdraw->user;
        $user->credit -= $withdraw->debit;
        $user->save();
    }

    /**
     * Handle the Withdraw "updated" event.
     */
    public function updated(Withdraw $withdraw): void
    {
        //
    }

    /**
     * Handle the Withdraw "deleted" event.
     */
    public function deleted(Withdraw $withdraw): void
    {
        //
    }

    /**
     * Handle the Withdraw "restored" event.
     */
    public function restored(Withdraw $withdraw): void
    {
        //
    }

    /**
     * Handle the Withdraw "force deleted" event.
     */
    public function forceDeleted(Withdraw $withdraw): void
    {
        //
    }
}
