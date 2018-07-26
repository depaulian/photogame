<?php

namespace App;
use Carbon\Carbon;
use Hash;
use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $db;


    public function registerUser($data){
        $this->username             = $data['username'];
        $this->email                = $data['email'];
        $this->password             = Hash::make($data['password']);
        $this->save();
        $this->id                   = $this->id;   
        return $this;
    }



    public function checkUsername($username){
        $user = DB::table('users')->where('username',$username)->first();
        return $user ? true : false;
    }

    public function checkEmail($email){
        $user = DB::table('users')->where('email',$email)->first();
        return $user ? true : false;
    }

    public function refactorUser($user,$token)
    {
        return [
                  'id'                  =>$user->id,
                  'username'            =>$user->username,
                  'email'               =>$user->email,
                  'token'               =>$token
                ];
    }

}