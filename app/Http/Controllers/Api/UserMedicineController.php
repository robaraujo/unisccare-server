<?php

namespace App\Http\Controllers\Api;
use App\Models\Staff\UserMedicine;
use App\Models\Staff\Medicine;
use App\Models\Staff\User;
use App\Http\Controllers\AuthenticateController;
use Input;
use Request;

class UserMedicineController extends AuthenticateController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the UserMedicine.
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        // ultimas comidas consumidar por user
        $user_medicines = UserMedicine::where('user_id', $this->user->id)
          ->with('medicine')
          ->limit(10)
          ->orderBy('id', 'DESC')
          ->get();

        return response()->json([
          'user_medicines'=>$user_medicines,
          'medicines'     => Medicine::get()
        ]);
    }

    /**
     * Store a newly created UserMedicine in storage.
     *
     * @param CreateUserMedicineRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = Input::all();
        $input['user_id'] = $this->user->id;
        $medicine = Medicine::find($input['medicine_id']);

        if (!$medicine) $this->sendAjax('Alimento não existe.', false);
        if (!$input['qtt'] || !is_numeric($input['qtt'])) {
            return response()->json('Medicine quantity must be over 0.', 403);
        }

        if ($user_medicine = UserMedicine::create($input)) {
          User::where('id', $this->user->id)->increment('points', 50);
          $user_medicine->medicine = $medicine;
          return response()->json($user_medicine);
        }

        return response()->json('Server error.', 403);
    }
}
