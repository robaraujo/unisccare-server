<?php

namespace App\Http\Controllers\Api;
use App\Models\Staff\User;
use App\Models\Staff\Staff;
use App\Models\Staff\Weight;
use App\Http\Controllers\AuthenticateController;
use Input;
use Hash;
use Illuminate\Http\Request;

class UserController extends AuthenticateController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Store user.
     *
     * @param CreateWeightRequest $request
     *
     * @return Response
     */
    public function register(Request $request)
    {
        $input = Input::all();
        $user = User::create($input);
        $user->password = Hash::make($user->password);
        
        try {
            $user->save();
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json(['error'=>'Server error'], 403);
        }

        // create first weight
        if ($user->first_weight) {
            $weight = Weight::create([
                'weight'    => $user->first_weight,
                'user_id'   => $user->id
            ]);

            $weight->save();
        }

        return parent::authenticate($request);
    }

    /**
     * Update user.
     *
     * @param $request
     *
     * @return Response
     */
    public function update(Request $request)
    {
        $input = Input::all();
        $user = User::find($this->user->id);

        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->age = $input['age'];
        $user->staff_id = $input['staff_id'];
        $user->dt_operation = $input['dt_operation'];
        $user->dt_end = $input['dt_end'];
        
        try {
            $user->save();

            if ($user->staff_id) {
                $user->staff = Staff::find($user->staff_id);
            }

            return response()->json($user);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json(['error'=>'Server error'], 403);
        }
    }
}
