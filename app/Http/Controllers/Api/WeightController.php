<?php

namespace App\Http\Controllers\Api;
use App\Models\Staff\Weight;
use App\Models\Staff\User;
use App\Http\Controllers\AuthenticateController;
use Input;
use Request;

class WeightController extends AuthenticateController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the Weight.
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        $weights = Weight::where('user_id', $this->user->id)
          ->limit(10)
          ->orderBy('id', 'DESC')
          ->get()
          ->toArray();

        return response()->json($weights);
    }

    /**
     * Store a newly created Weight in storage.
     *
     * @param CreateWeightRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = Input::all();
        $input['user_id'] = $this->user->id;
        $weight = Weight::create($input);
        User::where('id', $this->user->id)->increment('points', 50);

        $user = User::find($this->user->id);
        $user->last_weight = $input['weight'];

        // first time adding weight
        if (!$user->first_weight) {
            $user->first_weight = $input['weight'];            
        }
        $user->save();

        return response()->json($weight);
    }
}
