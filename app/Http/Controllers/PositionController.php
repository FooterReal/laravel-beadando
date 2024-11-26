<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PositionController extends Controller
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
        $positions = Position::all();

        return view('positions.index', [
            'positions' => $positions,
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

        if (!$isadmin) {
            return abort(403);
        }

        return view('positions.create', [
            'isadmin' => $isadmin
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $isadmin = User::all()->where('id','=',Auth::id())->first()->admin;

        if (!$isadmin) {
            return abort(403);
        }

        $request->validate([
            'name' => 'required|unique:positions,name'
        ],
        [
            'required' => 'This field is not optional: :attribute',
            'unique' => 'This field must be a unique value: :attribute'
        ]);

        Position::create([
            'name' => $request->name
        ]);

        return redirect()->route('positions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $users = Position::findOrFail($id)->users;

        return view('positions.show', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $isadmin = User::all()->where('id','=',Auth::id())->first()->admin;

        if (!$isadmin) {
            return abort(403);
        }

        $position = Position::findOrFail($id);

        return view('positions.edit', [
            'id' => $id,
            'name' => $position->name,
            'isadmin' => $isadmin
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $isadmin = User::all()->where('id','=',Auth::id())->first()->admin;

        if (!$isadmin) {
            return abort(403);
        }

        $request->validate([
            'name' => 'required|unique:positions,name'
        ],
        [
            'required' => 'This field is not optional: :attribute',
            'unique' => 'This field must be a unique value: :attribute'
        ]);

        Position::findOrFail($id)->update([
            'name' => $request->name
        ]);

        return redirect()->route('positions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $isadmin = User::all()->where('id','=',Auth::id())->first()->admin;

        if (!$isadmin) {
            return abort(403);
        }

        Position::destroy($id);

        return redirect()->route('positions.index');
    }
}
