<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\CreateWaterRequest;
use App\Http\Requests\Staff\UpdateWaterRequest;
use App\Repositories\Staff\WaterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class WaterController extends AppBaseController
{
    /** @var  WaterRepository */
    private $waterRepository;

    public function __construct(WaterRepository $waterRepo)
    {
        $this->waterRepository = $waterRepo;
    }

    /**
     * Display a listing of the Water.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->waterRepository->pushCriteria(new RequestCriteria($request));
        $waters = $this->waterRepository->all();

        return view('staff.waters.index')
            ->with('waters', $waters);
    }

    /**
     * Show the form for creating a new Water.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.waters.create');
    }

    /**
     * Store a newly created Water in storage.
     *
     * @param CreateWaterRequest $request
     *
     * @return Response
     */
    public function store(CreateWaterRequest $request)
    {
        $input = $request->all();

        $water = $this->waterRepository->create($input);

        Flash::success('Water saved successfully.');

        return redirect(route('staff.waters.index'));
    }

    /**
     * Display the specified Water.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $water = $this->waterRepository->findWithoutFail($id);

        if (empty($water)) {
            Flash::error('Water not found');

            return redirect(route('staff.waters.index'));
        }

        return view('staff.waters.show')->with('water', $water);
    }

    /**
     * Show the form for editing the specified Water.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $water = $this->waterRepository->findWithoutFail($id);

        if (empty($water)) {
            Flash::error('Water not found');

            return redirect(route('staff.waters.index'));
        }

        return view('staff.waters.edit')->with('water', $water);
    }

    /**
     * Update the specified Water in storage.
     *
     * @param  int              $id
     * @param UpdateWaterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWaterRequest $request)
    {
        $water = $this->waterRepository->findWithoutFail($id);

        if (empty($water)) {
            Flash::error('Water not found');

            return redirect(route('staff.waters.index'));
        }

        $water = $this->waterRepository->update($request->all(), $id);

        Flash::success('Water updated successfully.');

        return redirect(route('staff.waters.index'));
    }

    /**
     * Remove the specified Water from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $water = $this->waterRepository->findWithoutFail($id);

        if (empty($water)) {
            Flash::error('Water not found');

            return redirect(route('staff.waters.index'));
        }

        $this->waterRepository->delete($id);

        Flash::success('Water deleted successfully.');

        return redirect(route('staff.waters.index'));
    }
}
