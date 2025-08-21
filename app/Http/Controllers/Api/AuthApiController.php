<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Users\UsersLoginResource;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthApiController extends Controller
{
  use ApiResponser;

  public function __construct(Request $request)
    {
        $this->request =$request;
    }
  public function register(Request $request): JsonResponse
  {
      $attr = $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|unique:users,email',
          'password' => 'required|string|min:6|confirmed'
      ]);

      $user = User::create([
          'name' => $attr['name'],
          'password' => bcrypt($attr['password']),
          'email' => $attr['email']
      ]);

      return $this->success([
          'token' => $user->createToken('API Token')->plainTextToken
      ]);
  }

  public function login(Request $request): JsonResponse
  {
      $attr = $request->validate([
          'email' => 'required|string|email|',
          'password' => 'required|string|min:6'
      ]);

      if (!Auth::attempt($attr)) {
          return $this->error('Credentials not match', 401);
      }

      return $this->success(new UsersLoginResource(auth()->user()));
  }

  public function logout(): Array
  {
      auth()->user()->tokens()->delete();

      return [
          'message' => 'Tokens Revoked'
      ];
  }

  public function me(): JsonResponse
  {
      try {
          return $this->success(auth()->user());
      } catch (\Throwable $th) {
          return $this->error('Unauthenticated', 401);
      }
  }
}
