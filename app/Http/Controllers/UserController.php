<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required | string',
            'username' => 'required | string',
            'email' => 'required | email',
            'role_id' => 'required | integer',
            'password' => 'required | string'
        ]);

        $user = User::create($validate);

        if ($user)
        {
            return response()->json(['message' => 'Successfully created a user'], 200);
        }

        return response()->json(['message' => 'Failed to create a user'], 500);
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
        $validate = $request->validate([
            'name' => 'required | string',
            'username' => 'required | string',
            'email' => 'required | email',
            'role_id' => 'required | integer',
        ]);
        
        $user = User::findOrFail($id);
        $user->name = $validate['name'];
        $user->username = $validate['username'];
        $user->email = $validate['email'];
        $user->role_id = $validate['role_id'];
        $user->update();

        if ($user) return response()->json(['message' => 'Successfully updated a user'], 200);
        return response()->json(['message' => 'Failed to update a user'], 500);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user)
        {
            $user->delete();
            return response()->json(['message' => 'Successfully deleted a user'], 200);
        }

        return response()->json(['message' => 'Failed to delete a user'], 500);
    }
}
