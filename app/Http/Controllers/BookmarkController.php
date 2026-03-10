<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookmark = Bookmark::all();

        return response()->json($bookmark);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'userId' => 'required|string',
            'bookId' => 'required|string',
            'currentPage' => 'required|integer',
            'lastReadAt' => 'nullable|date',
        ]);

        $bookmark = Bookmark::create($validated);

        return response()->json($bookmark, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bookmark = Bookmark::find($id);

        if (!$bookmark) {
            return response()->json([
                'status' => 'error',
                'message' => $bookmark
            ], 404);
        }

        return response()->json($bookmark);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bookmark = Bookmark::find($id);

        if (!$bookmark) {
            return response()->json(['message' => 'Bookmark not found'], 404);
        }

        $bookmark->update($request->all());

        return response()->json($bookmark);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bookmark = Bookmark::find($id);

        if (!$bookmark) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bookmark not found'
            ], 404);
        }

        $bookmark->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Bookmark deleted successfully'
        ]);
    }
}
