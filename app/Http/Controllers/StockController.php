<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class StockController extends Controller
{
    public function index()
    {
        return view('stock.index');
    }

    public function create()
    {
        return view('stock.create');
    }
}
