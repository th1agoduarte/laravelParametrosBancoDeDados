<?php

namespace App\Http\Middleware;

use App\Http\Resources\Menus\MenusResource;
use App\Models\Menus;
use App\Services\Conf\ParametersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
            if (Auth::check()) {
                $menus = MenusResource::collection(Menus::get());
            } else {
                $menus = [];
            }
        return array_merge(parent::share($request), [
            'flash' => function () use ($request) {
                return [
                    'permissionErro' => $request->session()->get('permissionErro'),
                    'status' => $request->session()->get('status'),
                    'success' => $request->session()->get('success'),
                    'fail' => $request->session()->get('fail'),
                ];
            },
            'user' => Auth::user(),
            'year' => date('Y'),
            'version'=> ParametersService::getInitalConfig('APP_VERSION') ?? '1.0.0',
            'menus' => $menus,
            'app_name' => ParametersService::getInitalConfig('APP_NAME') ?? 'Manager Automations',
        ]);
    }
}
