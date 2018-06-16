<?php

namespace App\Http\Controllers\Api;
use App\Models\Staff\Post;
use App\Models\Staff\User;
use App\Models\Staff\UserFollow;
use App\Http\Controllers\AuthenticateController;
use Input;
use Request;

class PostController extends AuthenticateController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the Forum.
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        $posts = Post::with('user')
            ->select('posts.*')
            ->with('forum')
            ->join('user_follow', 'user_follow.following_id', '=', 'posts.user_id')
            ->where('user_follow.user_id', $this->user->id)
            ->get();

        return response()->json($posts);
    }

    /**
     * Displya user posts
     *
     * @param Request $request
     * @return Response
     */
    public function listByUser($user_id)
    {
        
        $posts = Post::with('user')
            ->select('posts.*')
            ->with('forum')
            ->where('posts.user_id', $user_id)
            ->get();

        $following = !!UserFollow::where('user_id', $this->user->id)->where('following_id', $user_id)->count();




        return response()->json([
            'user'=> User::find($user_id),
            'following' => $following,
            'posts'=>$posts
        ]);
    }

    /**
     * Store a newly created Post in storage.
     *
     * @param CreatePostRequest $request
     *
     * @return Response
     */
    public function store(Request $request, $forum_id)
    {
      $input = Input::all();
      $input['user_id'] = $this->user->id;
      $input['forum_id'] = $forum_id;

      if ($post = Post::create($input)) {
        $post->user = $this->user;
        return response()->json($post);
      }
      
      return response()->json(['error' => 'server_error'], 403);
    }
}
