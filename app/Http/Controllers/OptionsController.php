<?php

namespace App\Http\Controllers;

use App\Common;
use App\Helper\MyHelper;
use App\Location;
use App\Programs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OptionsController extends Controller
{
    public function getDC()
    {
        $data = Common::getDC();

        $output = '<option></option>';

        foreach($data as $dc) :
            $output .= '<option value="'. $dc->DC_ID .'">'. $dc->DC .'</option>';
        endforeach;

        echo $output;
    }

    public function getProv($id)
    {
        $data = Common::getProvince($id);

        $output = '<option></option>';

        foreach($data as $prov) :
            $output .= '<option value="'. $prov->Province_ID .'">'. $prov->Province .'</option>';
        endforeach;

        echo $output;
    }

    public function getProgramsOptions()
    {
      $data = Programs::getPrograms();
      $output = '<option></option>';

        foreach($data as $prog) :
            $output .= '<option value="'. $prog->Program_ID .'">'. $prog->Program .'</option>';
        endforeach;

        echo $output;
    }

    public function getLocationsOptions()
    {
        $data = Location::getLocations();
        $output = '<option></option>';

        foreach($data as $loc) :
            $output .= '<option value="'. $loc->Location_ID .'">'. $loc->Location .'</option>';
        endforeach;

        echo $output;
    }

    public function getStore(Request $request)
    {

        // dd($request);
        $param = [
            $request ->dc,
            $request ->prov,
            MyHelper::decrypt(Session::get('Employee_ID'))
        ];

        $data = Common::getStore($param);

        $output = '<option></option>';

        foreach($data as $store) :
            $output .= '<option value="'. $store->Location_ID .'">'. $store->LocationCode . "-" . $store->Location .'</option>';
        endforeach;

        echo $output;
    }

    public function getSeqPrograms(Request $request)
    {
        $progID = $request->progID;

        $seqID = ($progID == env('SCT')) ? env('SLT') : (($progID == env('SLT')) ? env('ACT') : (($progID == env('ACT')) ? env('AMT') : -1));
        // dd($progID,$seqID);
        if ($seqID > 0)
        {
            $param = [
                0,
                '',
                $seqID
            ];



            $output = '<option></option>';

            $data = Common::getSeqProg($param);

            foreach($data as $program) :
                $output .= '<option value="'. $program->Program_ID .'">'. $program->Program  .'</option>';
            endforeach;

            echo $output;
        }
        else
        {
            return false;
        }

    }
}
