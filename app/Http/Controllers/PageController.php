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


        if(Myhelper::checkSession())
        {
            return view('pages.home.index',$data);
        }
        else
        {
            return redirect()->away(env('MYHUB_URL'));
        }
    }

    public function ApplicantTrainings()
    {
        $data['title'] = 'Applicants Trainings';

        $data['checkAccessParams']['moduleID']   = env('MODULE_TRAIN_APPLICANTS');
        $data['checkAccessParams']['userAccess'] = Session::get('UserAccess');
        $data['parents']=Programs::getPrograms([-1,'',0]);

        if(Myhelper::checkSession())
        {
            if(!Session::has('Employee_ID') && !MyHelper::checkUserAccess($data['checkAccessParams'],env('APP_ACTION_ALL'))):
                return  redirect('/error/401');
            endif;
            return view ('pages.trainings.applicant.index',$data);
        }
        else
        {
            return redirect()->away(env('MYHUB_URL'));
        }

    }


    public function EmployeeTrainings()
    {
        $data['title'] = 'Employees Trainings';
        $data['checkAccessParams']['moduleID']   = env('MODULE_TRAIN_EMPLOYEES');
        $data['checkAccessParams']['userAccess'] = Session::get('UserAccess');
        $data['parents']=Programs::getPrograms([-1,'',0]);


        if(Myhelper::checkSession())
        {

            if(!Session::has('Employee_ID') && !MyHelper::checkUserAccess($data['checkAccessParams'],env('APP_ACTION_ALL'))):
                return  redirect('/error/401');
            endif;

            return view ('pages.trainings.employee.index',$data);
        }
        else
        {
            return redirect()->away(env('MYHUB_URL'));
        }
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


        if(Myhelper::checkSession())
        {
            if(!Session::has('Employee_ID') && !MyHelper::checkUserAccess($data['checkAccessParams'],env('APP_ACTION_ALL'))):
                return  redirect('/error/401');
            endif;

            return view ('pages.programs.index',$data);
        }
        else
        {
            return redirect()->away(env('MYHUB_URL'));
        }
    }

    public function Locations()
    {
        $data['title'] = 'Locations';
        $data['checkAccessParams']['moduleID']   = env('MODULE_LOCATIONS');
        $data['checkAccessParams']['userAccess'] = Session::get('UserAccess');


        if(Myhelper::checkSession())
        {
            if(!Session::has('Employee_ID') && !MyHelper::checkUserAccess($data['checkAccessParams'],env('APP_ACTION_ALL'))):
                return  redirect('/error/401');
            endif;

            return view ('pages.locations.index',$data);
        }
        else
        {
            return redirect()->away(env('MYHUB_URL'));
        }
    }

    public function Employees()
    {
        $data['title'] = 'Employees';
        $data['checkAccessParams']['moduleID']   = env('MODULE_EMPLOYEES');
        $data['checkAccessParams']['userAccess'] = Session::get('UserAccess');


        if(Myhelper::checkSession())
        {
            if(!Session::has('Employee_ID') && !MyHelper::checkUserAccess($data['checkAccessParams'],env('APP_ACTION_ALL'))):
                return  redirect('/error/401');
            endif;
            return view ('pages.employees.index',$data);
        }
        else
        {
            return redirect()->away(env('MYHUB_URL'));
        }
    }

    public function Trainees()
    {
        $data['title'] = 'Trainees';
        $data['checkAccessParams']['moduleID']   = env('MODULE_APPLICANTS');
        $data['checkAccessParams']['userAccess'] = Session::get('UserAccess');

        if(Myhelper::checkSession())
        {
            if(!Session::has('Employee_ID') && !MyHelper::checkUserAccess($data['checkAccessParams'],env('APP_ACTION_ALL'))):
                return  redirect('/error/401');
            endif;

            return view ('pages.trainees.index',$data);
        }
        else
        {
            return redirect()->away(env('MYHUB_URL'));
        }
    }


}
