<?php

namespace App\Http\Controllers\Api;
use App\Models\Staff\Photo;
use App\Models\Staff\User;
use App\Http\Controllers\AuthenticateController;
use Image;
use Input;
use Request;

class PhotoController extends AuthenticateController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the Photo.
     *
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        $photos = Photo::where('user_id', $this->user->id)
          ->limit(5)
          ->orderBy('id', 'DESC')
          ->get();

        return response()->json($photos);
    }

    /**
     * Store a newly created Photo in storage.
     *
     * @param CreatePhotoRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $path = public_path().'/img/uploads/';
        $input = Input::all();
        $file = Image::make(Input::file('file'));
        $input['user_id'] = $this->user->id;
        $input['filename'] = $this->user->id.'-'.uniqid().'.png';

        if (isset($input['is_avatar']) && $input['is_avatar']) {
            $path = public_path().'/img/users/';
            $input['filename'] = $this->user->id.'.png';            
        }

        User::where('id', $this->user->id)->increment('points', 50);
        $file->save($path.$input['filename']);
        $photo = Photo::create($input);
        $this->sendAjax($photo);
    }
}
