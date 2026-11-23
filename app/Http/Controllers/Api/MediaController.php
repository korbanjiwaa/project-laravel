<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        return MediaResource::collection(
            $query->with('users')->paginate(10)
        );
    }

    public function store(StoreMediaRequest $request)
    {
        $media = Media::create($request->validated());

        return (new MediaResource($media))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Media $medium)
    {
        return new MediaResource(
            $medium->load('users')
        );
    }

    public function update(UpdateMediaRequest $request, Media $medium)
    {
        $medium->update($request->validated());

        return new MediaResource(
            $medium->fresh()
        );
    }

    public function destroy(Media $medium)
    {
        $medium->delete();

        return response()->json([
            'message' => 'Media berhasil dihapus'
        ], 200);
    }
}
