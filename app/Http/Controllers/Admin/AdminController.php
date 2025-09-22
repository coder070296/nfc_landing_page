<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Card;

class AdminController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $cardsCount = Card::count();

        $latestUsers = User::latest()->take(5)->get();
        $latestCards = Card::latest()->take(5)->get();

        return inertia('Admin/Index', [
            'usersCount' => $usersCount,
            'cardsCount' => $cardsCount,
            'latestUsers' => $latestUsers,
            'latestCards' => $latestCards,
        ]);
    }
}
