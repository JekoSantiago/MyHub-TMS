@php use App\Helper\MyHelper; @endphp
<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{route('home')}}">
                        <i data-feather="home"></i>
                        <span> Home </span>
                    </a>
                </li>


                @php $checkAccessParams['userAccess'] = Session::get('UserAccess');
                     $checkAccessParams['moduleID'] = env('MODULE_PROGRAMS');
                @endphp
                @if(MyHelper::checkUserAccess($checkAccessParams,[env('APP_ACTION_ALL')]))
                <li>
                    <a href="{{route('page.programs')}}">
                        <i data-feather="activity"></i>
                        <span> Programs </span>
                    </a>
                </li>
                @endif

                @php $checkAccessParams['moduleID'] = env('MODULE_TRAIN_APPLICANTS'); @endphp
                @if(MyHelper::checkUserAccess($checkAccessParams,[env('APP_ACTION_ALL')]))
                <li>
                    <a href="{{route('page.training.app')}}">
                        <i data-feather="layers"></i>
                        <span> Applicant Trainings </span>
                    </a>
                </li>
                @endif

                @php $checkAccessParams['moduleID'] = env('MODULE_TRAIN_EMPLOYEES'); @endphp
                @if(MyHelper::checkUserAccess($checkAccessParams,[env('APP_ACTION_ALL')]))
                <li>
                    <a href="{{route('page.training.emp')}}">
                        <i data-feather="briefcase"></i>
                        <span> Employee Trainings </span>
                    </a>
                </li>
                @endif

                @php $checkAccessParams['moduleID'] = env('MODULE_LOCATIONS'); @endphp
                @if(MyHelper::checkUserAccess($checkAccessParams,[env('APP_ACTION_ALL')]))
                <li>
                    <a href="{{ route('page.locations') }}">
                        <i data-feather="map-pin"></i>
                        <span> Location </span>
                    </a>
                </li>
                @endif

                @php $checkAccessParams['moduleID'] = env('MODULE_EMPLOYEES'); @endphp
                @if(MyHelper::checkUserAccess($checkAccessParams,[env('APP_ACTION_ALL')]))
                <li>
                    <a href="{{ route('page.employees') }}">
                        <i data-feather="user"></i>
                        <span> Employees </span>
                    </a>
                </li>
                @endif

                @php $checkAccessParams['moduleID'] = env('MODULE_APPLICANTS'); @endphp
                @if(MyHelper::checkUserAccess($checkAccessParams,[env('APP_ACTION_ALL')]))
                <li>
                    <a href="{{ route('page.trainees') }}">
                        <i data-feather="users"></i>
                        <span> Trainees </span>
                    </a>
                </li>
                @endif

                <li>
                    <a href="#sidebarProjects" data-toggle="collapse" aria-expanded="false" >
                        <i class="mdi mdi-briefcase-check-outline"></i>
                        <span class="menu-collapsed"> Projects </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse sidebar-submenu" id="sidebarProjects" style="">
                        <ul class="nav-second-level">
                            <li>
                                <a href="project-list.html" class="menu-collapsed">List</a>
                            </li>
                            <li>
                                <a href="project-detail.html" class="menu-collapsed">Detail</a>
                            </li>
                            <li>
                                <a href="project-create.html" class="menu-collapsed">Create Project</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
