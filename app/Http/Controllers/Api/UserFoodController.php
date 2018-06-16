<?php

namespace App\Http\Controllers\Api;
use App\Models\Staff\UserFood;
use App\Models\Staff\Food;
use App\Models\Staff\Diet;
use App\Models\Staff\User;
use App\Http\Controllers\AuthenticateController;
use Input;
use Request;

class UserFoodController extends AuthenticateController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the UserFood.
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        // get user diets
        $diets = [];
        foreach (Diet::whereRaw("FIND_IN_SET(user_ids, {$this->user->id})")->get() as $row) {
            $diets[] = $this->getDietFoods($row);
        }

        // ultimas comidas consumidar por user
        $user_foods = UserFood::where('user_id', $this->user->id)
          ->with('food')
          ->limit(10)
          ->orderBy('id', 'DESC')
          ->get();

        return response()->json([
            'diets'     => $diets,
            'user_foods'=> $user_foods,
            'foods'     => Food::get()
        ]);
    }

    /**
     * Store a newly created UserFood in storage.
     *
     * @param CreateUserFoodRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = Input::all();
        $input['user_id'] = $this->user->id;
        $food = Food::find($input['food_id']);
        
        if (!$food) {
            return response()->json('Food not found.', 404);
        }
        if (!$input['qtt'] || !is_numeric($input['qtt'])) {
            return response()->json('Food quantity must be over 0.', 403);
        }
        
        if ($user_food = UserFood::create($input)) {
          $user_food->food = $food;
          User::where('id', $this->user->id)->increment('points', 50);
          return response()->json($user_food);
        }

        return response()->json('Server error', 403);
    }

    /**
     * Store all foods from a specific diet
     *
     * @param CreateUserFoodRequest $request
     *
     * @return Response
     */
    public function storeMeal(Request $request)
    {
        $input = Input::all();
        $diet = Diet::find($input['diet']);
        $diet = $this->getDietFoods($diet);
        User::where('id', $this->user->id)->increment('points', 70);
        
        foreach ($diet->foods as $food) {
            UserFood::create([
                'user_id'   =>  $this->user->id,
                'qtt'       => $food->qtt,
                'food_id'   => $food->id,
            ]);
        } 

        return response()->json('success');
    }

    private function getDietFoods($row)
    {
        $row->foods = Food::whereIn('id', explode(',', $row->food_ids))->get();
        $food_qtts = explode(',', $row->food_qtts);

        foreach ($row->foods as $i => &$food) {
            $food->qtt = (int)$food_qtts[$i];
        }

        return $row;
    }
}
