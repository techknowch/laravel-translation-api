<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Translation;
use App\Services\BasicTranslationService;

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
            'original_content' => $request->original_content ?? null,
            'from_locale' => $request->from_locale ?? null,
            'to_locale' => $request->to_locale ?? null,
            'tags' => $request->tags ?? [],
        ]);
        if ($request->has('original_content') && $request->has('from_locale') && $request->has('to_locale')) {
            $service = new BasicTranslationService();
            $translation->content = $service->translate($request->original_content, $request->from_locale, $request->to_locale);
        }
        $translation->save();    
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
        $translation = Translation::with('language')->findOrFail($id);
        if (!$translation) {
            return response()->json(['message' => 'Translation not found'], 404);
        }
        return response()->json($translation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $translation = Translation::findOrFail($id);
        $request->validate([
            'key' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'language_id' => 'sometimes|required|exists:languages,id',
            'original_content' => 'nullable|string',
            'from_locale' => 'nullable|string|max:10',
            'to_locale' => 'nullable|string|max:10',
            'tags' => 'nullable|array',
        ]);
        $translation->update($request->only(['key', 'content', 'language_id', 'tags']));
        return response()->json([
            'message' => 'Translation updated successfully',
            'translation' => $translation,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $translation = Translation::findOrFail($id);
        if (!$translation) {
            return response()->json(['message' => 'Translation not found'], 404);
        }
        $translation->delete();
        return response()->json([
            'message' => 'Translation deleted successfully',
        ]);
    }

    public function export()
    {
        $translations = Translation::with('language')->get()->groupBy('language.code');
        $export = $translations->mapWithKeys(function ($group, $code) {
            return [$code => $group->pluck('content', 'key')->toArray()];
        });
        return response()->json($export);
    }

    public function search(Request $request)
    {
        $query = Translation::query();
        if ($request->has('key')) {
            $query->where('key', 'like', '%'.$request->key.'%');
        }
        if ($request->has('content')) {
            $query->where('content', 'like', '%'.$request->content.'%');
        }
        if ($request->has('tags')) {
            $query->whereJsonContains('tags', $request->tags);
        }
        return $query->with('language')->get();
    }
}
