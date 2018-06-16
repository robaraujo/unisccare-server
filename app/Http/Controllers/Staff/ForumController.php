<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\CreateForumRequest;
use App\Http\Requests\Staff\UpdateForumRequest;
use App\Repositories\Staff\ForumRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ForumController extends AppBaseController
{
    /** @var  ForumRepository */
    private $forumRepository;

    public function __construct(ForumRepository $forumRepo)
    {
        $this->forumRepository = $forumRepo;
    }

    /**
     * Display a listing of the Forum.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->forumRepository->pushCriteria(new RequestCriteria($request));
        $forums = $this->forumRepository->all();

        return view('staff.forums.index')
            ->with('forums', $forums);
    }

    /**
     * Show the form for creating a new Forum.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.forums.create');
    }

    /**
     * Store a newly created Forum in storage.
     *
     * @param CreateForumRequest $request
     *
     * @return Response
     */
    public function store(CreateForumRequest $request)
    {
        $input = $request->all();

        $forum = $this->forumRepository->create($input);

        Flash::success('Forum saved successfully.');

        return redirect(route('staff.forums.index'));
    }

    /**
     * Display the specified Forum.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $forum = $this->forumRepository->findWithoutFail($id);

        if (empty($forum)) {
            Flash::error('Forum not found');

            return redirect(route('staff.forums.index'));
        }

        return view('staff.forums.show')->with('forum', $forum);
    }

    /**
     * Show the form for editing the specified Forum.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $forum = $this->forumRepository->findWithoutFail($id);

        if (empty($forum)) {
            Flash::error('Forum not found');

            return redirect(route('staff.forums.index'));
        }

        return view('staff.forums.edit')->with('forum', $forum);
    }

    /**
     * Update the specified Forum in storage.
     *
     * @param  int              $id
     * @param UpdateForumRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateForumRequest $request)
    {
        $forum = $this->forumRepository->findWithoutFail($id);

        if (empty($forum)) {
            Flash::error('Forum not found');

            return redirect(route('staff.forums.index'));
        }

        $forum = $this->forumRepository->update($request->all(), $id);

        Flash::success('Forum updated successfully.');

        return redirect(route('staff.forums.index'));
    }

    /**
     * Remove the specified Forum from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $forum = $this->forumRepository->findWithoutFail($id);

        if (empty($forum)) {
            Flash::error('Forum not found');

            return redirect(route('staff.forums.index'));
        }

        $this->forumRepository->delete($id);

        Flash::success('Forum deleted successfully.');

        return redirect(route('staff.forums.index'));
    }
}
