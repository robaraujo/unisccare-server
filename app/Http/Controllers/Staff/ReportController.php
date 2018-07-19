<?php

namespace App\Http\Controllers\Staff;
use App\Http\Controllers\AppBaseController;
use App\Models\Staff\Weight;
use Illuminate\Http\Request;
use App\Models\Staff\User;
use Auth;
use DB;

class ReportController extends AppBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function food(Request $request)
    {
        return $this->report($request, 'food');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function water(Request $request)
    {
        return $this->report($request, 'water');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function step(Request $request)
    {
        return $this->report($request, 'step');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function medicine(Request $request)
    {
        return $this->report($request, 'medicine');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function weight(Request $request)
    {
        $result = $this->report($request, 'weight');
        $date = $request->get('date');

        // if result is empty, use last result before
        if ($date && !count($result->getData())) {
            $usDate = implode('-', array_reverse(explode('/', $date)));
            $lst = Weight::where('created_at','<', $usDate)->orderBy('id', 'desc')->first();
            $lst->created_at = "{$usDate} 12:00:00";
            $result->setData([$lst]);
        }

        return $result;
    }

    /**
     * call Model::report assigning parametes
     */
    private function report($request, $type)
    {
        $class = 'App\Models\Staff\\'.ucfirst($type);
        $result = null;
        $input = $request->all();
        $food_name = "CONCAT('#', id, ' ', first_name, ' ', last_name) AS name";
        $users = User::where('staff_id', $this->staffId())->select(DB::raw($food_name),'id')->pluck('name', 'id');

        if (isset($input['date'], $input['user_id'])) {
            list($day, $month, $year) = explode('/', $input['date']);
            $result = $class::report($input['user_id'], $input['view'], $year, $month, $day);

            return response()->json($result);
        }

        return view("staff.reports.{$type}")
                ->with('users', $users)
                ->with('result', $result);
    }
}
