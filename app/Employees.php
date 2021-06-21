<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employees extends Model
{
    public static function getEmployees()
    {
        return DB::select('sp_Employee_get');
    }

    public static function getEmployeeDetails($id)
    {
        return DB::select('sp_EmployeeDetails_get ?',[$id]);
    }


}
