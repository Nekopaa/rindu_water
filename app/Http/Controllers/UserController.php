<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $User = \App\Models\User::all();
        return view('user.index', compact('User'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        \App\Models\User::create($request->all());
        return redirect()->route('user.index')
            ->with('succes', 'user');
    }

    public function edit($id)
    {
        $User = \App\Models\User::findOrFail($id);
        return view('user.edit', compact('User'));
    }   

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users'.$id,
            'password' => 'required|string|min:6|confirmed',
        ]);

        $User = \App\Models\User::findOrFail($id);
        $User->update($request->all());
        return redirect()->route('user.index')
        ->with('succes', 'user');
    }
}