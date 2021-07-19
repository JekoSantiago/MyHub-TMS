<?php

namespace App\Http\Controllers;

use App\Helper\MyHelper;
use App\Mail\NotifEmail;
use App\Programs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ProgramEmailController extends Controller
{
    public function recruitmentNotif(Request $request)
    {
        $params = [
            $request->Program_ID
        ];

        $params2 = [
            $request->Program_ID,
            MyHelper::decrypt(Session::get('Employee_ID')),
        ];

        $update = Programs::completeProgram($params2);



        $num = $update[0]->RETURN;
        $emails = DB::select('sp_RecEmail_Get ?', $params);

        if($num > 0)
        {
            $data = Programs::recruitmentNotif($params);
            foreach($emails as $email)
            Mail::to($email->Email)->send(new NotifEmail($data));
            $msg = 'Program completed!';

        }
        else
        {
            $msg = $update[0]->Message;
        }
        $result = array('num' => $num, 'msg' => $msg);
        return $result;

    }
}
