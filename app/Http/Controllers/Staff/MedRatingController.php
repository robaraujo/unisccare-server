<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\CreateMedRatingRequest;
use App\Http\Requests\Staff\UpdateMedRatingRequest;
use App\Repositories\Staff\MedRatingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class MedRatingController extends AppBaseController
{
    /** @var  MedRatingRepository */
    private $medRatingRepository;

    public function __construct(MedRatingRepository $medRatingRepo)
    {
        $this->medRatingRepository = $medRatingRepo;
    }

    /**
     * Display a listing of the MedRating.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $staff = Auth::guard('staff')->user();
        $this->medRatingRepository->pushCriteria(new RequestCriteria($request));

        if ($staff->id !== 1) {
            $this->medRatingRepository = $this->medRatingRepository->findByField('staff_id', $this->staffId());
        }

        $medRatings = $this->medRatingRepository->all();
        return view('staff.med_ratings.index')
            ->with('medRatings', $medRatings);
    }

    /**
     * Show the form for creating a new MedRating.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.med_ratings.create');
    }

    /**
     * Store a newly created MedRating in storage.
     *
     * @param CreateMedRatingRequest $request
     *
     * @return Response
     */
    public function store(CreateMedRatingRequest $request)
    {
        $input = $request->all();

        $medRating = $this->medRatingRepository->create($input);

        Flash::success('Med Rating saved successfully.');

        return redirect(route('staff.medRatings.index'));
    }

    /**
     * Display the specified MedRating.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $medRating = $this->medRatingRepository->findWithoutFail($id);

        if (empty($medRating)) {
            Flash::error('Med Rating not found');

            return redirect(route('staff.medRatings.index'));
        }

        return view('staff.med_ratings.show')->with('medRating', $medRating);
    }

    /**
     * Show the form for editing the specified MedRating.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $medRating = $this->medRatingRepository->findWithoutFail($id);

        if (empty($medRating)) {
            Flash::error('Med Rating not found');

            return redirect(route('staff.medRatings.index'));
        }

        return view('staff.med_ratings.edit')->with('medRating', $medRating);
    }

    /**
     * Update the specified MedRating in storage.
     *
     * @param  int              $id
     * @param UpdateMedRatingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMedRatingRequest $request)
    {
        $medRating = $this->medRatingRepository->findWithoutFail($id);

        if (empty($medRating)) {
            Flash::error('Med Rating not found');

            return redirect(route('staff.medRatings.index'));
        }

        $medRating = $this->medRatingRepository->update($request->all(), $id);

        Flash::success('Med Rating updated successfully.');

        return redirect(route('staff.medRatings.index'));
    }

    /**
     * Remove the specified MedRating from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $medRating = $this->medRatingRepository->findWithoutFail($id);

        if (empty($medRating)) {
            Flash::error('Med Rating not found');

            return redirect(route('staff.medRatings.index'));
        }

        $this->medRatingRepository->delete($id);

        Flash::success('Med Rating deleted successfully.');

        return redirect(route('staff.medRatings.index'));
    }
}
