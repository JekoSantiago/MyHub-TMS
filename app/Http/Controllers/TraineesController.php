<?php

namespace App\Http\Controllers;

use App\Helper\MyHelper;
use App\Trainees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TraineesController extends Controller
{
    public function getTrainees(Request $request)
    {
        $param = [
            0,
            $request -> position,
            $request -> lastName,
            $request -> firstName,
            $request -> middleName
        ];

        $applicant = Trainees::getTrainees($param);

        if(Session::get('Employee_ID')!=null)
        {
            return datatables($applicant)->toJson();
        }
        else
        {
            abort(403);
        }
    }
    public function getTraineesID($id)
    {

        if(Myhelper::checkSession())
        {
            $applicant = Trainees::getTraineesID($id);
            $data['title']='Applicant Details' ;
            return view ('pages.trainees.tabs.trainees_det',$data)
            ->with('applicant',$applicant);
        }
        else
        {
            return redirect()->away(env('MYHUB_URL'));
        }

    }
    public function dataTableAppDet(Request $request)
    {
        $data = Trainees::getApplicantDetails($request->Applicant_ID);

        if(Session::get('Employee_ID')!=null)
        {
            return datatables($data)->toJson();
        }
        else
        {
            abort(403);
        }
    }

    public function applicantDetail(Request $request)
    {
        return Trainees::getApplicantDetails($request->Applicant_ID);
    }
}
