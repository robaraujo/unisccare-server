<?php

namespace App\Http\Controllers\Api;
use App\Models\Staff\Water;
use App\Models\Staff\Food;
use App\Models\Staff\User;
use App\Http\Controllers\AuthenticateController;
use Input;
use Request;
use Illuminate\Support\Facades\DB;

class WaterController extends AuthenticateController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the Water.
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        // ultimas comidas consumidar por user
        $waters = Water::where('user_id', $this->user->id)
          ->orderBy('id', 'DESC')
          ->limit(10)
          ->get();

        return response()->json($waters);
    }

    /**
     * Store a newly created Water in storage.
     *
     * @param CreateWaterRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = Input::all();
        $input['user_id'] = $this->user->id;

        if (!$input['qtt'] || !is_numeric($input['qtt'])) {
            return response()->json('Water quantity must be over 0.', 403);
        }

        if ($water = Water::create($input)) {
            User::where('id', $this->user->id)->increment('points', 50);
            return response()->json($water);
        }

        return response()->json('Server error.', 403);
    }
}
