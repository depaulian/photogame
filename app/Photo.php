<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Photo extends Model
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'photo';
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
        $this->time_taken           = date('Y-m-d h:i:s',strtotime($data['time_taken']));
        $this->save();
        $this->id                   = $this->id;   
        return $this;
    }

    public function getPhotos($data){
        switch($data['sorting']){
            case 1:
            $sql = 'SELECT a.id, a.caption, a.photo, a.category as category_id, a.description, b.name as category, a.owner as owner_id, c.username,
                    a.location, a.time_taken,vote_up, vote_down, views, ((vote_up + 1.9208) / (vote_up + vote_down) - 1.96 * SQRT((vote_up * vote_down) / (vote_up + vote_down) + 0.9604) / (vote_up + vote_down)) / (1 + 3.8416 / (vote_up + vote_down)) AS vote_score,
                    views, a.created_at FROM photo a LEFT JOIN category b on a.category=b.id LEFT JOIN users c on a.owner = c.id 
                    ORDER BY a.id DESC LIMIT '.$data['limit'].' OFFSET '.$data['offset'].'';
            break;
            case 2:
            $sql = 'SELECT a.id, a.caption, a.photo, a.category as category_id, a.description, b.name as category, a.owner as owner_id, c.username,
                    a.location, a.time_taken, vote_up, vote_down, views, ((vote_up + 1.9208) / (vote_up + vote_down) - 1.96 * SQRT((vote_up * vote_down) / (vote_up + vote_down) + 0.9604) / (vote_up + vote_down)) / (1 + 3.8416 / (vote_up + vote_down)) AS vote_score,
                    views, a.created_at FROM photo a LEFT JOIN category b on a.category=b.id LEFT JOIN users c on a.owner = c.id 
                    ORDER BY vote_score DESC LIMIT '.$data['limit'].' OFFSET '.$data['offset'].'';
            break;
            default:
            $sql = 'SELECT a.id, a.caption, a.photo, a.category as category_id, a.description, b.name as category, a.owner as owner_id, c.username,
                    a.location, a.time_taken,vote_up, vote_down, views, ((vote_up + 1.9208) / (vote_up + vote_down) - 1.96 * SQRT((vote_up * vote_down) / (vote_up + vote_down) + 0.9604) / (vote_up + vote_down)) / (1 + 3.8416 / (vote_up + vote_down)) AS vote_score,
                    views, a.created_at FROM photo a LEFT JOIN category b on a.category=b.id LEFT JOIN users c on a.owner = c.id 
                    ORDER BY a.id DESC LIMIT '.$data['limit'].' OFFSET '.$data['offset'].'';
        }

        return DB::select(DB::raw($sql)); 
    }

    public function getPhoto($data){
        $sql = 'SELECT a.id, a.caption, a.photo, a.category as category_id, a.description, b.name as category, a.owner as owner_id, c.username,
                a.location, a.time_taken,vote_up, vote_down, views, ((vote_up + 1.9208) / (vote_up + vote_down) - 1.96 * SQRT((vote_up * vote_down) / (vote_up + vote_down) + 0.9604) / (vote_up + vote_down)) / (1 + 3.8416 / (vote_up + vote_down)) AS vote_score,
                views, a.created_at FROM photo a LEFT JOIN category b on a.category=b.id LEFT JOIN users c on a.owner = c.id 
                WHERE a.id = '.$data['photo_id'].'';
        return DB::select(DB::raw($sql))[0]; 
    }

    public function votePhoto($data){
        $vote = DB::table('photo_votes')->where('user_id',$data['user_id'])->where('photo_id',$data['photo_id'])->first();
        if($vote)
        {
          return 1;
        }
        else{
            DB::table('photo_votes')->insert([
                                                'user_id'   =>$data['user_id'],
                                                'vote'      =>$data['vote'],
                                                'photo_id'  =>$data['photo_id'],
                                                'created_at'=>new Carbon(),
                                                'updated_at'=>new Carbon(),
                                            ]);
            //update vote count for the user
            if($data['vote']==1){
                DB::statement('UPDATE photo SET vote_up=vote_up+1 WHERE id='.$data['photo_id'].'');
            }else{
                DB::statement('UPDATE photo SET vote_down=vote_down+1 WHERE id='.$data['photo_id'].'');   
            }
            return 2;
        }
    }

    public function viewPhoto($data){
        $view = DB::table('photo_views')->where('user_id',$data['user_id'])->where('photo_id',$data['photo_id'])->first();
        if($view)
        {
          return 1;
        }
        else{
            DB::table('photo_views')->insert([
                                                'user_id'   =>$data['user_id'],
                                                'photo_id'  =>$data['photo_id'],
                                                'created_at'=>new Carbon(),
                                                'updated_at'=>new Carbon(),
                                            ]);
            DB::statement('UPDATE photo SET views=views+1 WHERE id='.$data['photo_id'].''); 
            return 2;
        }
    }

}