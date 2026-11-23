<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $user->load('media');

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'collection' => MediaResource::collection($user->media),
        ]);
    }

    public function addToCollection(Request $request, User $user)
    {
        $data = $request->validate([
            'media_id' => 'required|integer|exists:media,id',
        ]);

        $mediaId = $data['media_id'];

        if ($user->media()->whereKey($mediaId)->exists()) {
            return response()->json([
                'message' => 'Media sudah ada di koleksi'
            ], 409);
        }

        $user->media()->attach($mediaId);

        return response()->json([
            'message' => 'Media berhasil ditambahkan ke koleksi'
        ], 200);
    }

    public function removeFromCollection(User $user, Media $media)
    {
        if (!$user->media()->whereKey($media->id)->exists()) {
            return response()->json([
                'message' => 'Media tidak ada di koleksi'
            ], 404);
        }

        $user->media()->detach($media->id);

        return response()->json([
            'message' => 'Media berhasil dihapus dari koleksi'
        ], 200);
    }
}
