<?php

namespace App\Helper;

use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
class MyHelper
{
    public static function errorMessages($return)
    {
        $error = array(

            -1 => '',
            -2 => 'Location already exists.',
            -3 => '',
            -4 => 'Employee do not exists.',
            -5 => '',
            -6 => 'Tax Code does not exist.',
            -7 => '',
            -8 => 'Program already exists.',
            -9 => 'Parent Program already have applicant',
            -10 => 'Employee already exists.',
            -11 => '',
            -12 => 'Municipal does not exist.',
            -13 => '',
            -14 => 'Province does not exist.',
            -15 => '',
            -16 => 'Birth Town does not exist',
            -17 => '',
            -18 => 'User does not exist.',
            -19 => 'User does not exist.',
            -20 => 'Successfuly Deleted',
            -21 => '',
            -22 => 'Applicant does not exist.',
            -23 => 'Applicant already exists.',
            -24 => '',
            -25 => 'Hire Status does not exist.',
            -26 => '',
            -27 => 'Tax Code does not exist.',
            -28 => '',
            -29 => 'Position does not exist.',
            -30 => '',
            -31 => 'Barangay does not exist.',
            -32 => '',
            -33 => 'Municipal does not exist.',
            -34 => '',
            -35 => 'Province does not exist.',
            -36 => '',
            -37 => 'Birth Town does not exist.',
            -38 => '',
            -39 => 'User does not exist.',
            -40 => 'User does not exist.',
            -41 => '',
            -42 => '',
            -43 => 'Contact does not exist.',
            -44 => '',
            -45 => 'User does not exist.',
            -46 => 'User does not exist.',
            -47 => '',
            -48 => '',
            -49 => 'Applicant does not exist.',
            -50 => '',
            -51 => 'Contact Type does not exist.',
            -52 => '',
            -53 => 'Contact already exists',
            -54 => '',
            -55 => 'User does not exist.',
            -56 => 'User does not exist.',
            -57 => '',
            -58 => '',
            -59 => 'Applicant does not exist.',
            -60 => '',
            -61 => 'Contact Type does not exist.',
            -62 => '',
            -63 => 'Contact already exists',
            -64 => '',
            -65 => 'User does not exist.',
            -66 => 'User does not exist.',
            -67 => '',
            -68 => '',
            -69 => 'Applicant School does not exist.',
            -70 => '',
            -71 => 'User does not exist.',
            -72 => 'User does not exist.',
            -73 => '',
            -74 => '',
            -75 => 'Applicant does not exist.',
            -76 => '',
            -77 => 'School already exists',
            -78 => '',
            -79 => 'School already exists',
            -80 => '',
            -81 => 'User does not exist.',
            -82 => 'User does not exist.',
            -83 => '',
            -84 => '',
            -85 => 'Applicant does not exist.',
            -86 => '',
            -87 => 'Applicant School does not exist.',
            -88 => '',
            -89 => 'School already exists',
            -90 => '',
            -91 => 'School already exists',
            -92 => '',
            -93 => 'User does not exist.',
            -94 => 'User does not exist.',
            -95 => '',
            -96 => '',
            -97 => 'Applicant does not exist.',
            -98 => '',
            -99 => 'Applicant already exists',
            -100 => '',
            -101 => 'Company does not exist.',
            -102 => '',
            -103 => 'Location does not exist.',
            -104 => '',
            -105 => 'Payroll Mode does not exist.',
            -106 => '',
            -107 => 'Clinic does not exist.',
            -108 => '',
            -109 => 'Employee No Already Exists',
            -110 => '',
            -111 => 'Employee No Already Exists',
            -112 => '',
            -113 => 'User does not exist.',
            -114 => 'User does not exist.',
            -115 => '',
            -116 => '',
            -117 => 'Hire does not exist.',
            -118 => '',
            -119 => 'Company does not exist.',
            -120 => '',
            -121 => 'Location does not exist.',
            -122 => '',
            -123 => 'Payroll Mode does not exist.',
            -124 => '',
            -125 => 'Clinic does not exist.',
            -126 => '',
            -127 => 'Employee No Already Exists',
            -128 => '',
            -129 => 'Employee No Already Exists',
            -130 => '',
            -131 => 'User does not exist.',
            -132 => 'User does not exist.',
            -133 => '',
            -134 => '',
            -135 => 'Applicant does not exist.',
            -136 => '',
            -137 => 'Initial Employee does not exist.',
            -138 => '',
            -139 => 'Second Employee does not exist.',
            -140 => '',
            -141 => 'Final Employee does not exist.',
            -142 => '',
            -143 => 'User does not exist.',
            -144 => 'User does not exist.',
            -145 => '',
            -146 => '',
            -147 => 'Interview does not exist.',
            -148 => '',
            -149 => 'Initial Employee does not exist.',
            -150 => '',
            -151 => 'Second Employee does not exist.',
            -152 => '',
            -153 => 'Final Employee does not exist.',
            -154 => 'User does not exist.',
            -155 => '',
            -156 => '',
            -157 => 'Previous Work does not exist.',
            -158 => '',
            -159 => 'User does not exist.',
            -160 => 'User does not exist.',
            -161 => '',
            -162 => '',
            -163 => 'Employee does not exist.',
            -164 => '',
            -165 => 'Previous Work already exists',
            -166 => 'User does not exist.',
            -167 => 'User does not exist.',
            -168 => 'User does not exist.',
            -169 => '',
            -170 => '',
            -171 => 'Previous Work does not exist.',
            -172 => '',
            -173 => 'Prev Work already exists',
            -174 => '',
            -175 => 'User does not exist.',
            -176 => 'User does not exist.',
            -177 => '',
            -178 => '',
            -179 => 'Hire does not exist.',
            -180 => '',
            -181 => 'User does not exist.',
            -182 => 'User does not exist.',
            -183 => '',
            -184 => '',
            -185 => 'Hire does not exist.',
            -186 => '',
            -187 => 'User does not exist.',
            -188 => 'User does not exist.',
            -189 => '',
            -190 => '',
            -191 => 'Applicant does not exist.',
            -192 => '',
            -193 => 'Applicant already exists!',
            -194 => '',
            -195 => 'Specific program has already reached its maximum attendees.',
            -196 => '',
            -197 => 'User does not exist.',
            -198 => 'User does not exist.',
            -199 => '',
            -200 => '',
            -201 => 'Applicant does not exist.',
            -202 => '',
            -203 => 'Program does not exist',
            -204 => '',
            -205 => 'User does not exist.',
            -206 => 'User does not exist.',
            -207 => '',
            -208 => '',
            -209 => 'Employment Type does not exist',
            -210 => '',
            -211 => 'Employment Type does not exist',
        );

        //$result = 'Database or Server error. (Error Code: ' . $num . ')';

        if(!empty($error[$return])) :
            $result = $error[$return] . ' (Error Code: ' . $return . ')';
        else :
            $result = 'Database Error. (Error Code: ' . $return . ')';
        endif;

        return $result;
    }
    public static function decryptMyHUB($data)
    {
        $password = 'atp_dev';

        $method = 'aes-256-cbc';
        // Must be exact 32 chars (256 bit)
        $$password = substr(hash('sha256', $password, true), 0, 32);
        // IV must be exact 16 chars (128 bit)
        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
                  chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
                  chr(0x0) .chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) .
                  chr(0x0);

