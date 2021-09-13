<?php

use App\Helper\MyHelper;
use App\Mail\MyTestMail;
use App\Mail\TestMail;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\CrapIndex;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Mail\Mailable;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Index
Route::any('/','AuthController@index');
Route::GET('/logout','AuthController@logout')->name('logout');


// Pages
Route::GET('/home','PageController@viewHome')->name('home');
Route::GET('/programs','PageController@Programs')->name('page.programs');
Route::GET('/trainings-applicant','PageController@ApplicantTrainings')->name('page.training.app');
Route::GET('/trainings-employee','PageController@EmployeeTrainings')->name('page.training.emp');
Route::GET('/location','PageController@Locations')->name('page.locations');
Route::GET('/employees','PageController@Employees')->name('page.employees');
Route::GET('/trainees','PageController@Trainees')->name('page.trainees');

//Programs
Route::GET('/programs-table','ProgramsController@GETPrograms')->name('programs.table');
Route::GET('/programs-new','ProgramsController@showNewProgram');
Route::POST('/programs-store','ProgramsController@insertNewProgram')->name('programs.insert');
Route::GET('/programs-edit/{id}','ProgramsController@showEditProgram');
Route::POST('/programs-update','ProgramsController@updateProgram')->name('programs.update');
Route::POST('/program-open','ProgramsController@openProgram');

//Locations
Route::GET('/locations-table','LocationsController@GETLocations')->name('locations.table');
Route::GET('/locations-new', function () { return view('pages.locations.modals.content.new_location');});
Route::POST('/locations-store','LocationsController@insertLocations');
Route::GET('/locations-edit/{id}','LocationsController@showEditLocation');
Route::POST('/locations-update','LocationsController@updateLocation');

//Trainings
Route::any('/trainings-tables','TrainingController@GETTrainings');
Route::GET('/trainings-new','TrainingController@showNewTraining');
Route::POST('/trainings-store','TrainingController@insertTraining');
Route::GET('/trainings-edit-emp/{id}','TrainingController@showEditTraining');
Route::POST('/trainings-update','TrainingController@updateTraining');
//Employee Training
Route::any('/train-employee/{id}','TrainingController@trainEmployee');
Route::GET('/train-employee-tbl1','TrainingController@trainEmpTableOne');
Route::POST('/train-employee-tbl2','TrainingController@trainEmpTableTwo');
Route::POST('/train-emp','TrainingController@insertTrainingEmployee');
Route::POST('/train-del','TrainingController@deleteTrainingEmployee');
Route::GET('/train-emp-ratings','TrainingController@showRatingsEmployee');
Route::POST('/update-ratings-emp','TrainingController@updateRatingsEmployee');
Route::GET('/trainings-edit-emp/{id}','TrainingController@showEditTrainingEmp');
//Applicant Training
Route::any('/train-applicant/{id}','TrainingController@trainApplicant');
Route::POST('/train-applicant-tbl','TrainingController@trainAppTable');
Route::POST('/update-ratings-app','TrainingController@updateRatingsApp');
Route::GET('/trainings-program-app/{id}','TrainingController@GETProgramApp');
Route::POST('/program-app-tbl','TrainingController@tblProgrammApp');
Route::GET('/trainings-edit-app/{id}','TrainingController@showEditTrainingApp');
Route::POST('/recom-count','TrainingController@recomCount');
// Route::POST('/auto-enroll','TrainingController@GETAvailablePrograms');
Route::POST('/insert-program-app','TrainingController@insertProgramApp');
Route::POST('/update-program-app','TrainingController@updateProgramApp');
Route::POST('/train-app','TrainingController@insertTrainingApp' );
Route::POST('/app-del', 'TrainingController@deleteAppTraining');
Route::POST('/app-det','TrainingController@GETEnrolledTraining');
Route::POST('/app-fail','TrainingController@updateFailRatings');
Route::POST('/check-rate','TrainingController@checkRatingsCount');
Route::POST('/check-train','TrainingController@checkTrainingDone');
Route::POST('/check-eligable','TrainingController@checkEligableAuto');
Route::POST('/check-ratings','TrainingController@checkRatingApp');

//Options
Route::GET('/GET-dc','OptionsController@GETDC');
Route::POST('/GET-prov/{id}','OptionsController@GETProv');
Route::POST('/GET-store','OptionsController@GETStore');
Route::GET('/GET-programs','OptionsController@GETProgramsOptions');
Route::GET('/GET-locations','OptionsController@GETLocationsOptions');
Route::POST('/GET-sequence','OptionsController@GETSeqPrograms');

//Employees
Route::GET('/employees-table','EmployeesController@GETEmployees');
Route::GET('/employee-look/{id}','EmployeesController@GETEmployeeDetails');
Route::GET('/employee-det-table','EmployeesController@dataTableEmpDet');
Route::POST('/employee-details-table','EmployeesController@dataTableEmpDet');

//Trainees
Route::POST('/trainees-table','TraineesController@GETTrainees');
Route::GET('/applicant-look/{id}','TraineesController@GETTraineesID');
Route::POST('/applicant-details-table','TraineesController@dataTableAppDet');


// EMAIL
Route::POST('/email-create','TrainingEmailController@sendEmailNotif');
Route::POST('/recruitment-notif','ProgramEmailController@recruitmentNotif');


Route::GET('/zxc',function(){
    DD(Session::all());
});


