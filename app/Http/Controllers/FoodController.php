<?php

namespace App\Http\Controllers;

use App\Models\Food;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::orderBy('created_at', 'desc')->get();

        return view('foods.index', compact('foods'));
    }

    public function create()
    {
        return view('foods.create');
    }
}