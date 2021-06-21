<?php

namespace App\Http\Controllers;

use App\Employees;
use App\Helper\MyHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Yajra\DataTables;

class EmployeesController extends Controller
{
    public function getEmployees()
    {
         $employees = Employees::getEmployees();
         return datatables($employees)->toJson();
    }

    public function getEmployeeDetails($id)
    {

        $employee = DB::select('sp_Employee_get ?',[$id]);
        $data['title']='Employee Details';
        return view ('pages.employees.tabs.employee_det',$data)
        ->with('employee',$employee);

    }

    public function dataTableEmpDet(Request $request)
    {

        $data = Employees::getEmployeeDetails($request->Employee_ID);

        $count = count($data);
        $encode = array();

        if ($count > 0) :
            foreach ($data as $items) :
                $encode[] = array_map('utf8_encode', (array)$items);
            endforeach;
        endif;

        echo MyHelper::buildJsonTable($count, $encode);


    }
}
