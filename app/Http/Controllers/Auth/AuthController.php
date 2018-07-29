<?php
namespace App\Http\Controllers\Auth;

use App\User;
use App\ValidationService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Dingo\Api\Auth\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    protected $user;
    protected $verificationService;
    protected $key;

    public function __construct(User $user, ValidationService $validationService){
        $this->user 					= $user;
        $this->validationService 		= $validationService;
    }
    public function checkUsername($username){
        $fail = $this->user->checkUsername($username);
        if($fail){
            return response()->json([
                'status_code'           =>0,
                'status_message'        =>'Username Address already taken'
            ],401);
        }else{
            return response()->json([
                'status_code'           =>1,
                'status_message'        =>'Username Available'
            ],200);
        }
    }
    public function checkEmail($email){
        $fail = $this->user->checkEmail($email);
        if($fail){
            return response()->json([
                'status_code'           =>0,
                'status_message'        =>'Email Address already taken'
            ],401);
        }else{
            return response()->json([
                'status_code'           =>1,
                'status_message'        =>'Email Available'
            ],200);
        }
    }

    public function loginUser(Request $request){

        // grab credentials from the request
        $credentials = $request->only('username', 'password');

        try {
            if(!$request->input('username')||!$request->input('password')){
               return response()->json([
                                        'staus' => 'Error',
                                        'message'=>'Please provide a username and password',
                                        'status_code'=>101
                                        ], 200); 
            }

            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                                        'status' => 'Error',
                                        'message'=>'Invalid Username and/or password',
                                        'status_code'=>102
                                        ], 200);
            }

        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token','status_code'=>103], 401);
        }

        // all good so return the token
        $user = User::where('username','=',$request->input('username'))->get()->first();

        return response()->json(['status'=>'Success','status_code'=>100,'user'=>$this->user->refactorUser($user,$token),'token'=>$token],200);

    }

    public function registerUser(Request $request){
        //return $this->user->find(1);
        $input = $request->all();
        if(!$this->validationService->isValid($input,'register_user')){
           return response()->json(['message' => $this->validationService->errors,'status_code'   =>103,], 401); 
        }
        
        try 
        {
            $message = 'Account Successfully Created';
        	$user = $this->user->registerUser($input);
               // all good so return the token
            $credentials = $request->only('username', 'password'); 
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                                        'status' => 'Error',
                                        'message'=>'Could not authenticate you. Please try logging in with the details you just created',
                                        'status_code'=>102
                                        ], 200);
            }
            $user = User::where('username','=',$request->input('username'))->get()->first();
             return response()->json(
                                    [
                                        'status'=>'Success',
                                        'status_code'=>100,
                                        'message'=>$message,
                                        'user'=>$this->user->refactorUser($user,$token),
                                    ],
                                    200); 
        }
        catch(JWTException $e)
        {
        return response()->json([
                                    'message'       =>'An error occured while saving user',
                                    'status_code'   =>101,
                                    'status'        =>'Error'
                                ],401);
        } 

    }

    public function refreshToken($user){
        $credentials = $request->only('username', 'password');
        // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                                        'status' => 'Error',
                                        'message'=>'Wrong password',
                                        'status_code'=>102
                                        ], 401);
            }
            return response()->json(['status'=>'Success','status_code'=>100,'token'=>$token],202);
    }

    public function token(){
        $token = JWTAuth::getToken();
        if(!$token){
            throw new BadRequestHtttpException('Token not provided');
        }
        try{
        $token = JWTAuth::refresh($token);
        }catch(TokenInvalidException $e){
            throw new AccessDeniedHttpException('The token is invalid');
        }
        return $this->response->withArray(['token'=>$token]);
    }
}