<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\CreateAutomatedMsgRequest;
use App\Http\Requests\Staff\UpdateAutomatedMsgRequest;
use App\Repositories\Staff\AutomatedMsgRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;

class AutomatedMsgController extends AppBaseController
{
    /** @var  AutomatedMsgRepository */
    private $automatedMsgRepository;

    public function __construct(AutomatedMsgRepository $automatedMsgRepo)
    {
        $this->automatedMsgRepository = $automatedMsgRepo;
    }

    /**
     * Display a listing of the AutomatedMsg.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $staff = Auth::guard('staff')->user();
        $this->automatedMsgRepository->pushCriteria(new RequestCriteria($request));

        if ($staff->id !== 1) {
            $this->automatedMsgRepository = $this->automatedMsgRepository->findByField('staff_id', $this->staffId());
        }

        $automatedMsgs = $this->automatedMsgRepository->all();
        return view('staff.automated_msgs.index')
            ->with('automatedMsgs', $automatedMsgs);
    }

    /**
     * Show the form for creating a new AutomatedMsg.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.automated_msgs.create');
    }

    /**
     * Store a newly created AutomatedMsg in storage.
     *
     * @param CreateAutomatedMsgRequest $request
     *
     * @return Response
     */
    public function store(CreateAutomatedMsgRequest $request)
    {
        $input = $request->all();
        $input['staff_id'] = $this->staffId();
        $automatedMsg = $this->automatedMsgRepository->create($input);

        Flash::success('Automated Msg saved successfully.');

        return redirect(route('staff.automatedMsgs.index'));
    }

    /**
     * Display the specified AutomatedMsg.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $automatedMsg = $this->automatedMsgRepository->findWithoutFail($id);

        if (empty($automatedMsg)) {
            Flash::error('Automated Msg not found');

            return redirect(route('staff.automatedMsgs.index'));
        }

        return view('staff.automated_msgs.show')->with('automatedMsg', $automatedMsg);
    }

    /**
     * Show the form for editing the specified AutomatedMsg.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $automatedMsg = $this->automatedMsgRepository->findWithoutFail($id);

        if (empty($automatedMsg)) {
            Flash::error('Automated Msg not found');

            return redirect(route('staff.automatedMsgs.index'));
        }

        return view('staff.automated_msgs.edit')->with('automatedMsg', $automatedMsg);
    }

    /**
     * Update the specified AutomatedMsg in storage.
     *
     * @param  int              $id
     * @param UpdateAutomatedMsgRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAutomatedMsgRequest $request)
    {
        $automatedMsg = $this->automatedMsgRepository->findWithoutFail($id);

        if (empty($automatedMsg)) {
            Flash::error('Automated Msg not found');

            return redirect(route('staff.automatedMsgs.index'));
        }

        $automatedMsg = $this->automatedMsgRepository->update($request->all(), $id);

        Flash::success('Automated Msg updated successfully.');

        return redirect(route('staff.automatedMsgs.index'));
    }

    /**
     * Remove the specified AutomatedMsg from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $automatedMsg = $this->automatedMsgRepository->findWithoutFail($id);

        if (empty($automatedMsg)) {
            Flash::error('Automated Msg not found');

            return redirect(route('staff.automatedMsgs.index'));
        }

        $this->automatedMsgRepository->delete($id);

        Flash::success('Automated Msg deleted successfully.');

        return redirect(route('staff.automatedMsgs.index'));
    }
}
