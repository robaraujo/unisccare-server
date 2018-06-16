<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\CreateStepRequest;
use App\Http\Requests\Staff\UpdateStepRequest;
use App\Repositories\Staff\StepRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class StepController extends AppBaseController
{
    /** @var  StepRepository */
    private $stepRepository;

    public function __construct(StepRepository $stepRepo)
    {
        $this->stepRepository = $stepRepo;
    }

    /**
     * Display a listing of the Step.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->stepRepository->pushCriteria(new RequestCriteria($request));
        $steps = $this->stepRepository->all();

        return view('staff.steps.index')
            ->with('steps', $steps);
    }

    /**
     * Show the form for creating a new Step.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.steps.create');
    }

    /**
     * Store a newly created Step in storage.
     *
     * @param CreateStepRequest $request
     *
     * @return Response
     */
    public function store(CreateStepRequest $request)
    {
        $input = $request->all();

        $step = $this->stepRepository->create($input);

        Flash::success('Step saved successfully.');

        return redirect(route('staff.steps.index'));
    }

    /**
     * Display the specified Step.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $step = $this->stepRepository->findWithoutFail($id);

        if (empty($step)) {
            Flash::error('Step not found');

            return redirect(route('staff.steps.index'));
        }

        return view('staff.steps.show')->with('step', $step);
    }

    /**
     * Show the form for editing the specified Step.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $step = $this->stepRepository->findWithoutFail($id);

        if (empty($step)) {
            Flash::error('Step not found');

            return redirect(route('staff.steps.index'));
        }

        return view('staff.steps.edit')->with('step', $step);
    }

    /**
     * Update the specified Step in storage.
     *
     * @param  int              $id
     * @param UpdateStepRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStepRequest $request)
    {
        $step = $this->stepRepository->findWithoutFail($id);

        if (empty($step)) {
            Flash::error('Step not found');

            return redirect(route('staff.steps.index'));
        }

        $step = $this->stepRepository->update($request->all(), $id);

        Flash::success('Step updated successfully.');

        return redirect(route('staff.steps.index'));
    }

    /**
     * Remove the specified Step from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $step = $this->stepRepository->findWithoutFail($id);

        if (empty($step)) {
            Flash::error('Step not found');

            return redirect(route('staff.steps.index'));
        }

        $this->stepRepository->delete($id);

        Flash::success('Step deleted successfully.');

        return redirect(route('staff.steps.index'));
    }
}
