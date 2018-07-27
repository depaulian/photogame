<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Photo;
use App\ValidationService;
use App\Http\Requests;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class PhotoController extends Controller
{
    private $user;
    public function __construct(Photo $photo,ValidationService $validationService)
    {
        $this->photo 				    = $photo;
		$this->validationService 		= $validationService;
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function getPhotos(Request $request){
   	    $input = $request->all();
    	if(!$this->validationService->isValid($input,'get_photos')){
           return response()->json(['message' => $this->validationService->errors], 401); 
        }

        try 
        {
                $results = $this->photo->getPhotos($input);
                if($results){
                    return response()->json([
                                            'type'         => 'Success',
                                            'status_code'    =>100,
                                            'result'         =>$results,
                                        ], 202);
                }else{
                    return response()->json([
                                            'status'         => 'Success',
                                            'status_code'    =>100,
                                            'result'         =>[],
                                        ], 202);
                }
        }
        catch(JWTException $e)
        {
        	return response()->json([
                                      'status'          => 'Error',
                                      'status_code'     => 102,
                                      'message'         =>'could not verify token',
                                ], 401);
        }
    }

    public function getPhoto(Request $request){
        $input = $request->all();
     if(!$this->validationService->isValid($input,'get_photos')){
        return response()->json(['message' => $this->validationService->errors], 202); 
     }

     try 
     {
             $result = $this->photo->getPhoto($input);
             if($result){
                 return response()->json([
                                         'status'         => 'Success',
                                         'status_code'    =>100,
                                         'result'         =>$result,
                                     ], 202);
             }else{
                 return response()->json([
                                         'status'         => 'Success',
                                         'status_code'    =>100,
                                         'result'         =>[],
                                     ], 202);
             }
     }
     catch(JWTException $e)
     {
         return response()->json([
                                   'status'          => 'Error',
                                   'status_code'     => 102,
                                   'message'         =>'could not verify token',
                             ], 401);
     }
    }
    
    public function postPhoto(Request $request){
     $input = $request->all();
     if(!$this->validationService->isValid($input,'post_photo')){
        return response()->json(['message' => $this->validationService->errors], 202); 
     }

     try 
     {       
             $photo = base64_decode($input['photo']);
             $time = time();
             if (!file_exists('photos')) {
                mkdir('photos', 0777, true);
             }
             $image_url = 'photos/img_'.$time.'_'.$input['owner'].'.jpg';
             if(!file_put_contents($image_url,$photo)){
                return response()->json([
                                'message'       =>'An error occured while saving image',
                                'status_code'   => 101,
                                'status'        =>'Error'
                            ],401);
             }
             $input['photo'] = $image_url;
             $photo = $this->photo->postPhoto($input);
             if($photo){
                 return response()->json([
                                         'status'         => 'Success',
                                         'status_code'    =>100,
                                         'result'         =>$photo,
                                     ], 202);
             }else{
                 return response()->json([
                                         'status'         => 'Error',
                                         'status_code'    =>101,
                                     ], 401);
             }
     }
     catch(JWTException $e)
     {
         return response()->json([
                                   'status'          => 'Error',
                                   'status_code'     => 102,
                                   'message'         =>'could not verify token',
                             ], 401);
     }
    }
}