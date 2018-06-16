<?php

namespace App\Http\Controllers\Api;
use App\Models\Staff\Step;
use App\Http\Controllers\AuthenticateController;
use Input;
use Request;
use Illuminate\Support\Facades\DB;

class StepController extends AuthenticateController
{

    public function __construct()
    {
        parent::__construct();
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

        if (!isset($input['steps'], $input['start_date'], $input['end_date'])) {
            return response()->json('Invalid form.', 403);
        }

        // check if step at start_date already exists
        $step = Step::where('user_id', $this->user->id)->where('start_date', $input['start_date'])->first();
        if ($step) {
            $step->steps = $input['steps'];
            $step->end_date = $input['end_date'];
            $step->save();
        } else {
            $step = Step::create($input);
        }

        return response()->json($step);
    }
}
