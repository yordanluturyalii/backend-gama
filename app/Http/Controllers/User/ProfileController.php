<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\StoreTransaction;
use App\Models\TransactionStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfileUser()
    {
        $user = Auth::user();
        return response()->json([
            'message' => 'Success Get Data',
            'user' => new UserResource($user)
        ]);
    }

    public function getBalanceUser()
    {
        $user = Auth::user();

        return response()->json([
            'message' => 'Success Get Data',
            'user' => new UserResource($user),
            'wallet' => [
                'balance' => $user->wallet_balance * 100
            ]
        ]);
    }
}
