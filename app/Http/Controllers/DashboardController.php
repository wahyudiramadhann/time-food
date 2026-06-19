<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'restaurant') {
            $foods = Food::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('dashboard', compact('foods'));
        }

        $foods = Food::where('status', 'aktif')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', compact('foods'));
    }
}