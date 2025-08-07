<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Test response to ensure the controller is working
        /*
        return response()->json([
            'message' => 'This is a test response from the LanguageController store method.',
            'data' => $request->all(),
        ]);
        */
        $code = $request->input('code');
        $name = $request->input('name');
        if(!$code || !$name) {
            return response()->json(['error' => 'Code and name are required'], 400);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:languages,code',
        ]);
        //if the validation fails, it will automatically return a 422 response with the validation errors
        return Language::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
