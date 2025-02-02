<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function transactions()
    {
        return view('transactions');
    }

    public function budget()
    {
        return view('budget');
    }

    public function reports()
    {
        return view('reports');
    }
}