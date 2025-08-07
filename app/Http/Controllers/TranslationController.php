<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Translation;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $translations = Translation::with('language')->get();
        return response()->json($translations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'key' => 'required|string|max:255',
            'content' => 'required|string',
            'language_id' => 'required|exists:languages,id',
            'tags' => 'nullable|array',
        ]);
        $translation = Translation::create([
            'key' => $request->key,
            'content' => $request->content,
            'language_id' => $request->language_id,
            'tags' => $request->tags ?? [],
        ]);
        return response()->json([
            'message' => 'Translation created successfully',
            'translation' => $translation,
        ], 201);
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
