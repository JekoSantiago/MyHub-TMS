<?php

namespace App\Http\Controllers;

use App\Helper\MyHelper;
use App\Location;
use App\Programs;
use App\Trainings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class TrainingController extends Controller
{
    public function getTrainings(Request $request)
    {
        dd($request ->program);
        $param = [
            0,
            $request -> training,
            '',
            ($request -> traindate) ? : '1900-01-01',
            0,
            $request -> location,
            0,
            $request -> program

        ];

        $trainings = Trainings::getTrainings($param);
        if(Session::get('Employee_ID')!=null)
        {
            return datatables($trainings)->toJson();
        }
        else
        {
            abort(403);
        }
    }

    public function showNewTraining()
    {
        $data['programs']=Programs::getPrograms([-1,'',0]);
        $data1['locations']=Location::getLocations();

        // DD($data1);
        return view ('pages.trainings.modals.content.new_training',$data,$data1);
    }

    public function insertTraining(Request $request)
    {
        // dd($request);
        $data = array(
            $request -> new_training,
            $request -> new_training_description,
            $request -> new_training_date,
            $request -> new_location_training,
            $request -> new_DC,
            $request -> new_store,
            MyHelper::decrypt(Session::get('Employee_ID')),
            $request -> new_program_training,
            $request -> new_hrs_training,
            $request -> new_training_status,
            $request -> new_training_ratings
        );


        $insert = Trainings::insertTraining($data);
        $num = $insert[0]->RETURN;
        // dd($num);

        if ($num > 0) :
            $msg = 'Training successfully saved!';

        else :
            $msg = Myhelper::errorMessages($num);
        endif;
        // TrainingEmailController::sendEmailNotif($num,'create');
        $result = array('num' => $num, 'msg' => $msg);
        return $result;

    }

   /* public function showEditTrainingEmp($id)
    {
        $training = Trainings::getTrainingsEdit($id);
        $data['programs']=Programs::getPrograms();
        $data['title'] = 'Edit Training';
        $data1['locations']=Location::getLocations();
        // dd($training);
        return view ('pages.trainings.employee.tabs.edit_training',$data,$data1)
        ->with('training',$training);


    }
    public function showEditTrainingApp($id)
    {
        $training = Trainings::getTrainingsEdit($id);
        $data['programs']=Programs::getPrograms();
        $data['title'] = 'Edit Training';
        $data1['locations']=Location::getLocations();
        // dd($training);
        return view ('pages.trainings.applicant.tabs.edit_training',$data,$data1)
        ->with('training',$training);

    } */

    public function updateTraining(Request $request)
    {
        $data=array(
            $request->edit_training_id,
            $request->edit_training,
            $request->edit_training_description,
            $request->edit_training_date,
            $request->edit_location_training,
            $request->edit_DC,
            $request->edit_store,
            MyHelper::decrypt(Session::get('Employee_ID')),
            $request->edit_program_training,
            $request->edit_hrs_training,
            $request->edit_training_status,
            $request->edit_training_ratings,
        );

            $update = Trainings::updateTraining($data);

            $num = $update[0]->RETURN;
            // dd($num);
            if ($num >= 0)
            {
                $msg = 'Training successfully updated!';
            }
            else
            {
                $msg = $update[0]->Message;
            }
            $result = array('num' => $num, 'msg' => $msg);
            return $result;


    }

    public function trainEmployee($id)
    {
        $training = Trainings::getTrainingsEdit($id);
        $data['title'] = 'Employees Training';
        return view('pages.trainings.employee.tabs.train_employee',$data)
        ->with('training',$training);

    }

    public function trainApplicant($id)
    {
        JavaScriptFacade::put([
            'SC_ID' => env('SC_ID'),
            'SL_ID' => env('SL_ID'),
            'AC_ID' => env('AC_ID'),
            'AM_ID' => env('AM_ID'),
            'SCT' => env('SCT'),
            'SLT' => env('SLT'),
            'ACT' => env('ACT'),
            'AMT' => env('AMT'),
            'PG' => env('Passing')
        ]);
        $training = Trainings::getTrainingsEdit($id);
        $data['title'] = 'Applicants Training';
        return view('pages.trainings.applicant.tabs.train_applicant',$data)
        ->with('training',$training);
    }


    public function trainEmpTableOne()
    {
        $data = DB::select('sp_vwEmpPosition_Get');
        if(Session::get('Employee_ID')!=null)
        {
            return datatables($data)->toJson();
        }
        else
        {
            abort(403);
        }

    }

    public function trainEmpTableTwo(Request $request)
    {
        $data = Trainings::getTrainingEmp($request->Training_ID);

        if(Session::get('Employee_ID')!=null)
        {
            return datatables($data)->toJson();
        }
        else
        {
            abort(403);
        }

    }

    public function trainAppTable(Request $request)
    {

        $data = Trainings::getTrainingApp($request->Training_ID);
        if(Session::get('Employee_ID')!=null)
        {
            return datatables($data)->toJson();
        }
        else
        {
            abort(403);
        }

    }

    public function insertTrainingEmployee(Request $request)
    {

        $param = [

            $request->Training_ID,
            $request->Employee_ID,
            MyHelper::decrypt(Session::get('Employee_ID'))
        ];

            $insert =  Trainings::insertTrainingEmp($param);
            $num = $insert[0]->RETURN;



        if ($num > 0) :
            $msg = 'Successfully added the Employee on the list of trainee';
        else :
            $msg = Myhelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    public function deleteTrainingEmployee(Request $request)
    {
        $data = $request -> TrainingEmp_ID;

        Trainings::deleteTrainingEmp($data);
            $num =1;
            $result = array('num' => $num);
            return $result;

    }

    public function showRatingsEmployee()
    {
        return view ('pages.trainings.employee.modals.content.ratings');
    }

    public function updateRatingsEmployee(Request $request)
    {
        $fail = $request->status_fail;
        $pass = $request->status_passed;
        if($fail == null && $pass == null)
        {
            $status=null;
        }
        else if($fail != null)
        {
            $status = $fail;
        }
        else if($pass != null)
        {
            $status = $pass;
        }

        $data = array(
            $request->TrainEmp_ID,
            $status,
            $request->ratings_emp,
            $request->remarks
        );

        $update = Trainings::updateRatingsEmp($data);
        if ($update == true)
         {
             $num = 1;
             $msg = 'Ratings successfully updated!';
         }
         else
         {
             $msg = 'Updating error, contact your admin';
         }
         $result = array('num' => $num, 'msg' => $msg);
         return $result;

    }

    public function updateRatingsApp(Request $request)
    {
        $fail = $request->status_fail;
        $pass = $request->status_passed;

        if($fail ==null && $pass == null)
        {
            $status=null;
        }
        else if($fail != null)
        {
            $status = $fail;
        }
        else if($pass != null)
        {
            $status = $pass;
        }

        // dd($status);

        $data = array(
            $request->TrainApp_ID,
            $status,
            $request->ratings_app,
            $request->remarks
        );

         $update = Trainings::updateRatingsApp($data);


         $num = $update[0]->RETURN;
         $msg = $update[0]->Message;


         $result = array('num' => $num, 'msg' => $msg);
         return $result;


    }

    public function getAvailablePrograms(Request $request)
    {

        if ($request->ParentProgram_ID == env('SCT'))
        {
            $parent_id = env('SLT');
        }
        elseif ($request->ParentProgram_ID == env('SLT'))
        {
            $parent_id = env('ACT');
        }
        elseif ($request->ParentProgram_ID == env('ACT'))
        {
             $parent_id = env('AMT');
        }
        else{$parent_id = 0;}
        // DD($parent_id);
        $param = [
            $request->Applicant_ID,
            $parent_id
        ];

        $data = Trainings::getAvailablePrograms($param);

        $output = '<option></option>';

        foreach($data as $prog) :
            $output .= '<option value="'. $prog->Program_ID .'">'. $prog->Program .'</option>';
        endforeach;

        echo $output;


    }

    public function getProgramApp($id)
    {

        JavaScriptFacade::put([
            'SC_ID' => env('SC_ID'),
            'SL_ID' => env('SL_ID'),
            'AC_ID' => env('AC_ID'),
            'AM_ID' => env('AM_ID'),
            'SCT' => env('SCT'),
            'SLT' => env('SLT'),
            'ACT' => env('ACT'),
            'AMT' => env('AMT'),
            'PG' => env('Passing')
        ]);
        $datas = Programs::getProgramEdit($id);
        $data['title'] = 'Program Applicants';
        $recom = DB::select('sp_Recommendation_get');
        $count = Programs::programAppCount($id);
        $countN = Programs::programAppCountNull($id);
        $HaveR = ($count[0]->total - $countN[0]->total);
        return view('pages.trainings.applicant.tabs.program_app',compact('datas','recom','count','countN','HaveR'),$data);
    }

    public function tblProgrammApp(Request $request)
    {

        $data = Trainings::getProgramApp($request->Program_ID);
        if(Session::get('Employee_ID')!=null)
        {
            return datatables($data)->toJson();
        }
        else
        {
            abort(403);
        }
    }

    public function insertProgramApp(Request $request)
    {

        $param = [
            $request -> Program_ID,
            $request -> Applicant_ID,
            $request -> recom_recom,
            $request -> recom_remarks,
            MyHelper::decrypt(Session::get('Employee_ID'))
        ];

        $insert = Trainings::insertProgramApp($param);
        $num = $insert[0]->RETURN;

        if ($num > 0) :
            $msg = 'Successfully submited a recommendation';
        else :
            $msg = Myhelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;

    }

    public function updateProgramApp(Request $request)
    {
        // dd($request);
        $param = [
            $request -> ProgramApp_ID,
            $request -> Recom,
            $request -> Remarks,
        ];
        // dd($param);
        $update = Trainings::updateProgramApp($param);

        $num = $update[0]->RETURN;
        $msg = $update[0]->Message;


        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }


    public function insertTrainingApp(Request $request)
    {
        $param = [
            $request -> Program_ID,
            $request -> Applicant_ID,
            MyHelper::decrypt(Session::get('Employee_ID'))
        ];
        // dd($param);

        // dd($param);
        $insert = Trainings::trainingAppInsert($param);

        // dd($insert);

        $num = $insert[0]->RETURN;

        if ($num > 0) :
            $msg = 'Successfully enrolled to the next program';
        else :
            $msg = $insert[0]->Message;
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;

    }

    public function deleteAppTraining(Request $request)
    {
        $param = [
            $request -> Applicant_ID,
            $request -> Parent_Program_ID,
           MyHelper::decrypt(Session::get('Employee_ID'))
        ];

        $param2 = [
            $request -> ProgramApp_ID,
        ];


           Trainings::deleteProgramApp($param2);
           return Trainings::deleteAppTraining($param);

    }

    public function getEnrolledTraining(Request $request)
    {
        $param =
        [
            $request -> Applicant_ID,
            $request -> Parent_Program_ID
        ];

        // dd($param);
        $data = Trainings::getEnrolledTraining($param);
        $output = '<option></option>';

        foreach($data as $prog) :
            $output .= '<option value="'. $prog->Program_ID .'">'. $prog->Program .'</option>';
        endforeach;

        echo $output;


    }

    public function updateFailRatings(Request $request)
    {
        $param = [
            $request -> ProgramApp_ID,
            null,
            null,
        ];

        // dd($param2);
           DB::statement('exec sp_ProgramApp_Update ?,?,?', $param);
    }

    public function checkRatingsCount(Request $request)
    {
        $param = [
            $request -> Applicant_ID,
            $request -> Parent_ID
        ];
        // dd($param);
           return Trainings::checkRatingsCount($param);
    }

    public function checkTrainingDone(Request $request)
    {
        $param = [
            $request ->Applicant_ID
        ];
        return Trainings::checkTrainingDone($param);
    }

    public function checkEligableAuto(Request $request)
    {
        $depID = $request -> DeptPosition_ID;
        $parentID = $request -> Parent_Program_ID;

        // dd($depID,$parentID);
        if($parentID == env('SCT'))
        {
            $eligable = ($depID == env('AM_ID')) ? 1 : (($depID == env('AC_ID')) ? 1 : (($depID == env('SL_ID')) ? 1 : 0));
        }
        elseif ($parentID == env('SLT'))
        {
            $eligable = ($depID == env('AM_ID')) ? 1 : (($depID == env('AC_ID')) ? 1 : 0);
        }
        elseif ($parentID == env('ACT'))
        {
            $eligable = ($depID == env('AM_ID')) ? 1 : 0;
        }
        else
        {
            $eligable = 0;
        }

        return $eligable;
    }

    public function checkRatingApp(Request $request)
    {
        $param = [
            $request-> Program_ID,
            '',
            '',
            '',
            $request -> Applicant_ID
        ];
        $data = Trainings::checkRatingsApp($param);

        return $data[0]->AveRatings;


    }

    public function recomCount(Request $request)
    {
        $id = $request->Program_ID;

        $count = Programs::programAppCount($id);
        $countN = Programs::programAppCountNull($id);

        $HaveRec = ($count[0]->total - $countN[0]->total);
        $ForRec = ($countN[0]->total);


        $data = [
            'HaveRec' => $HaveRec,
            'ForRec' => $ForRec
        ];

        return $data;
    }

}
