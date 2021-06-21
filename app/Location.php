<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Location extends Model
{
    public static function getLocations()
    {
        return DB::select('sp_Location_get');
    }

    public static function getLocationsEdit($data)
    {
        return DB::select('sp_Location_get ?',[$data]);
    }



    public static function insertLocation($data)
    {
        return DB::select('sp_Location_insert ?,?,?',$data);
    }


    public static function updateLocation($data)
    {
        return DB::select('sp_Location_update ?,?,?,?',$data);
    }
}
