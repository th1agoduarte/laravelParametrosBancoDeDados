<?php

namespace App\Http\Controllers\App\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UsersRequest;
use App\Http\Requests\Users\UsersUpdateRequest;
use App\Http\Resources\Users\UsersResource;
use App\Services\Users\UsersService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{
    public function __construct(private UsersService $usersService ){}

    public function index(Request $request): Response
    {
        return Inertia::render(
            'app/configs/users/index',
            [
                'filters' => $request->all(),
                'reports' => UsersResource::collection($this->usersService->index($request))
            ]

        );
    }

    public function store(UsersRequest $request): RedirectResponse
    {
        try {
            $this->usersService->store($request);
            return redirect()->back()->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('error', $e->getMessage());
        }
    }

    public function update(UsersUpdateRequest $request): RedirectResponse
    {
        try {
            $this->usersService->update($request->id, $request);
            return redirect()->back()->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('error', $e->getMessage());
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        try {
            $this->usersService->destroy($request->id);
            return redirect()->back()->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('error', $e->getMessage());
        }
    }

}
