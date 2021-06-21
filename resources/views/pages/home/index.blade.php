
<!-- /main content -->
@extends('layouts.main')
@section('css')
@endsection
@section('content')
@php use App\Helper\MyHelper; @endphp
    <div class="content-wrapper">
        <div class="row app-home">
            <div class="col-md-12">
                <div class="panel panel-flat app-home-content">
                    <div class="panel-body">
                        <div class="text-left">
                             <h1>Hello  <strong> {{  MyHelper::decrypt(Session::get('FullName')) }}</strong></h1>
                             <h3>
                             <p>You are in Alfamart <strong>Training Monitoring System</strong>. <br> Please proceed with your transaction.</p><br />
                             <p>Always here for you!.</p>
                             </h3>
                        </div>
                    </div>

                </div>
                <!-- /marketing campaigns -->
            </div>
        </div>
    </div>
@stop
