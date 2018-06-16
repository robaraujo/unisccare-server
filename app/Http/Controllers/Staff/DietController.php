<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\CreateDietRequest;
use App\Http\Requests\Staff\UpdateDietRequest;
use App\Repositories\Staff\DietRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use DB;

use App\Models\Staff\Diet;
use App\Models\Staff\User;
use App\Models\Staff\Food;

class DietController extends AppBaseController
{
    /** @var  DietRepository */
    private $dietRepository;

    public function __construct(DietRepository $dietRepo)
    {
        $this->dietRepository = $dietRepo;
    }

    /**
     * Display a listing of the Diet.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $staff = Auth::guard('staff')->user();
        $this->dietRepository->pushCriteria(new RequestCriteria($request));
        $this->dietRepository = $this->dietRepository->findByField('staff_id', $staff->id);
        $diets = $this->dietRepository->all();

        return view('staff.diets.index')
            ->with('diets', $diets);
    }

    /**
     * Show the form for creating a new Diet.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.diets.create')
            ->with('foods', $this->getFoods())
            ->with('users', $this->getUsers())
            ->with('selected_users', [])
            ->with('selected_foods', ['food_id'=> 1, 'qtt'=>1]);
    }

    /**
     * Store a newly created Diet in storage.
     *
     * @param CreateDietRequest $request
     *
     * @return Response
     */
    public function store(CreateDietRequest $request)
    {
        $input = $this->prepareFields($request->all());
        $diet = $this->dietRepository->create($input);

        Flash::success('Diet saved successfully.');
        return redirect(route('staff.diets.index'));
    }

    /**
     * Display the specified Diet.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $diet = $this->dietRepository->findWithoutFail($id);

        if (empty($diet)) {
            Flash::error('Diet not found');

            return redirect(route('staff.diets.index'));
        }

        return view('staff.diets.show')->with('diet', $diet);
    }

    /**
     * Show the form for editing the specified Diet.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        
        $diet = $this->dietRepository->findWithoutFail($id);

        if (empty($diet)) {
            Flash::error('Diet not found');

            return redirect(route('staff.diets.index'));
        }

        return view('staff.diets.edit')
            ->with('diet', $diet)
            ->with('foods', $this->getFoods())
            ->with('users', $this->getUsers())
            ->with('selected_users', $this->getSelectedUsers($diet))
            ->with('selected_foods', $this->getSelectedFoods($diet));
    }

    private function prepareFields($input)
    {
        $staff = Auth::guard('staff')->user();
        $input['food_ids'] = implode(',', $input['food_id']);
        $input['food_qtts'] = implode(',', $input['food_qtt']);
        $input['user_ids'] = implode(',', $input['user_id']);
        $input['staff_id'] = $staff->id;

        return $input;
    }

    /**
     * Return Array(food{id, qtt});
     */
    private function getSelectedFoods($diet)
    {
        $food_ids = array_map('intval', explode(',', $diet['food_ids']));
        $food_qtts = array_map('intval', explode(',', $diet['food_qtts']));
        $foods = [];
        
        foreach($food_ids as $i=> $food) {
            $foods[] = ['food_id'=> $food, 'qtt'=> $food_qtts[$i]];
        }

        return $foods;
    }

    private function getSelectedUsers($diet)
    {
        return array_map('intval', explode(',', $diet['user_ids']));
    }

    private function getUsers()
    {
        $staff = Auth::guard('staff')->user();
        $food_name = "CONCAT('#', id, ' ', first_name, ' ', last_name) AS name";
        return User::where('staff_id', $staff->id)->select(DB::raw($food_name),'id')->pluck('name', 'id');
    }

    private function getFoods()
    {
        return Food::select(DB::raw("CONCAT(portion,unity,' ',name) AS title"),'id')->pluck('title', 'id');
    }

    /**
     * Update the specified Diet in storage.
     *
     * @param  int              $id
     * @param UpdateDietRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDietRequest $request)
    {
        $diet = $this->dietRepository->findWithoutFail($id);

        if (empty($diet)) {
            Flash::error('Diet not found');

            return redirect(route('staff.diets.index'));
        }

        $input = $this->prepareFields($request->all());
        $diet = $this->dietRepository->update($input, $id);

        Flash::success('Diet updated successfully.');
        return redirect(route('staff.diets.index'));
    }

    /**
     * Remove the specified Diet from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $diet = $this->dietRepository->findWithoutFail($id);

        if (empty($diet)) {
            Flash::error('Diet not found');

            return redirect(route('staff.diets.index'));
        }

        $this->dietRepository->delete($id);

        Flash::success('Diet deleted successfully.');

        return redirect(route('staff.diets.index'));
    }
}
