<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SongsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listAll(): JsonResponse
    {
        $songs = Song::all();
        if ($songs->isEmpty())
        {
            return response()->json(['message' => 'No songs Found'], 204);
        }
        return response()->json($songs, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function save(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => 'required | string | max: 75',
                'artist' => 'required | string | max: 50',
                'album' => 'nullable | string | max: 50',
                'genre' => 'nullable | string | max: 50',
            ]);

        if (!$validated)
        {
            return response()->json(['message' => 'Not enough Params'], 404);
        }

        $song = new Song;
        $song->title = $request['title'];
        $song->artist = $request['artist'];
        $song->album = $request['album'];
        $song->genre = $request['genre'];
        $song->save();

        return response()->json('Song added', 201);
    }

    /**
     * Display the specified resource.
     */
    public function list(string $title): JsonResponse
    {
        $songs = Song::all();
        $song = $songs->where('title', $title)->first();
        if (!$song)
        {
            return response()->json(['message' => 'No songs were found with this title'],404);
        }
        return response()->json($song);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {

        $validated = $request->validate
        ([
            'title' => 'required | string | max: 75',
            'artist' => 'required | string | max: 50',
            'album' => 'string | max: 50 | nullable',
            'genre' => 'string | max: 50 | nullable',
        ]);
        if (!$validated)
        {
            return response()->json(['message' => 'Not enough Params'], 404);
        }

        $songs = Song::all();

        if (!$songs)
        {
            return response()->json(['message' => 'No songs were found with this id'],404);
        }

        $song = $songs->find($id);

        $song->update([
            'title' => $request['title'],
            'artist' => $request['artist'],
            'album' => $request['album'],
            'genre' => $request['genre'],
        ]);
        $song->save();

        return response()->json(['message' => 'Song updated'], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id): JsonResponse
    {
        $songs = Song::all();
        $song = $songs->find($id);
        if (!$song)
        {
            return response()->json(['message' => 'No songs were found with this id'],404);
        }
        $song->delete();

        return response()->json(['message' => 'Successfully deleted'],202);
    }
}
