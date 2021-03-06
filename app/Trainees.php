<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Trainees extends Model
{
    public static function getTrainees($data)
    {
        return DB::select('sp_Applicant_get ?,?,?,?,?', $data);
    }

    public static function getTraineesID($id)
    {
        return DB::select('sp_Applicant_get ?',[$id]);
    }

    public static function getApplicantDetails($id)
    {
        return DB::select('sp_ApplicantDetails_get ?',[$id]);
    }
}
