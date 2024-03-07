<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return response()->json(['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required | string'
        ]);

        $role = Role::create($validate);

        if ($role)
        {
            return response()->json(['message' => 'Successfully created a role'], 200);
        }

        return response()->json(['message' => 'Failed to create a role'], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        if ($role)
        {
            return response()->json(['role' => $role], 200);
        }

        return response()->json(['message' => 'No role found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required | string'
        ]);

        $role = Role::findOrFail($id);

        if ($role)
        {
            $role->name = $request->name;
            $role->update();

            return response()->json(['message' => 'Successfully updated a role'], 200);
        }

        return response()->json(['message' => 'Failed to update a role'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if ($role)
        {
            $role->delete();

            return response()->json(['message' => 'Successfully deleted a role'], 200);
        }

        return response()->json(['message' => 'Failed to delete a role'], 500);
    }
}
