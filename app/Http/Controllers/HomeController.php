<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\Process\ProcessResource;
use App\Http\Resources\Triggers\TriggersResource;
use Illuminate\Http\Request;
use App\Services\Automations\AutomationService;
use App\Services\ProcessService;
use App\Services\TriggersService;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
  private $automationService, $processService,$triggersService;
  public function __construct(AutomationService $automationService, ProcessService $processService,
  TriggersService $triggersService)
  {
    $this->automationService = $automationService;
    $this->processService = $processService;
    $this->triggersService = $triggersService;
  }

  public function index(Request $request): Response
    {
    return Inertia::render('dashboard/index', [
        'sumary' => $this->automationService->getMonthAutomations(),
        'dayByDayCurrentWeek' => $this->triggersService->getDayByDayCurrentWeekTriggers(),
        'dayByDayLastWeek' => $this->triggersService->getDayByDayLastWeekTriggers(),
        'recentActivities' => ProcessResource::collection($this->processService->recentActivities()),
        'recentActions' => TriggersResource::collection($this->triggersService->recentActivities()),
    ]);
    /* $services = (new Automation)::get();

    return view('content.home', ['services' => $services]); */
  }

  public function login(): Response
  {
    return Inertia::render('auth/login');
  }
}
