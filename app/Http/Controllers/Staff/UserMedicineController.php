<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\CreateUserMedicineRequest;
use App\Http\Requests\Staff\UpdateUserMedicineRequest;
use App\Repositories\Staff\UserMedicineRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserMedicineController extends AppBaseController
{
    /** @var  UserMedicineRepository */
    private $userMedicineRepository;

    public function __construct(UserMedicineRepository $userMedicineRepo)
    {
        $this->userMedicineRepository = $userMedicineRepo;
    }

    /**
     * Display a listing of the UserMedicine.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userMedicineRepository->pushCriteria(new RequestCriteria($request));
        $userMedicines = $this->userMedicineRepository->all();

        return view('staff.user_medicines.index')
            ->with('userMedicines', $userMedicines);
    }

    /**
     * Show the form for creating a new UserMedicine.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.user_medicines.create');
    }

    /**
     * Store a newly created UserMedicine in storage.
     *
     * @param CreateUserMedicineRequest $request
     *
     * @return Response
     */
    public function store(CreateUserMedicineRequest $request)
    {
        $input = $request->all();

        $userMedicine = $this->userMedicineRepository->create($input);

        Flash::success('User Medicine saved successfully.');

        return redirect(route('staff.userMedicines.index'));
    }

    /**
     * Display the specified UserMedicine.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userMedicine = $this->userMedicineRepository->findWithoutFail($id);

        if (empty($userMedicine)) {
            Flash::error('User Medicine not found');

            return redirect(route('staff.userMedicines.index'));
        }

        return view('staff.user_medicines.show')->with('userMedicine', $userMedicine);
    }

    /**
     * Show the form for editing the specified UserMedicine.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userMedicine = $this->userMedicineRepository->findWithoutFail($id);

        if (empty($userMedicine)) {
            Flash::error('User Medicine not found');

            return redirect(route('staff.userMedicines.index'));
        }

        return view('staff.user_medicines.edit')->with('userMedicine', $userMedicine);
    }

    /**
     * Update the specified UserMedicine in storage.
     *
     * @param  int              $id
     * @param UpdateUserMedicineRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserMedicineRequest $request)
    {
        $userMedicine = $this->userMedicineRepository->findWithoutFail($id);

        if (empty($userMedicine)) {
            Flash::error('User Medicine not found');

            return redirect(route('staff.userMedicines.index'));
        }

        $userMedicine = $this->userMedicineRepository->update($request->all(), $id);

        Flash::success('User Medicine updated successfully.');

        return redirect(route('staff.userMedicines.index'));
    }

    /**
     * Remove the specified UserMedicine from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userMedicine = $this->userMedicineRepository->findWithoutFail($id);

        if (empty($userMedicine)) {
            Flash::error('User Medicine not found');

            return redirect(route('staff.userMedicines.index'));
        }

        $this->userMedicineRepository->delete($id);

        Flash::success('User Medicine deleted successfully.');

        return redirect(route('staff.userMedicines.index'));
    }
}
