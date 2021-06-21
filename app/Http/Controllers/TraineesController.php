<?php

namespace App\Http\Controllers;

use App\Helper\MyHelper;
use App\Trainees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TraineesController extends Controller
{
    public function getTrainees()
    {
        $applicant = Trainees::getTrainees();
        return datatables($applicant)->toJson();
    }
    public function getTraineesID($id)
    {
        $applicant = Trainees::getTraineesID($id);
        $data['title']='Applicant Details' ;
        return view ('pages.trainees.tabs.trainees_det',$data)
        ->with('applicant',$applicant);

    }
    public function dataTableAppDet(Request $request)
    {
        $data = Trainees::getApplicantDetails($request->Applicant_ID);
        return datatables($data)->toJson();
    }

    public function applicantDetail(Request $request)
    {
        return Trainees::getApplicantDetails($request->Applicant_ID);
    }
}
