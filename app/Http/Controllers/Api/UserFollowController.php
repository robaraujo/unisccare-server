<?php

namespace App\Http\Controllers\Api;
use App\Models\Staff\UserFollow;
use App\Models\Staff\User;
use App\Http\Controllers\AuthenticateController;
use Input;
use Request;

class UserFollowController extends AuthenticateController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the UserFollow.
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        $followers = UserFollow::where('user_id', $this->user->id)->pluck('following_id')->toArray();
        $users = User::where('id', '!=', $this->user->id)->get();

        foreach ($users as $key => $user) {
          $users[$key]['following'] = in_array($user->id, $followers);
        }
          
        return response()->json($users);
    }

    /**
     * Store a newly created UserFollow in storage.
     *
     * @param CreateUserFollowRequest $request
     *
     * @return Response
     */
    public function store($following_id)
    {
        $input = Input::all();
        $input['user_id'] = $this->user->id;
        $input['following_id'] = $following_id;

        if ($user_follow = UserFollow::create($input)) {
          $user_follow->user = $this->user;
          return response()->json($user_follow);
        }

        return response()->json(['error' => 'server_error'], 403);
    }

    public function destroy($following_id) {
      $follow = UserFollow::where('user_id', $this->user->id)->where('following_id', $following_id);

      if (empty($follow)) {
        return response()->json(['error' => 'not_found'], 404);
      }

      $follow->delete();
      return response()->json(['message' => 'deleted']);
    }
}
