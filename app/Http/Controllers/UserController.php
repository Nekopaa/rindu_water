<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;

class userController extends Controller
{
    public function index()
    {
        $user = \App\Models\user::all();
        return view('user.index', compact('user'));
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

        \App\Models\user::create($request->all());
        return redirect()->route('user.index')
            ->with('succes', 'user');
    }

    public function edit($id)
    {
        $user = \App\Models\user::findOrFail($id);
        return view('user.edit', compact('user'));
    }   

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users'.$id,
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = \App\Models\user::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('user.index')
        ->with('succes', 'user');
    }

    public function destroy (string $id)
    {
        $user=\App\Models\user::findOrFail($id)
        $user=>delete();
        
    }
}


