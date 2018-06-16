<?php

namespace App\Http\Controllers\Api;
use App\Models\Staff\Photo;
use App\Models\Staff\Food;
use App\Models\Staff\Water;
use App\Models\Staff\Step;
use App\Models\Staff\Weight;
use App\Models\Staff\Medicine;
use App\Http\Controllers\AuthenticateController;
use Input;
use Request;

class ReportController extends AuthenticateController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the Photo.
     *
     * @param Request $request
     * @return Response
     */
    public function food(Request $request)
    {   
        $input = Input::all();
        list($year, $month, $day) = explode('-', $input['date']);

        $result = Food::report($this->user->id, $input['view'], $year, $month, $day);
        return response()->json($result);
    }

    /**
     * Display a listing of the Photo.
     *
     * @param Request $request
     * @return Response
     */
    public function water(Request $request)
    {   
        $input = Input::all();
        list($year, $month, $day) = explode('-', $input['date']);

        $result = Water::report($this->user->id, $input['view'], $year, $month, $day);
        return response()->json($result);
    }

    /**
     * Return sum of steps
     *
     * @param Request $request
     * @return Response
     */
    public function step(Request $request)
    {   
        $input = Input::all();
        list($year, $month, $day) = explode('-', $input['date']);

        $result = Step::report($this->user->id, $input['view'], $year, $month, $day);
        return response()->json($result);
    }

    /**
     * Display a listing of the Photo.
     *
     * @param Request $request
     * @return Response
     */
    public function weight(Request $request)
    {   
        $input = Input::all();
        list($year, $month, $day) = explode('-', $input['date']);

        $result = Weight::report($this->user->id, $input['view'], $year, $month, $day);

        // if result is empty, use last result before
        if (!count($result)) {
            $usDate = implode('-', array_reverse(explode('/', $input['date'])));
            $lst = Weight::where('created_at','<', $usDate)->orderBy('id', 'desc')->first();
            $lst->created_at = "{$usDate} 12:00:00";
            $result = [$lst];
        }

        return response()->json($result);
    }

    /**
     * Display a listing of the Photo.
     *
     * @param Request $request
     * @return Response
     */
    public function medicine(Request $request)
    {   
        $input = Input::all();
        list($year, $month, $day) = explode('-', $input['date']);

        $result = Medicine::report($this->user->id, $input['view'], $year, $month, $day);
        return response()->json($result);
    }
}
