<?php

namespace App\Http\Controllers;

use App\Helper\MyHelper;
use App\Programs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class PageController extends Controller
{

    public function viewHome()
    {
        $data['title'] = "Home";
        return view('pages.home.index',$data);
    }

    public function ApplicantTrainings()
    {
        $data['title'] = 'Applicants Trainings';

        $data['checkAccessParams']['moduleID']   = env('MODULE_TRAIN_APPLICANTS');
        $data['checkAccessParams']['userAccess'] = Session::get('UserAccess');
        $data['parents']=Programs::getPrograms([-1,'',0]);


        if(!Session::has('Employee_ID') || !MyHelper::checkUserAccess($data['checkAccessParams'],env('APP_ACTION_ALL'))):
            return  redirect('/error/401');
        endif;
        return view ('pages.trainings.applicant.index',$data);
    }


    public function EmployeeTrainings()
    {
        $data['title'] = 'Employees Trainings';
        $data['checkAccessParams']['moduleID']   = env('MODULE_TRAIN_EMPLOYEES');
        $data['checkAccessParams']['userAccess'] = Session::get('UserAccess');
        $data['parents']=Programs::getPrograms([-1,'',0]);

        if(!Session::has('Employee_ID') || !MyHelper::checkUserAccess($data['checkAccessParams'],env('APP_ACTION_ALL'))):
            return  redirect('/error/401');
        endif;
        return view ('pages.trainings.employee.index',$data);
    }

    public function Programs()
    {
        $data['title'] = 'Programs';
        $data['checkAccessParams']['moduleID']   = env('MODULE_PROGRAMS');
        $data['checkAccessParams']['userAccess'] = Session::get('UserAccess');
        $data['parents']=Programs::getPrograms([-1,'',0]);

        JavaScriptFacade::put([
            'userID' =>  MyHelper::decrypt(Session::get('Employee_ID')),
            'hrAccess' => env('HR_MANAGER_ID')
        ]);

        if(!Session::has('Employee_ID') || !MyHelper::checkUserAccess($data['checkAccessParams'],env('APP_ACTION_ALL'))):
            return  redirect('/error/401');
        endif;
        return view ('pages.programs.index',$data);
    }

    public function Locations()
    {
        $data['title'] = 'Locations';
        $data['checkAccessParams']['moduleID']   = env('MODULE_LOCATIONS');
        $data['checkAccessParams']['userAccess'] = Session::get('UserAccess');
        if(!Session::has('Employee_ID') || !MyHelper::checkUserAccess($data['checkAccessParams'],env('APP_ACTION_ALL'))):
            return  redirect('/error/401');
        endif;
        return view ('pages.locations.index',$data);
    }

    public function Employees()
    {
        $data['title'] = 'Employees';
        $data['checkAccessParams']['moduleID']   = env('MODULE_EMPLOYEES');
        $data['checkAccessParams']['userAccess'] = Session::get('UserAccess');
        if(!Session::has('Employee_ID') || !MyHelper::checkUserAccess($data['checkAccessParams'],env('APP_ACTION_ALL'))):
            return  redirect('/error/401');
        endif;
        return view ('pages.employees.index',$data);
    }

    public function Trainees()
    {
        $data['title'] = 'Trainees';
        $data['checkAccessParams']['moduleID']   = env('MODULE_APPLICANTS');
        $data['checkAccessParams']['userAccess'] = Session::get('UserAccess');
        if(!Session::has('Employee_ID') || !MyHelper::checkUserAccess($data['checkAccessParams'],env('APP_ACTION_ALL'))):
            return  redirect('/error/401');
        endif;
        return view ('pages.trainees.index',$data);
    }


}
