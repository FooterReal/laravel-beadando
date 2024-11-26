<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $isadmin = User::all()->where('id','=',Auth::id())->first()->admin;

        $users = User::all();
        return view('users.index', [
            'users' => $users,
            'isadmin' => $isadmin
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $isadmin = User::all()->where('id','=',Auth::id())->first()->admin;
        $positions = Position::all();

        return view('users.create', [
            'isadmin' => $isadmin,
            'positions' => $positions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'pos' => 'required|exists:positions,id',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
            'card' => 'required|min:16|max:16|regex:/[a-zA-Z0-9]+/i'
        ],
        [
            'required' => 'This field is not optional: :attribute'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'phone_number' => $request->phone,
            'card_number' => $request->card,
            'position_id' => $request->pos
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
