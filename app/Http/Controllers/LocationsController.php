<?php

namespace App\Http\Controllers;

use App\Helper\MyHelper;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocationsController extends Controller
{
    public function getLocations()
    {
      $locations = Location::getLocations();

      if(Session::get('Employee_ID')!=null)
      {
        return datatables($locations)->toJson();
      }
      else
      {
          abort(403);
      }
    }

    public function insertLocations(Request $request)
    {
        $data = array(
            $request->new_location,
            $request->new_capacity,
            $request->new_dc,
            MyHelper::decrypt(Session::get('Employee_ID'))
        );

        $insert = Location::insertLocation($data);

        $num = $insert[0]->RETURN;

        if ($num > 0) :
            $msg = 'Location successfully saved!';
        else :
            $msg = Myhelper::errorMessages($num);
        endif;

        $result = array('num' => $num, 'msg' => $msg);
        return $result;
    }

    /*
    public function showEditLocation($id)
    {
        $data['title']='Edit Location';
        $location = Location::getLocationsEdit($id);
        return view ('pages.locations.tabs.edit_location',$data)
        ->with('location',$location);

    }
    */

    public function updateLocation(Request $request)
    {
        $data=array(
            $request->edit_location_ID,
            $request->edit_location,
            $request->edit_capacity,
            $request->edit_dc,
            MyHelper::decrypt(Session::get('Employee_ID'))
        );

         Location::updateLocation($data);
         $num = 1;
         $msg = 'Location successfuly updated!';

            $result = array('num' => $num, 'msg' => $msg);
            return $result;
    }
}
