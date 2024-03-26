<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offices = Office::all();

        return response()->json(['offices' => $offices], 200);
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
        $validation = $request->validate([
            'name' => 'required|string',
        ]);

        $office = Office::create($validation);

        if ($office) return response()->json(['message' => 'Office created successfully'], 200);

        return response()->json(['message' => 'Failed to create office'], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $office = Office::findOrFail($id);

        if ($office) return response()->json(['office' => $office], 200);

        return response()->json(['message' => 'Office not found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required|string',
        ]);


        $office = Office::findOrFail($id);
        $office->update($validation);

        if ($office) return response()->json(['message' => 'Office updated successfully'], 200);

        return response()->json(['message' => 'Failed to update office'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $office = Office::findOrFail($id);

        if ($office)
        {
            $office->delete();
            return response()->json(['message' => 'Office deleted successfully'], 200);
        }

        return response()->json(['message' => 'Failed to delete office'], 500);
    }
}