          // av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
          $decrypted = openssl_decrypt(base64_decode($data), $method, $password, OPENSSL_RAW_DATA, $iv);

        return $decrypted;
    }

    public static function decrypt($data)
    {
      $hashKey = 'atp_dev';

      $METHOD = 'aes-256-cbc';
      $IV = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
      $key = substr(hash('sha256', $hashKey, true), 0, 32);
      $decrypted = openssl_decrypt(base64_decode($data),$METHOD, $key, OPENSSL_RAW_DATA, $IV);

      return $decrypted;
    }


    public static function buildJsonTable($count, $encode)
    {
        $draw = request()->input('draw');
        $start = request()->input('start');
        $length = request()->input('length');
        $pageSize = ($length != null ? $length :0);
        $skip = ($start != null ? $start : 0);
        $recordsTotal = $count;
        $data = array_slice($encode, $skip, $pageSize);

        return '{"draw":"'.$draw.'","recordsFiltered":'.$recordsTotal.',"recordsTotal":'.$recordsTotal.',"data":'.json_encode($data).'}';
    }


    public static function encrypt($data)
    {
      $hashKey = 'atp_dev';

      $METHOD = 'aes-256-cbc';
      $IV = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
      $key = substr(hash('sha256', $hashKey, true), 0, 32);
      $encrypt= base64_encode(openssl_encrypt($data,$METHOD,$key, OPENSSL_RAW_DATA, $IV));

      return $encrypt;
    }


    public static function checkUserAccess($data,$actionIDs)
    {
      if(is_array($actionIDs)):
        foreach($data['userAccess'] as $access):
          if($access['Module_ID'] == $data['moduleID'] && $access['Action_ID'] == 1):
             return true;
          endif;
          if($access['Module_ID'] == $data['moduleID']):
            if(in_array($access['Action_ID'], $actionIDs)):
              return true;
            endif;
          endif;
        endforeach;
      else:
        foreach($data['userAccess'] as $access):
          if($access['Module_ID'] == $data['moduleID'] && $access['Action_ID'] == 1):
            return true;
          endif;
          if($access['Action_ID']  ==  $actionIDs &&
              $access['Module_ID'] == $data['moduleID']):
            return true;
          endif;
        endforeach;
      endif;
      return false;
    }

    public static function getTime()
    {
       $datetime= Carbon::now();
       $time = $datetime->toTimeString();
       return $time;
    }

    public static function check5pm()
    {
        $now = Carbon::now();

        $start = Carbon::createFromTimeString('05:00');
        $end = Carbon::createFromTimeString('17:00');
        if($now->between($start, $end))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}



