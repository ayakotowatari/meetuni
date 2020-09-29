<?php

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

// Route::get('/', function () {
//     return view('home');
// });

// Auth前の大学名チェック
Route::get('/inst/home', 'InstsController@home')->name('inst.home');
Route::get('inst/search', 'InstsController@index')->name('inst.search.page');
Route::post('inst/search', 'InstsController@search')->name('inst.search');


//大学Authentification
Route::post('/inst/invite-members', 'UsersController@process_invites')->name('inst.process_invites');
Route::get('/inst/{inst_id}/register/{token}', 'UsersController@registration_view')->name('instUser.registration.form');

// Route::get('/inst/register', 'Auth\RegisterController@showInstUserRegistrationForm')->name('instUser.registration.form');
// Route::get('/inst/team/register', 'Auth\RegisterController@showInstTeamUserRegistrationForm')->name('instUser.registration.form');
Route::post('/inst/register', 'Auth\RegisterController@register')->name('instUser.register');
Route::get('/inst/login','Auth\LoginController@showLoginForm')->name('instUser.login.form');
Route::post('/inst/login','Auth\LoginController@login')->name('instUser.login');
Route::post('/inst/logout', 'Auth\LoginController@logout')->name('instUser.logout');

//学生Authentification
Route::get('/', 'HomeController@index')->name('home');
Route::get('/student/register', 'Student\Auth\RegisterController@showRegistrationForm')->name('student.registration.form');
Route::post('/student/register', 'Student\Auth\RegisterController@register')->name('student.register');
Route::get('/student/login','Student\Auth\LoginController@showLoginForm')->name('student.login.form');
//Shops用ログインボタンクリック時
Route::post('/student/login','Student\Auth\LoginController@login')->name('student.login');
//Shops用ログアウトボタンクリック時
Route::post('/student/logout','Student\Auth\LoginController@logout')->name('student.logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//大学パスワード変更
// Route::group(['middleware' => ['auth', 'can:institution']], function(){
//     Route::post('/user/update-password', 'UsersController@updatePassword');
// });
Route::post('/user/update-password', 'UsersController@updatePassword')->name('inst.update.password');

//             //
//     大学     //
//             //

// 各種情報の取得
Route::get('/inst/fetch-user','UsersController@fetchUser');
Route::get('/inst/fetch-inst','UsersController@fetchInst');
Route::get('/inst/fetch-initials','UsersController@fetchInitials');
Route::get('/inst/fetch-events', 'UsersController@fetchEvents');
Route::get('/inst/fetch-single-event/{id}', 'UsersController@fetchSingleEvent');
Route::get('/inst/fetch-levels', 'LevelsController@fetchLevels');
Route::get('/inst/fetch-subjects', 'SubjectsController@fetchSubjects');
Route::get('/inst/fetch-regions', 'RegionsController@fetchRegions');
Route::get('/inst/fetch-event-regions/{id}', 'RegionsController@fetchEventRegions');
Route::get('/inst/fetch-event-levels/{id}', 'LevelsController@fetchEventLevels');
Route::get('/inst/fetch-event-subjects/{id}', 'SubjectsController@fetchEventSubjects');
Route::get('/inst/event-participants/{id}', 'BookingsController@fetchEventParticipants');
Route::get('/inst/fetch-members', 'UsersController@fetchTeamMembers');
Route::post('/inst/delete-members/{id}', 'UsersController@deleteTeamMembers');
Route::get('/inst/fetchevents-emails', 'EventsController@fetchEventsForEmails');

//Charts
Route::get('/inst/participant-countries/{id}', 'CountriesController@fetchStudentCountries');
Route::get('/inst/participant-levels/{id}', 'LevelsController@fetchStudentLevels');
Route::get('/inst/participant-destinations/{id}', 'CountriesController@fetchStudentDestinations');
Route::get('/inst/participant-subjects/{id}', 'SubjectsController@fetchStudentSubjects');

// Route::get('/inst/event/current-info/{id}', 'EventsController@fetchEditEvent');

// Create event
Route::post('/inst/create-basics', 'EventsController@storeBasics');
Route::post('/inst/create-selects', 'EventsController@storeSelects');
Route::post('/inst/create-file', 'EventsController@storeFile');

// Edit event
Route::post('/inst/update-basics', 'EventsController@updateBasics');
Route::post('/inst/update-regions', 'EventsController@updateRegions');
Route::post('/inst/update-levels', 'EventsController@updateLevels');
Route::post('/inst/update-subjects', 'EventsController@updateSubjects');
Route::post('/inst/update-description', 'EventsController@updateDescription');
Route::post('/inst/update-image', 'EventsController@updateImage');
Route::post('/inst/publish-event/{id}', 'EventsController@publishEvent');
Route::post('/inst/unpublish-event/{id}', 'EventsController@unpublishEvent');

// Generate charts
Route::get('/inst/event-bookings/{id}', 'BookingsController@fillChartDataForBookings');
Route::get('/inst/event-likes/{id}', 'LikesController@fillChartDataForLikes');
Route::get('/inst/bookings-number/{id}', 'BookingsController@countBookingsNumber');
Route::get('/inst/likes-number/{id}', 'LikesController@countLikesNumber');
Route::get('/inst/questions-number/{id}', 'QueriesController@countQuestionsNumber');

// Notifications
Route::post('/inst/email-participants', 'ParticipantNotificationsController@store');
Route::get('/inst/emailstoparticipants-list', 'ParticipantNotificationsController@fetchList');
Route::post('/inst/schedule-emailstoparticipants', 'ParticipantNotificationsController@schedule');
Route::get('/inst/send-emailstoparticipants', 'BookingsController@sendEmailsToParticipants');

//Edit Profile
Route::post('/user/update-basicinfo', 'UsersController@updateBasics');
Route::post('/user/update-email', 'UsersController@updateEmail');
Route::get('/user/timezone-list', 'UsersController@getTimezoneList');
Route::post('/user/update-timezone', 'UsersController@updateTimezone');


// テスト
// Route::post('/inst/test/store', 'ImagesController@store');
// Route::get('/inst/image/test', 'ImagesController@index');
// Route::get ('/inst/image/get', 'ImagesController@displayImage')-> name('inst.show');
// Route::get ('/inst/create-event', 'ImagesController@testshow')-> name('inst.show');
// Route::post('inst/region', 'RegionsController@test');
// Route::get('/inst/testform', 'ImagesController@testform');
// Route::post('/inst/testform', 'ImagesController@addTestform');
// Route::post('/inst/testform/update', 'ImagesController@testformUpdate');
// Route::get('/inst/test', 'UsersController@getTimezoneList');
//テスト終わる

//             //
//     学生     //
//             //
// 各種情報の取得
Route::get('/student/fetch-user','StudentsController@fetchStudentUser');
Route::get('/student/fetch-initials','StudentsController@fetchInitials');
Route::get('/student/fetch-regions','RegionsController@fetchRegions');
Route::get('/student/fetch-levels','LevelsController@fetchLevels');
Route::get('/student/fetch-subjects','SubjectsController@fetchSubjects');
Route::get('/student/fetch-countries','CountriesController@fetchCountries');
Route::get('/student/fetch-destinations','CountriesController@fetchDestinations');
Route::get('/student/fetch-years','YearsController@fetchYears');
Route::get('/student/fetch-events', 'EventsController@fetchAllEvents');
Route::get('/student/event-subjects', 'EventsController@recommendSubjectEvents');
Route::get('/student/event-destinations', 'EventsController@recommendDestinationEvents');
Route::get('/student/event-regions', 'EventsController@recommendRegionEvents');
Route::get('/student/fetch-details/{id}', 'EventsController@fetchSingleEvent');
Route::get('/student/fetch-inst/{id}', 'InstsController@fetchInst');
Route::get('/student/fetch-bookedevents/{id}', 'BookingsController@fetchBookedEvents');
Route::get('/student/fetch-likedevents/{id}', 'EventsController@fetchLikedEvents');
Route::get('/student/fetch-followinginsts/{id}', 'InstsController@fetchFollowedInsts');
Route::get('/student/fetch-eventlist/{id}', 'EventsController@fetchEventsList');
Route::get('/student/fetch-bookedevent/{id}', 'EventsController@fetchSingleBookedEvent');

//学生追加情報の登録
Route::post('/student/add-details', 'StudentsController@addStudentDetails');

//学生イベント予約
Route::post('/student/register-event', 'BookingsController@store');
Route::post('/student/cancel-event', 'BookingsController@cancel');
Route::get('/student/fetch-categories', 'CategoriesController@index');
Route::post('/student/event-queries', 'QueriesController@store');
Route::post('/student/like-event', 'LikesController@store');
Route::post('/student/unlike-event', 'LikesController@unlike');

//学生フォロー
Route::post('/student/follow-inst', 'FollowsController@store');
Route::post('/student/unfollow-inst', 'FollowsController@unfollow');

//学生プロフィール編集
Route::post('/student/update-basicinfo', 'StudentsController@updateBasics');
Route::post('/student/update-email', 'StudentsController@updateEmail');
Route::post('/student/update-password', 'StudentsController@updatePassword');
Route::get('/student/timezone-list', 'StudentsController@getTimezoneList');
Route::post('/student/update-timezone', 'StudentsController@updateTimezone');
Route::get('/student/fetch-year', 'StudentsController@fetchStudentYear');
Route::post('/student/uddate-year', 'StudentsController@updateYear');
Route::get('/student/fetch-yearlist', 'YearsController@fetchYears');
Route::get('/student/fetch-destinations', 'CountriesController@fetchDestinationList');
Route::get('/student/fetch-levels', 'LevelsController@fetchLevelList');
Route::get('/student/fetch-subjects', 'SubjectsController@fetchSubjectList');
Route::get('/student/fetch-preference', 'StudentsController@fetchPreference');
Route::post('/student/update-destinations', 'StudentsController@updateDestinations');
Route::post('/student/update-levels', 'StudentsController@updateLevels');
Route::post('/student/update-subjects', 'StudentsController@updateSubjects');

//テスト
// Route::get('/test', 'HomeController@test');


// Vue
//Only inst user can access.
Route::group(['middleware' => ['auth', 'can:institution']], function(){
    Route::get('/inst/{any}', function () {
        return view('inst.main');
    })->where('any','.*');
});

Route::group(['middleware' => ['auth:student', 'can:student']], function(){
    Route::get('/student/{any}', function () {
        return view('student.main');
    })->where('any','.*');
});

// Route::get('/student/{any}', function () {
//     return view('student.main');
// })->where('any','.*');

