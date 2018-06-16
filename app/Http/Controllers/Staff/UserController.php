<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\CreateUserRequest;
use App\Http\Requests\Staff\UpdateUserRequest;
use App\Repositories\Staff\UserRepository;
use App\Repositories\Staff\WaterRepository;
use App\Repositories\Staff\WeightRepository;
use App\Repositories\Staff\UserFoodRepository;
use App\Repositories\Staff\PhotoRepository;
use App\Repositories\Staff\UserMedicineRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;
    private $waterRepository;
    private $weightRepository;
    private $userFoodRepository;
    private $userMedicineRepository;
    private $photoRepository;

    public function __construct(
        UserRepository $userRepo, WaterRepository $waterRepo, WeightRepository $weightRepo,
        UserFoodRepository $userFoodRepo, UserMedicineRepository $userMedicineRepo,
        PhotoRepository $photoRepo
    ) {
        $this->userRepository = $userRepo;
        $this->waterRepository = $waterRepo;
        $this->weightRepository = $weightRepo;
        $this->userFoodRepository = $userFoodRepo;
        $this->userMedicineRepository = $userMedicineRepo;
        $this->photoRepository = $photoRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $staff = Auth::guard('staff')->user();
        $this->userRepository->pushCriteria(new RequestCriteria($request));

        if ($staff->id !== 1) {
            $this->userRepository = $this->userRepository->findByField('staff_id', $staff->id);
        }

        $users = $this->userRepository->all();

        return view('staff.users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $this->formatInput($request->all());
        $user = $this->userRepository->create($input);

        Flash::success('User saved successfully.');
        return redirect(route('staff.users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);


        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('staff.users.index'));
        }

        $waters = $this->waterRepository->findByField('user_id', $user->id);
        $weights = $this->weightRepository->findByField('user_id', $user->id);
        $foods = $this->userFoodRepository->findByField('user_id', $user->id);
        $medicines = $this->userMedicineRepository->findByField('user_id', $user->id);
        $photos = $this->photoRepository->findByField('user_id', $user->id);

        return view('staff.users.show')
            ->with('user', $user)
            ->with('waters', $waters)
            ->with('weights', $weights)
            ->with('medicines', $medicines)
            ->with('photos', $photos)
            ->with('foods', $foods);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('staff.users.index'));
        }

        return view('staff.users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('staff.users.index'));
        }

        $input = $this->formatInput($request->all());
        $user = $this->userRepository->update($input, $id);

        Flash::success('User updated successfully.');
        return redirect(route('staff.users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('staff.users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('staff.users.index'));
    }

    private function formatInput($input)
    {   
        if (isset($input['dt_operation'])) {
            $input['dt_operation'] =  implode('-', array_reverse(explode('/', $input['dt_operation'])));
        }
        if (isset($input['dt_end'])) {
            $input['dt_end'] =  implode('-', array_reverse(explode('/', $input['dt_end'])));
        }
        return $input;
    }

}
