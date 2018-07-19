<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\Staff\CreateMsgRequest;
use App\Http\Requests\Staff\UpdateMsgRequest;
use App\Repositories\Staff\MsgRepository;
use App\Http\Controllers\AppBaseController;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Request;
use Response;
use Flash;
use Auth;

use App\Models\Staff\User;
use App\Models\Staff\Msg;

class MsgController extends AppBaseController
{
    /** @var  MsgRepository */
    private $msgRepository;

    public function __construct(MsgRepository $msgRepo)
    {
        $this->msgRepository = $msgRepo;
    }

    /**
     * Display a listing of the Msg.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = User::where('staff_id', $this->staffId());

        return view('staff.msgs.index')
            ->with('users', $users);
    }

    /**
     * Display users
     *
     * @param Request $request
     * @return Response
     */
    public function users(Request $request)
    {
        $users = User::where('staff_id', $this->staffId())->get();

        foreach ($users as $key => $user) {
            $user->last_msg = Msg::where('user_id', $user->id)->latest()->first();
        }

        return response()->json( $users );
    }

    public function list(Request $request)
    {
        $input = $request->all();

        if (!isset($input['user_id'], $input['last_msg'])) {
            return response()->json(['error' => 'invalid_form'], 403);
        }
        
        $msgs = Msg::where('user_id', $input['user_id'])
            ->where('id', '>', $input['last_msg'])
            ->get();

        return response()->json($msgs);
    }

    /**
     * Store Msg in storage.
     *
     * @param CreateMsgRequest $request
     *
     * @return Response
     */
    public function store(CreateMsgRequest $request)
    {
        $input = $request->all();
        $input['from'] = 'staff';
        $input['automatic'] = false;
        $input['staff_id'] = Auth::guard('staff')->user()->id;
        $msg = $this->msgRepository->create($input);

        return response()->json($msg);        
    }

    /**
     * Remove the specified Msg from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $msg = $this->msgRepository->findWithoutFail($id);

        if (empty($msg)) {
            Flash::error('Msg not found');

            return redirect(route('staff.msgs.index'));
        }

        $this->msgRepository->delete($id);

        Flash::success('Msg deleted successfully.');

        return redirect(route('staff.msgs.index'));
    }
}
