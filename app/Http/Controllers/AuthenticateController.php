<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Route;

class AuthenticateController extends Controller
{
   public $user = null;

   public function __construct()
   {
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
       $opened = ['authenticate', 'register', 'listStaffs'];
       $this->middleware('auth:api', ['except' => $opened]);

       $route = explode('@', Route::currentRouteAction());
       if (!in_array($route[1], $opened)) {
         $this->user = JWTAuth::parseToken()->authenticate();
       }
   }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all the users in the database and return them
        $users = User::all();
        return $users;
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        return $this->authenticateWithCredential($credentials);
    }

    public function authenticateWithCredential($credentials) 
    {
        try {
            // verify the credentials and create a token for the user
            if (! $token = $this->guard()->attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token', 'message'=>$e->getMessage()], 500);
        }


        $user = $this->guard()->user();
        $user->load('staff');

        // if no errors are encountered we can return a JWT
        return response()->json([
          'token'=> $token,
          'user'=> $user
        ]);
    }

    public function refreshToken()
    {
        try {
            if (! $token = JWTAuth::parseToken()->refresh()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('token'));
    }

    public function sendAjax($data, $success = true)
    {
        die(json_encode([
          'result'=>$data,
          'success'=>$success,
        ]));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }
}
