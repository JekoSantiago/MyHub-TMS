<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Exports extends Model
{
    public static function exportTrainingApplicants($data)
    {
        return DB::select('sp_TrainingApp_Get_Excel',[$data]);
    }

    public static function exportTrainingEmployees($data)
    {
        return DB::select('sp_TrainingApp_Get_Excel',[$data]);
    }
}
