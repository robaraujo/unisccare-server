<?php

namespace App\Http\Controllers\Api;
use App\Models\Staff\Schedule;
use App\Http\Controllers\AuthenticateController;
use Input;
use Request;

class ScheduleController extends AuthenticateController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function store(Request $request)
    {
      $input = Input::all();
      $input['user_id'] = $this->user->id;

      if (!$schedule = Schedule::create($input)) {
        return response()->json(['error'=>'Server error'], 403);
      }

      return response()->json($schedule);      
    }

    /**
     * Update schedule.
     *
     * @param $request
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $input = Input::all();
        $schedule = Schedule::find($id);

        $schedule->suggestion_accepted = $input['suggestion_accepted'];
        $schedule->staff_id = $input['staff_id'];
        
        try {
            $schedule->save();
            return response()->json($schedule);
        } catch(\Illuminate\Database\QueryException $ex){ 
            return response()->json(['error'=>'Server error'], 403);
        }
    }



    public function month($month)
    {
        $schedules = Schedule::where('user_id', $this->user->id)
        ->whereRaw('MONTH(datehr) = ?', [$month])
        ->get();

        return response()->json($schedules);
    }

    public function destroy($id) {
      $schedule = Schedule::find($id);
      if (empty($schedule)) {
        return response()->json(['error' => 'not_found'], 404);
      }
      if ($schedule->user_id !== $this->user->id) {
        return response()->json(['error' => 'permission_denied'], 403);
      }

      $schedule->delete();
      return response()->json(['message' => 'deleted']);
    }
}
