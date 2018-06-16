<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\CreateUserFollowRequest;
use App\Http\Requests\Staff\UpdateUserFollowRequest;
use App\Repositories\Staff\UserFollowRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserFollowController extends AppBaseController
{
    /** @var  UserFollowRepository */
    private $userFollowRepository;

    public function __construct(UserFollowRepository $userFollowRepo)
    {
        $this->userFollowRepository = $userFollowRepo;
    }

    /**
     * Display a listing of the UserFollow.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userFollowRepository->pushCriteria(new RequestCriteria($request));
        $userFollows = $this->userFollowRepository->all();

        return view('staff.user_follows.index')
            ->with('userFollows', $userFollows);
    }

    /**
     * Show the form for creating a new UserFollow.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.user_follows.create');
    }

    /**
     * Store a newly created UserFollow in storage.
     *
     * @param CreateUserFollowRequest $request
     *
     * @return Response
     */
    public function store(CreateUserFollowRequest $request)
    {
        $input = $request->all();

        $userFollow = $this->userFollowRepository->create($input);

        Flash::success('User Follow saved successfully.');

        return redirect(route('staff.userFollows.index'));
    }

    /**
     * Display the specified UserFollow.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userFollow = $this->userFollowRepository->findWithoutFail($id);

        if (empty($userFollow)) {
            Flash::error('User Follow not found');

            return redirect(route('staff.userFollows.index'));
        }

        return view('staff.user_follows.show')->with('userFollow', $userFollow);
    }

    /**
     * Show the form for editing the specified UserFollow.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userFollow = $this->userFollowRepository->findWithoutFail($id);

        if (empty($userFollow)) {
            Flash::error('User Follow not found');

            return redirect(route('staff.userFollows.index'));
        }

        return view('staff.user_follows.edit')->with('userFollow', $userFollow);
    }

    /**
     * Update the specified UserFollow in storage.
     *
     * @param  int              $id
     * @param UpdateUserFollowRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserFollowRequest $request)
    {
        $userFollow = $this->userFollowRepository->findWithoutFail($id);

        if (empty($userFollow)) {
            Flash::error('User Follow not found');

            return redirect(route('staff.userFollows.index'));
        }

        $userFollow = $this->userFollowRepository->update($request->all(), $id);

        Flash::success('User Follow updated successfully.');

        return redirect(route('staff.userFollows.index'));
    }

    /**
     * Remove the specified UserFollow from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userFollow = $this->userFollowRepository->findWithoutFail($id);

        if (empty($userFollow)) {
            Flash::error('User Follow not found');

            return redirect(route('staff.userFollows.index'));
        }

        $this->userFollowRepository->delete($id);

        Flash::success('User Follow deleted successfully.');

        return redirect(route('staff.userFollows.index'));
    }
}
