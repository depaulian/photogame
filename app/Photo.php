<?php

namespace App;
use Carbon\Carbon;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'caption', 'description', 'photo','category', 'owner','location','time_taken'
    ];


    public function postPhoto($data){
        $this->caption              = $data['caption'];
        $this->description          = $data['description'];
        $this->photo                = $data['photo'];
        $this->category             = $data['category'];
        $this->owner                = $data['owner'];
        $this->location             = $data['location'];
        $this->time_taken           = $data['time_taken'];
        $this->save();
        $this->id                   = $this->id;   
        return $this;
    }



    public function votePhoto($data){
        $vote = DB::table('photo_votes')->where('user_id',$data['user_id'])->first();
        if($vote)
        {
          return;
        }
        else{
            DB::table('photo_votes')->insert([
                                                'user_id'   =>$data['id'],
                                                'vote'      =>$data['vote'],
                                                'photo_id'  =>$data['photo_id'],
                                                'created_at'=>new Carbon(),
                                                'updated_at'=>new Carbon(),
                                            ]);
        }
    }

    public function viewPhoto($data){
        $view = DB::table('photo_views')->where('user_id',$data['user_id'])->first();
        if($view)
        {
          return;
        }
        else{
            DB::table('photo_views')->insert([
                                                'user_id'   =>$data['id'],
                                                'photo_id'  =>$data['photo_id'],
                                                'created_at'=>new Carbon(),
                                                'updated_at'=>new Carbon(),
                                            ]);
        }
    }

}