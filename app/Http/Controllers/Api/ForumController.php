<?php

namespace App\Http\Controllers\Api;
use App\Models\Staff\Forum;
use App\Models\Staff\Post;
use App\Http\Controllers\AuthenticateController;
use Input;
use Request;

class ForumController extends AuthenticateController
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
        $forums = Forum::with('user')
          ->limit(20)
          ->orderBy('id', 'DESC')
          ->get();

        return response()->json($forums);
    }

    /**
     * Store a newly created Forum in storage.
     *
     * @param CreateForumRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
      $input = Input::all();
      $input['admin_id'] = $this->user->id;

      if ($forum = Forum::create($input)) {
        $forum->user = $this->user;
        return response()->json($forum);
      }

      return response()->json(['error' => 'server_error'], 403);
    }

    public function find($id) {
      $forum = Forum::where('id', $id)->with('user')->first();
      $posts = Post::where('forum_id', $id)->with('user')->get();

      return response()->json([
        'forum'=> $forum,
        'posts'=> $posts,
      ]);
    }

    public function destroy($id) {
      $forum = Forum::find($id);
      if (empty($forum)) {
          return response()->json(['error' => 'not_found'], 404);
      }

      $forum->delete();
      Post::where('forum_id', $id)->delete();
      return response()->json(['message' => 'deleted']);
    }
}
