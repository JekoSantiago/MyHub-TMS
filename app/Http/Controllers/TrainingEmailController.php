<?php

namespace App\Http\Controllers;

use App\Helper\MyHelper;
use App\Trainings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Throwable;

class TrainingEmailController extends Controller
{


    public static function sendEmailNotif(Request $request)
    {
        $userEmpID    = MyHelper::decrypt(Session::get('Employee_ID'));
        $userFullName = MyHelper::decrypt(Session::get('FullName'));
        $userEmail    = MyHelper::decrypt(Session::get('Email'));
        $userDepID    = MyHelper::decrypt(Session::get('Department_ID'));

        $data['content'] = '';
        $data['training'] = Trainings::getTrainingsEdit($request->trainingID);

        if(count($data['training']) == 0):
            echo "Sending Email: Training Not Found!.";
            return false;
        endif;

        $data['filerIndex'] = 0;
        $data['filerName'] = '';
        $data['filerEmail'] = '';

        $data['approverIndex'] = 0;
        $data['approverName']   = '';
        $data['approverEmail'] = array();

        switch ($request->action)
        {
            case 'create':
                $data['filerIndex']     = 1;
                $data['filerName'] = $userFullName;
                $data['filerEmail'] = 'no_reply@atp.ph';
                $data['trainingName'] = $data['training'][0]->Training;
                $data['program'] = $data['training'][0]->Program;
                $data['date'] = $data['training'][0]->TrainingDate;
                $data['location'] = $data['training'][0]->Location;
            break;

            case 'open':
                $data['filerIndex']     = 2;
                $data['filerName'] = $userFullName;
                $data['filerEmail'] = 'no_reply@atp.ph';
                $data['trainingName'] = $data['training'][0]->Training;
                $data['program'] = $data['training'][0]->Program;
                $data['date'] = $data['training'][0]->TrainingDate;
                $data['location'] = $data['training'][0]->Location;
            break;

            default:
              return false;

        }

        if($data['filerIndex'] > 0 && $data['filerEmail'] !=''):
            if(is_array($data['filerEmail']) && count($data['filerEmail']) == 0):
                return false;
            endif;
            $data['index'] = $data['filerIndex'];
            $data['email'] = $data['filerEmail'];
            self::sendEmail($data);
        endif;

        return view('emails.training-email',$data);

    }

    public static function getSubject($data)
    {
        $subject[1] = "[MyHub] TMS : New Training Created";
        $subject[2] = "[MyHub] TMS : Applicant Training Opened";
        return  $subject[$data['index']];
    }

    public static function getContentParagraph($data)
    {
        $trainor = $data['filerName'];
        $program = $data['program'];

        $paragraph[1] = "Hi Recruitment Team,<br><br>A new training under the program <b>$program</b> was created by <b>$trainor</b>.";
        $paragraph[2] = "Hi $trainor,<br><br>You just opened a training under the <b>$program</b>.";

         return  $paragraph[$data['index']];
    }

    public static function sendEmail($data)
    {
        try {
            ini_set('max_execution_time', 360);
            $data['content'] = self::getContentParagraph($data);
            Mail::send(['html'=>'emails.training-email'], $data, function($message) use ($data)
            {
            $subject = self::getSubject($data);
            $message->to($data['email'], env('MAIL_FROM_NAME'))->subject($subject);
            });

            return true;
        }
        catch (Throwable $e)
        {
            dd($e);
            return false;
        }
    }
}
