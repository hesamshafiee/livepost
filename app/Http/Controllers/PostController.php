<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class  PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::query()->get() ;

        return new JsonResponse([
            'data'=> PostResource::collection($posts)
        ]) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $created = Post::query()->create([
            'title' => $request->title,
            'body' => $request->body,
        ]) ;
        return new PostResource($created) ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $updated = $post->update([
            'title' => $request->title ?? $post->title,
            'body' => $request->body ?? $post->body,
        ]) ;

        if(!$updated) {
            return new JsonResponse([
                'error' =>[
                    'Failed to update model.'
                ]
            ],400);
        }

        return new PostResource($post) ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $deleted = $post->delete() ;

        if(!$deleted) {
            return new JsonResponse([
                'error' =>[
                    'Failed to delete model.'
                ]
            ],400);
        }

        return new JsonResponse([
            'data' => 'success'
        ]) ;
    }
}
