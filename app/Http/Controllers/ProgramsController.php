<?php

namespace App\Http\Controllers;

use App\Helper\MyHelper;
use App\Programs;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProgramsController extends Controller
{

    public function getPrograms()
    {
      $programs = Programs::getPrograms();
      return datatables($programs)->toJson();
    //   dd($programs);
    }



    public function showNewProgram()
    {
        $data['parents']=Programs::getPrograms();
        // DD($data);
        return view ('pages.programs.modals.content.new_program',$data);
    }


    public function insertNewProgram(Request $request)
    {

        $data = array(
            $request->new_program,
            $request->new_parent_program,
            $request->new_seq_program,
            MyHelper::decrypt(Session::get('Employee_ID'))
        );


        $insert = Programs::insertProgram($data);

        $num = $insert[0]->RETURN;

        if ($num > 0) :
            $msg = 'Program successfully saved!';
        else :
            $msg = Myhelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;

    }

    /*
   public function showEditProgram($id)
    {
        $program = Programs::getProgramEdit($id);
        $data['parents']=Programs::getPrograms();
        $data['title']='Edit Program';
        // dd($program);
        return view ('pages.programs.tabs.edit_program',$data)
        ->with('program',$program);

    }
    */

    public function updateProgram(Request $request)
    {
        $data=array(
            $request->edit_program_id,
            $request->edit_program,
            $request->edit_parent_program,
            $request->edit_seq_program,
            MyHelper::decrypt(Session::get('Employee_ID')),
            null
        );

        // dd($data);
         $update = Programs::updateProgram($data);
         $num = $update[0]->RETURN;
         if ($num >= 0)
         {
             $msg = 'Program successfully updated!';
         }
         else
         {
             $msg = $update[0]->Message;
         }
         $result = array('num' => $num, 'msg' => $msg);
         return $result;

    }

    public function openProgram(Request $request)
    {
        $param = [
            $request -> Program_ID,
            $request -> isOpen,
            MyHelper::decrypt(Session::get('Employee_ID')),
        ];

        $update = Programs::openProgram($param);

        $num = $update[0]->RETURN;
        if ($num >= 0)
        {
            $msg = 'Program successfully opened!';
        }
        else
        {
            $msg = $update[0]->Message;
        }
        $result = array('num' => $num, 'msg' => $msg);
        return $result;

    }

}
