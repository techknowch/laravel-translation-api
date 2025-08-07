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
        return Language::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*
        return response()->json([
            'message' => 'This is a test response from the LanguageController store method.',
            'data' => $request->all(),
        ]);
        */

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
        $language = Language::findOrFail($id);
        if(!$language->exists) {
            return response()->json(['message' => 'Language not found'], 404);
        }
        return response()->json($language);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        /*
        return response()->json([
            'message' => 'This is a test response from the LanguageController update method.',
            'data' => $request->all(),
        ]);
        */
        $language = Language::findOrFail($id);
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'code' => 'sometimes|required|string|max:10|unique:languages,code,' . $id,
        ]);
        $language->update($request->only(['name', 'code']));
        return response()->json([
            'message' => 'Language updated successfully',
            'language' => $language,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $language = Language::findOrFail($id);
        $language->delete();
        return response()->json([
            'message' => 'Language deleted successfully',
        ]);
    }
}
