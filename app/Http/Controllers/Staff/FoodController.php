<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\CreateFoodRequest;
use App\Http\Requests\Staff\UpdateFoodRequest;
use App\Repositories\Staff\FoodRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class FoodController extends AppBaseController
{
    /** @var  FoodRepository */
    private $foodRepository;

    public function __construct(FoodRepository $foodRepo)
    {
        $this->foodRepository = $foodRepo;
    }

    /**
     * Display a listing of the Food.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->foodRepository->pushCriteria(new RequestCriteria($request));
        $foods = $this->foodRepository->all();

        return view('staff.foods.index')
            ->with('foods', $foods);
    }

    /**
     * Show the form for creating a new Food.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.foods.create');
    }

    /**
     * Store a newly created Food in storage.
     *
     * @param CreateFoodRequest $request
     *
     * @return Response
     */
    public function store(CreateFoodRequest $request)
    {
        $input = $request->all();

        $food = $this->foodRepository->create($input);

        Flash::success('Food saved successfully.');

        return redirect(route('staff.foods.index'));
    }

    /**
     * Display the specified Food.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $food = $this->foodRepository->findWithoutFail($id);

        if (empty($food)) {
            Flash::error('Food not found');

            return redirect(route('staff.foods.index'));
        }

        return view('staff.foods.show')->with('food', $food);
    }

    /**
     * Show the form for editing the specified Food.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $food = $this->foodRepository->findWithoutFail($id);

        if (empty($food)) {
            Flash::error('Food not found');

            return redirect(route('staff.foods.index'));
        }

        return view('staff.foods.edit')->with('food', $food);
    }

    /**
     * Update the specified Food in storage.
     *
     * @param  int              $id
     * @param UpdateFoodRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFoodRequest $request)
    {
        $food = $this->foodRepository->findWithoutFail($id);

        if (empty($food)) {
            Flash::error('Food not found');

            return redirect(route('staff.foods.index'));
        }

        $food = $this->foodRepository->update($request->all(), $id);

        Flash::success('Food updated successfully.');

        return redirect(route('staff.foods.index'));
    }

    /**
     * Remove the specified Food from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $food = $this->foodRepository->findWithoutFail($id);

        if (empty($food)) {
            Flash::error('Food not found');

            return redirect(route('staff.foods.index'));
        }

        $this->foodRepository->delete($id);

        Flash::success('Food deleted successfully.');

        return redirect(route('staff.foods.index'));
    }
}
