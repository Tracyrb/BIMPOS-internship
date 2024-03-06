<?php

namespace App\Policies;

use App\Models\Stock;
use App\Models\User;

class StockPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Stock $stock)
    {
        return $user->role === 'admin';
    }
    public function delete(User $user, Stock $stock)
    {
        return $user->role === 'admin';
    }

}
