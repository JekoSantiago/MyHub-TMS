<?php

namespace App;

use App\Helper\MyHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Programs extends Model
{


    public static function getProgramEdit($id)
    {
        return DB::select('sp_Program_Get ?' , [$id]);
    }

    public static function getPrograms($data)
    {
      return DB::select('sp_Program_Get ?,?,?' , $data);
    }

    public static function insertProgram($data)
    {

       return DB::select('exec sp_Program_Insert ?,?,?,?', $data);

    }

    public static function updateProgram($data)
    {
        return DB::select('sp_program_update ?,?,?,?,?', $data);
    }

    public static function programAppCount($data)
    {
        return DB::select('sp_ProgramApp_Count ?', [$data]);
    }

    public static function programAppCountNull($data)
    {
        return DB::select('sp_ProgramApp_Count_Null ?', [$data]);
    }

    public static function recruitmentNotif($data)
    {
        return DB::select('sp_RPT_TrainedApplicants ?',$data);
    }

    public static function completeProgram($data)
    {
        return DB::select('sp_Program_Complete_Update ?,?', $data);
    }

    public static function openProgram($data)
    {
        return DB::select('sp_ProgramOpen_Update ?,?,?', $data);
    }
}
