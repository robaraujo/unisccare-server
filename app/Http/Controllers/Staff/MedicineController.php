<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\CreateMedicineRequest;
use App\Http\Requests\Staff\UpdateMedicineRequest;
use App\Repositories\Staff\MedicineRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MedicineController extends AppBaseController
{
    /** @var  MedicineRepository */
    private $medicineRepository;

    public function __construct(MedicineRepository $medicineRepo)
    {
        $this->medicineRepository = $medicineRepo;
    }

    /**
     * Display a listing of the Medicine.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->medicineRepository->pushCriteria(new RequestCriteria($request));
        $medicines = $this->medicineRepository->all();

        return view('staff.medicines.index')
            ->with('medicines', $medicines);
    }

    /**
     * Show the form for creating a new Medicine.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.medicines.create');
    }

    /**
     * Store a newly created Medicine in storage.
     *
     * @param CreateMedicineRequest $request
     *
     * @return Response
     */
    public function store(CreateMedicineRequest $request)
    {
        $input = $request->all();

        $medicine = $this->medicineRepository->create($input);

        Flash::success('Medicine saved successfully.');

        return redirect(route('staff.medicines.index'));
    }

    /**
     * Display the specified Medicine.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $medicine = $this->medicineRepository->findWithoutFail($id);

        if (empty($medicine)) {
            Flash::error('Medicine not found');

            return redirect(route('staff.medicines.index'));
        }

        return view('staff.medicines.show')->with('medicine', $medicine);
    }

    /**
     * Show the form for editing the specified Medicine.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $medicine = $this->medicineRepository->findWithoutFail($id);

        if (empty($medicine)) {
            Flash::error('Medicine not found');

            return redirect(route('staff.medicines.index'));
        }

        return view('staff.medicines.edit')->with('medicine', $medicine);
    }

    /**
     * Update the specified Medicine in storage.
     *
     * @param  int              $id
     * @param UpdateMedicineRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedicineRequest $request)
    {
        $medicine = $this->medicineRepository->findWithoutFail($id);

        if (empty($medicine)) {
            Flash::error('Medicine not found');

            return redirect(route('staff.medicines.index'));
        }

        $medicine = $this->medicineRepository->update($request->all(), $id);

        Flash::success('Medicine updated successfully.');

        return redirect(route('staff.medicines.index'));
    }

    /**
     * Remove the specified Medicine from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $medicine = $this->medicineRepository->findWithoutFail($id);

        if (empty($medicine)) {
            Flash::error('Medicine not found');

            return redirect(route('staff.medicines.index'));
        }

        $this->medicineRepository->delete($id);

        Flash::success('Medicine deleted successfully.');

        return redirect(route('staff.medicines.index'));
    }
}
