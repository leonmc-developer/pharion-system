<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{


public function index()
{
    $users = User::all();

    return view('users.index', compact('users'));
}
public function show(User $user)
{
    return view('users.show', compact('user'));
}
public function edit(User $user)
{
    return view('users.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($user->id),
        ],
        'role' => 'required|in:admin,empleado'
    ]);

    $user->update($request->only('name', 'email', 'role'));

    return redirect()->route('users.index')
        ->with('success', 'Usuario actualizado correctamente');
}

}
