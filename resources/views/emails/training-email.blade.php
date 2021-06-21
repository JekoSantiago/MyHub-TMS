<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: \'Noto Sans JP\', sans-serif;
            font-size: 12px;
        }

        .email-table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
            font-size: 12px;
        }

        .email-table tr th {
            padding: 5px;
            text-align: left;
        }

        .email-table tr td {
            padding: 5px;
            text-align: left;
        }

        .email-table td,
        .email-table th {
            border: 1px solid black;
        }


            </style>
        </head>
    <body>
    <a href="{{env('MYHUB_URL')}}"> <img src="https://myhub.atp.ph/resource/style1/img/myhublogo.png" width="280" /></a>
        <div class="body-content container">
            {!! $content !!}<br>
            <table class="email-table">
                <tr>
                    <th>Training</th>
                    <td>{{ $trainingName }}</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td>{{ $location }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $date }}</td>
                </tr>
            </table>
         </div>
         @php
         $redirect    = base64_encode(env('APP_URL'));
         $subredirect = base64_encode(env('APP_URL').'/trainings-applicant');
   @endphp
        <p> Visit <a href="{{env('MYHUB_URL')}}/?redirect={{$redirect}}&&sub-redirect={{$subredirect}}">MyHub : HR APPS - TMS</a> for more details.</p>
    </body>
</html>
