<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\CreateWeightRequest;
use App\Http\Requests\Staff\UpdateWeightRequest;
use App\Repositories\Staff\WeightRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class WeightController extends AppBaseController
{
    /** @var  WeightRepository */
    private $weightRepository;

    public function __construct(WeightRepository $weightRepo)
    {
        $this->weightRepository = $weightRepo;
    }

    /**
     * Display a listing of the Weight.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->weightRepository->pushCriteria(new RequestCriteria($request));
        $weights = $this->weightRepository->all();

        return view('staff.weights.index')
            ->with('weights', $weights);
    }

    /**
     * Show the form for creating a new Weight.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.weights.create');
    }

    /**
     * Store a newly created Weight in storage.
     *
     * @param CreateWeightRequest $request
     *
     * @return Response
     */
    public function store(CreateWeightRequest $request)
    {
        $input = $request->all();

        $weight = $this->weightRepository->create($input);

        Flash::success('Weight saved successfully.');

        return redirect(route('staff.weights.index'));
    }

    /**
     * Display the specified Weight.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $weight = $this->weightRepository->findWithoutFail($id);

        if (empty($weight)) {
            Flash::error('Weight not found');

            return redirect(route('staff.weights.index'));
        }

        return view('staff.weights.show')->with('weight', $weight);
    }

    /**
     * Show the form for editing the specified Weight.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $weight = $this->weightRepository->findWithoutFail($id);

        if (empty($weight)) {
            Flash::error('Weight not found');

            return redirect(route('staff.weights.index'));
        }

        return view('staff.weights.edit')->with('weight', $weight);
    }

    /**
     * Update the specified Weight in storage.
     *
     * @param  int              $id
     * @param UpdateWeightRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWeightRequest $request)
    {
        $weight = $this->weightRepository->findWithoutFail($id);

        if (empty($weight)) {
            Flash::error('Weight not found');

            return redirect(route('staff.weights.index'));
        }

        $weight = $this->weightRepository->update($request->all(), $id);

        Flash::success('Weight updated successfully.');

        return redirect(route('staff.weights.index'));
    }

    /**
     * Remove the specified Weight from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $weight = $this->weightRepository->findWithoutFail($id);

        if (empty($weight)) {
            Flash::error('Weight not found');

            return redirect(route('staff.weights.index'));
        }

        $this->weightRepository->delete($id);

        Flash::success('Weight deleted successfully.');

        return redirect(route('staff.weights.index'));
    }
}
