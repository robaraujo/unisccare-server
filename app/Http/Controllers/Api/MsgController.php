<?php

namespace App\Http\Controllers\Api;
use App\Models\Staff\Msg;
use App\Models\Staff\User;
use App\Models\Staff\UserFollow;
use App\Http\Controllers\AuthenticateController;
use Input;
use Request;

class MsgController extends AuthenticateController
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
        $input = Input::all();
        $msgs = Msg::where('user_id', $this->user->id)->where('id', '>', $input['last_id'])->get();
        return response()->json($msgs);
    }


    /**
     * Store a newly created msg in storage.
     *
     * @param Create msg Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if (!$this->user->staff) {
            return response()->json(['error' => 'no staff defined'], 403);
        }

        $input = Input::all();
        $input['from'] = 'user';
        $input['user_id'] = $this->user->id;
        $input['staff_id'] = $this->user->staff->id;

        if ($msg = Msg::create($input)) {
            return response()->json($msg);
        }

        return response()->json(['error' => 'server_error'], 403);
    }
}
