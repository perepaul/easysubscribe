<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Models\Post;
use App\Traits\LogsError;
use App\Traits\ApiResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PostResource;

class PostsController extends Controller
{
    use ApiResponse, LogsError;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success(
            'success',
            new PostResource(Post::latest()->paginate())
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'website_id' => ['required', 'exists:websites,id'],
            'title' => ['required', 'unique:posts'],
            'body' => ['required',]
        ]);

        DB::beginTransaction();
        try {
            $valid['slug'] = Str::slug($valid['title']);
            $post = Post::create($valid);
            // dispatch event for sending the mails
            event(new PostCreated($post));
            DB::commit();
            return $this->success('post created');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $this->success(
            'posts fetched',
            new PostResource($post)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $valid = $request->validate([
            'website_id' => ['required', 'exists:websites,id'],
            'title' => ['required', 'unique:posts,title,' . $post->id],
            'body' => ['required']
        ]);

        DB::beginTransaction();
        try {
            $post->update($valid);
            DB::commit();
            return $this->success('post updated');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return $this->success();
    }
}
