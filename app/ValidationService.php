<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Config;

class ValidationService extends Model
{
	// ensure the phone number is requires, startes with 256 and is followed by 
	// six numeric characters between 0 and 9     
    public function isValid($data,$type){
    switch ($type) {
	    	case 'register_user':
	    		$validation = Validator::make($data, Config::get('validation.register_user_rules'),Config::get('validation.register_user_messages'));
				break;
			case 'post_photo':
	    		$validation = Validator::make($data, Config::get('validation.post_photo_rules'),Config::get('validation.post_photo_messages'));
				break;
			case 'get_photos':
	    		$validation = Validator::make($data, Config::get('validation.get_photos_rules'),Config::get('validation.get_photos_messages'));
				break;
			case 'vote_photo':
	    		$validation = Validator::make($data, Config::get('validation.vote_photo_rules'),Config::get('validation.vote_photo_messages'));
				break;
			case 'view_photo':
	    		$validation = Validator::make($data, Config::get('validation.view_photo_rules'),Config::get('validation.view_photo_messages'));
	    		break;
	    	default:
	    	break;
    	}
     	if($validation->passes()) return true;
       	$this->errors= $validation->messages(); 
      	return false;
    }
}

