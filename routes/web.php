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
Route::get('/logout','AuthController@logout')->name('logout');


// Pages
Route::get('/home','PageController@viewHome')->name('home');
Route::get('/programs','PageController@Programs')->name('page.programs');
Route::get('/trainings-applicant','PageController@ApplicantTrainings')->name('page.training.app');
Route::get('/trainings-employee','PageController@EmployeeTrainings')->name('page.training.emp');
Route::get('/location','PageController@Locations')->name('page.locations');
Route::get('/employees','PageController@Employees')->name('page.employees');
Route::get('/trainees','PageController@Trainees')->name('page.trainees');

//Programs
Route::get('/programs-table','ProgramsController@getPrograms')->name('programs.table');
Route::get('/programs-new','ProgramsController@showNewProgram');
Route::post('/programs-store','ProgramsController@insertNewProgram')->name('programs.insert');
Route::get('/programs-edit/{id}','ProgramsController@showEditProgram');
Route::post('/programs-update','ProgramsController@updateProgram')->name('programs.update');

//Locations
Route::get('/locations-table','LocationsController@getLocations')->name('locations.table');
Route::get('/locations-new', function () { return view('pages.locations.modals.content.new_location');});
Route::post('/locations-store','LocationsController@insertLocations');
Route::get('/locations-edit/{id}','LocationsController@showEditLocation');
Route::post('/locations-update','LocationsController@updateLocation');

//Trainings
Route::any('/trainings-tables','TrainingController@getTrainings');
Route::get('/trainings-new','TrainingController@showNewTraining');
Route::post('/trainings-store','TrainingController@insertTraining');
Route::get('/trainings-edit-emp/{id}','TrainingController@showEditTraining');
Route::post('/trainings-update','TrainingController@updateTraining');
//Employee Training
Route::any('/train-employee/{id}','TrainingController@trainEmployee');
Route::get('/train-employee-tbl1','TrainingController@trainEmpTableOne');
Route::post('/train-employee-tbl2','TrainingController@trainEmpTableTwo');
Route::post('/train-emp','TrainingController@insertTrainingEmployee');
Route::post('/train-del','TrainingController@deleteTrainingEmployee');
Route::get('/train-emp-ratings','TrainingController@showRatingsEmployee');
Route::post('/update-ratings-emp','TrainingController@updateRatingsEmployee');
Route::get('/trainings-edit-emp/{id}','TrainingController@showEditTrainingEmp');
//Applicant Training
Route::any('/train-applicant/{id}','TrainingController@trainApplicant');
Route::POST('/train-applicant-tbl','TrainingController@trainAppTable');
Route::post('/update-ratings-app','TrainingController@updateRatingsApp');
Route::get('/trainings-program-app/{id}','TrainingController@getProgramApp');
Route::post('/program-app-tbl','TrainingController@tblProgrammApp');
Route::get('/trainings-edit-app/{id}','TrainingController@showEditTrainingApp');
// Route::post('/auto-enroll','TrainingController@getAvailablePrograms');
Route::post('/insert-program-app','TrainingController@insertProgramApp');
Route::post('/update-program-app','TrainingController@updateProgramApp');
Route::post('/train-app','TrainingController@insertTrainingApp' );
Route::post('/app-del', 'TrainingController@deleteAppTraining');
Route::post('/app-det','TrainingController@getEnrolledTraining');
Route::post('/app-fail','TrainingController@updateFailRatings');
Route::post('/check-rate','TrainingController@checkRatingsCount');
Route::post('/check-train','TrainingController@checkTrainingDone');
Route::post('/check-eligable','TrainingController@checkEligableAuto');
Route::post('/check-ratings','TrainingController@checkRatingApp');

//Options
Route::get('/get-dc','OptionsController@getDC');
Route::post('/get-prov/{id}','OptionsController@getProv');
Route::post('/get-store','OptionsController@getStore');
Route::get('/get-programs','OptionsController@getProgramsOptions');
Route::get('/get-locations','OptionsController@getLocationsOptions');
Route::post('/get-sequence','OptionsController@getSeqPrograms');

//Employees
Route::get('/employees-table','EmployeesController@getEmployees');
Route::get('/employee-look/{id}','EmployeesController@getEmployeeDetails');
Route::get('/employee-det-table','EmployeesController@dataTableEmpDet');
Route::post('/employee-details-table','EmployeesController@dataTableEmpDet');

//Trainees
Route::get('/trainees-table','TraineesController@getTrainees');
Route::get('/applicant-look/{id}','TraineesController@getTraineesID');
Route::post('/applicant-details-table','TraineesController@dataTableAppDet');


// EMAIL
Route::post('/email-create','TrainingEmailController@sendEmailNotif');
Route::post('/recruitment-notif','ProgramEmailController@recruitmentNotif');


Route::get('/zxc',function(){
    DD(Session::all());
});


