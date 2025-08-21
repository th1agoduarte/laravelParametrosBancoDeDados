<?php

namespace App\Http\Controllers\App\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request): Response
    {
        return Inertia::render('app/dashboard/index', [
        ]);
    }
}
