<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded =[];

    public static function getProfile($id){
        return Profile::where( 'user_id' , $id )->get();
    }
}
