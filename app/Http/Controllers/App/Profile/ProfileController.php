<?php

namespace App\Http\Controllers\App\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
  public function __construct()
  {
  }
  public function index(Request $request): Response
  {
    return Inertia::render('app/configs/users/profile', [
      'filters' => $request->all(),
      'user' => Auth::user(),
    ]);
  }

  public function update(Request $request): RedirectResponse
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
      'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = Auth::user();
    $user->name = $request->name;
    $user->email = $request->email;
    /* if ($request->password) {
      $user->password = Hash::make($request->password);
    } */
    if ($request->hasFile('photo')) {
        $user->photo = $request->file('photo')->store('public/photos');
      }
    $user->save();

    return redirect()->route('app.profile');
  }
}
