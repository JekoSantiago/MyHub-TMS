<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Trainings extends Model
{
    public static function getTrainings()
    {
        return DB::select('sp_Training_get');
    }
    public static function getTrainingsEdit($data)
    {
        return DB::select('sp_Training_get ?',[$data]);
    }

    public static function insertTraining($data)
    {
        return DB::select('sp_Training_insert ?,?,?,?,?,?,?,?,?,?,?',$data);
    }

    public static function updateTraining($data)
    {
        return DB::select('sp_Training_update ?,?,?,?,?,?,?,?,?,?,?,?',$data);

    }

    public static function getTrainingEmp($id)
    {
        return DB::select('sp_TrainingEmp_get ?',[$id]);
    }

    public static function getTrainingApp($id)
    {
        return DB::select('sp_TrainingApp_get ?',[$id]);
    }

    public static function insertTrainingEmp($data)
    {
        return DB::select('sp_TrainingEmp_Insert ?,?,?',$data);
    }

    public static function deleteTrainingEmp($data)
    {
        return DB::statement('exec sp_TrainingEmp_Delete ?',[$data]);
    }

    public static function getRatingsEmp($data)
    {
        return DB::select('sp_TrainingEmpRatings_get ?',[$data]);
    }

    public static function updateRatingsEmp($data)
    {
        return DB::statement('exec sp_TrainingEmpRatings_Update ?,?,?,?',$data);
    }

    public static function updateRatingsApp($data)
    {
        return DB::select('exec sp_TrainingAppRatings_Update ?,?,?,?',$data);
    }

    public static function getAvailablePrograms($data)
    {
        return DB::select('sp_AvailableProgram_get ?,?',$data);
    }

    public static function getProgramApp($data)
    {
        return DB::select('sp_ProgramApp_New_Get ?', [$data]);
    }

    public static function insertProgramApp($data)
    {
        return DB::select('sp_ProgramApp_Insert ?,?,?,?,?',$data);
    }

    public static function updateProgramApp($data)
    {
        return DB::select('sp_ProgramApp_Update ?,?,?', $data);
    }

    public static function trainingAppInsert($data)
    {
        return DB::select('sp_AutoEnrollApp_Insert ?,?,?',$data);
    }

    public static function deleteAppTraining($data)
    {
        return DB::select('sp_TrainingAuto_Delete ?,?,?',$data);
    }

    public static function getEnrolledTraining($data)
    {
        return DB::select('sp_enrolledProgram_get ?,?',$data);
    }

    public static function checkRatingsCount($data)
    {
        return DB::select('sp_RatedTraining_Count ?,?',$data);
    }

    public static function checkTrainingDone($data)
    {
        return DB::select('sp_TrainingDone_Count ?',$data);
    }

    public static function checkRatingsApp($data)
    {
        return DB::select('sp_ProgramApp_New_Get ?,?,?,?,?',$data);
    }

    public static function deleteProgramApp($data)
    {
        return DB::statement('exec sp_ProgramApp_Delete ?', $data);
    }


}
