<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request): Response
    {
        return Inertia::render('dashboard/index', []);
    }

    public function login(): Response
    {
        return Inertia::render('auth/login');
    }
}
