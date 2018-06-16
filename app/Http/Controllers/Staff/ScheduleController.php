<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\CreateScheduleRequest;
use App\Http\Requests\Staff\UpdateScheduleRequest;
use App\Repositories\Staff\ScheduleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Flash;
use Response;
use Auth;
use DB;

use App\Models\Staff\User;


class ScheduleController extends AppBaseController
{
    /** @var  ScheduleRepository */
    private $scheduleRepository;

    public function __construct(ScheduleRepository $scheduleRepo)
    {
        $this->scheduleRepository = $scheduleRepo;
    }

    /**
     * Display a listing of the Schedule.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $staff = Auth::guard('staff')->user();
        $where = ['staff_id'=> $staff->id];

        $this->scheduleRepository->pushCriteria(new RequestCriteria($request))->with('user');
        $this->scheduleRepository = $this->scheduleRepository->findWhere($where);
        $schedules = $this->scheduleRepository->all();

        return view('staff.schedules.index')
            ->with('schedules', $schedules);
    }

    /**
     * Show the form for creating a new Schedule.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.schedules.create')->with('users', $this->getUsers());
    }

    /**
     * Store a newly created Schedule in storage.
     *
     * @param CreateScheduleRequest $request
     *
     * @return Response
     */
    public function store(CreateScheduleRequest $request)
    {
        $input = $this->formatInput($request->all());
        $schedule = $this->scheduleRepository->create($input);

        Flash::success('Schedule saved successfully.');
        return redirect(route('staff.schedules.index'));
    }

    /**
     * Show the form for editing the specified Schedule.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $schedule = $this->scheduleRepository->findWithoutFail($id);

        if (empty($schedule)) {
            Flash::error('Schedule not found');

            return redirect(route('staff.schedules.index'));
        }

        return view('staff.schedules.edit')
            ->with('schedule', $schedule)
            ->with('users', $this->getUsers());
    }

    /**
     * Update the specified Schedule in storage.
     *
     * @param  int              $id
     * @param UpdateScheduleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateScheduleRequest $request)
    {
        $schedule = $this->scheduleRepository->findWithoutFail($id);

        if (empty($schedule)) {
            Flash::error('Schedule not found');

            return redirect(route('staff.schedules.index'));
        }

        $input = $this->formatInput($request->all());
        $schedule = $this->scheduleRepository->update($input, $id);

        Flash::success('Schedule updated successfully.');

        return redirect(route('staff.schedules.index'));
    }

    /**
     * Remove the specified Schedule from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $schedule = $this->scheduleRepository->findWithoutFail($id);

        if (empty($schedule)) {
            Flash::error('Schedule not found');

            return redirect(route('staff.schedules.index'));
        }

        $this->scheduleRepository->delete($id);

        Flash::success('Schedule deleted successfully.');

        return redirect(route('staff.schedules.index'));
    }

    private function getUsers()
    {
        $staff = Auth::guard('staff')->user();
        $food_name = "CONCAT('#', id, ' ', first_name, ' ', last_name) AS name";
        return User::where('staff_id', $staff->id)->select(DB::raw($food_name),'id')->pluck('name', 'id');
    }


    private function formatInput($input)
    {
        $staff = Auth::guard('staff')->user();
        $date = \DateTime::createFromFormat('d/m/Y H:i a', $input['date_date'].' '.$input['date_time']);

        $input['datehr'] =  $date->format('Y-m-d H:i:s');
        $input['staff_id'] = $staff->id;

        return $input;
    }
}
