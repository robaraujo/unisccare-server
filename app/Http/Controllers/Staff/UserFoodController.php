<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\CreateUserFoodRequest;
use App\Http\Requests\Staff\UpdateUserFoodRequest;
use App\Repositories\Staff\UserFoodRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserFoodController extends AppBaseController
{
    /** @var  UserFoodRepository */
    private $userFoodRepository;

    public function __construct(UserFoodRepository $userFoodRepo)
    {
        $this->userFoodRepository = $userFoodRepo;
    }

    /**
     * Display a listing of the UserFood.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userFoodRepository->pushCriteria(new RequestCriteria($request));
        $userFoods = $this->userFoodRepository->all();

        return view('staff.user_foods.index')
            ->with('userFoods', $userFoods);
    }

    /**
     * Show the form for creating a new UserFood.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.user_foods.create');
    }

    /**
     * Store a newly created UserFood in storage.
     *
     * @param CreateUserFoodRequest $request
     *
     * @return Response
     */
    public function store(CreateUserFoodRequest $request)
    {
        $input = $request->all();

        $userFood = $this->userFoodRepository->create($input);

        Flash::success('User Food saved successfully.');

        return redirect(route('staff.userFoods.index'));
    }

    /**
     * Display the specified UserFood.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userFood = $this->userFoodRepository->findWithoutFail($id);

        if (empty($userFood)) {
            Flash::error('User Food not found');

            return redirect(route('staff.userFoods.index'));
        }

        return view('staff.user_foods.show')->with('userFood', $userFood);
    }

    /**
     * Show the form for editing the specified UserFood.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userFood = $this->userFoodRepository->findWithoutFail($id);

        if (empty($userFood)) {
            Flash::error('User Food not found');

            return redirect(route('staff.userFoods.index'));
        }

        return view('staff.user_foods.edit')->with('userFood', $userFood);
    }

    /**
     * Update the specified UserFood in storage.
     *
     * @param  int              $id
     * @param UpdateUserFoodRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserFoodRequest $request)
    {
        $userFood = $this->userFoodRepository->findWithoutFail($id);

        if (empty($userFood)) {
            Flash::error('User Food not found');

            return redirect(route('staff.userFoods.index'));
        }

        $userFood = $this->userFoodRepository->update($request->all(), $id);

        Flash::success('User Food updated successfully.');

        return redirect(route('staff.userFoods.index'));
    }

    /**
     * Remove the specified UserFood from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userFood = $this->userFoodRepository->findWithoutFail($id);

        if (empty($userFood)) {
            Flash::error('User Food not found');

            return redirect(route('staff.userFoods.index'));
        }

        $this->userFoodRepository->delete($id);

        Flash::success('User Food deleted successfully.');

        return redirect(route('staff.userFoods.index'));
    }
}
