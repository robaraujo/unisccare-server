<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\CreateStaffRequest;
use App\Http\Requests\Staff\UpdateStaffRequest;
use App\Repositories\Staff\StaffRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Flash;
use Auth;
use Hash;

class StaffController extends AppBaseController
{
    /** @var  StaffRepository */
    private $staffRepository;

    public function __construct(StaffRepository $staffRepo)
    {
        $this->staffRepository = $staffRepo;
    }

    /**
     * Display a listing of the Staff.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->staffRepository->pushCriteria(new RequestCriteria($request));
        $this->staffRepository = $this->staffRepository->findWhere(['staff_admin'=> $this->staffId()]);
        $staff = $this->staffRepository->all();

        return view('staff.staff.index')
            ->with('staff', $staff);
    }

    /**
     * Show the form for creating a new Staff.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.staff.create');
    }

    /**
     * Store a newly created Staff in storage.
     *
     * @param CreateStaffRequest $request
     *
     * @return Response
     */
    public function store(CreateStaffRequest $request)
    {
        $input = $this->prepareInput($request->all());
        $input['staff_admin'] = $this->staffId();
        
        $staff = $this->staffRepository->create($input);
        Flash::success('Staff saved successfully.');

        return redirect(route('staff.staff.index'));
    }

    /**
     * Display the specified Staff.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $staff = $this->staffRepository->findWithoutFail($id);

        if (empty($staff)) {
            Flash::error('Staff not found');

            return redirect(route('staff.staff.index'));
        }

        return view('staff.staff.show')->with('staff', $staff);
    }

    /**
     * Show the form for editing the specified Staff.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $staff = $this->staffRepository->findWithoutFail($id);

        if (empty($staff)) {
            Flash::error('Staff not found');

            return redirect(route('staff.staff.index'));
        }

        $staff->access = explode(',', $staff->access);
        return view('staff.staff.edit')->with('staff', $staff);
    }

    /**
     * Update the specified Staff in storage.
     *
     * @param  int              $id
     * @param UpdateStaffRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStaffRequest $request)
    {
        $staff = $this->staffRepository->findWithoutFail($id);

        if (empty($staff)) {
            Flash::error('Staff not found');

            return redirect(route('staff.staff.index'));
        }

        $input = $this->prepareInput($request->all());
        $staff = $this->staffRepository->update($input, $id);

        Flash::success('Staff updated successfully.');
        return redirect(route('staff.staff.index'));
    }

    private function prepareInput($input)
    {    
        $input['access'] = implode(',', $input['access']);
        if ($input['password']) {
            $input['password'] = Hash::make($input['password']);
        }

        return $input;
    }

    /**
     * Remove the specified Staff from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $staff = $this->staffRepository->findWithoutFail($id);

        if (empty($staff)) {
            Flash::error('Staff not found');

            return redirect(route('staff.staff.index'));
        }

        $this->staffRepository->delete($id);

        Flash::success('Staff deleted successfully.');

        return redirect(route('staff.staff.index'));
    }
}
