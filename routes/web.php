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

//学生トップページ
Route::get('/', 'HomeController@index')->name('home');
//大学トップページ
Route::get('/institution', 'HomeController@institution')->name('institution');
Route::get('/institution/login', 'Auth\LoginController@institutionLogin')->name('institution.login');
Route::get('/institution/contact', '@institutionLogin')->name('institution.login');

// Auth前の大学名チェック
// Route::get('/inst/home', 'InstsController@home')->name('inst.home');
// Route::get('inst/search', 'InstsController@index')->name('inst.search.page');
// Route::post('inst/search', 'InstsController@search')->name('inst.search');


//大学Authentification
Route::get('/inst/{inst_id}/register/{token}', 'UsersController@registration_view')->name('user.registration.form');

// Route::get('/inst/register', 'Auth\RegisterController@showInstUserRegistrationForm')->name('instUser.registration.form');
// Route::get('/inst/team/register', 'Auth\RegisterController@showInstTeamUserRegistrationForm')->name('instUser.registration.form');
Route::post('/inst/register', 'Auth\RegisterController@register')->name('user.register');
Route::get('/inst/login','Auth\LoginController@showLoginForm')->name('user.login.form');
Route::post('/inst/login','Auth\LoginController@login')->name('user.login');
Route::post('/inst/logout', 'Auth\LoginController@logout')->name('user.logout');

//学生Authentification
Route::get('/student/register', 'Student\Auth\RegisterController@showRegistrationForm')->name('student.registration.form');
Route::post('/student/register', 'Student\Auth\RegisterController@register')->name('student.register');
Route::get('/student/login','Student\Auth\LoginController@showLoginForm')->name('student.login.form');
Route::post('/student/login','Student\Auth\LoginController@login')->name('student.login');
Route::post('/student/logout','Student\Auth\LoginController@logout')->name('student.logout');

//学生パスワードリセット
Route::get('password/student/reset', 'Student\Auth\ForgotPasswordController@showLinkRequestForm')->name('student.password.request');
Route::post('password/student/email', 'Student\Auth\ForgotPasswordController@sendResetLinkEmail')->name('student.password.email');
Route::get('password/student/reset/{token}', 'Student\Auth\ResetPasswordController@showResetForm')->name('student.password.reset');
Route::post('password/student/reset', 'Student\Auth\ResetPasswordController@reset')->name('student.password.update');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

//大学パスワード変更
// Route::group(['middleware' => ['auth', 'can:institution']], function(){
//     Route::post('/user/update-password', 'UsersController@updatePassword');
// });
Route::group(['middleware' => ['auth', 'can:institution']], function(){
    Route::post('/user/update-password', 'UsersController@updatePassword')->name('user.update.password');
});
//             //
//     大学     //
//             //

// 各種情報の取得
Route::group(['middleware' => ['auth', 'can:institution']], function(){
    Route::get('/inst/fetch-user','UsersController@fetchUser')->name('user.fetch.user');
    Route::get('/inst/fetch-inst','UsersController@fetchInst')->name('user.fetch.inst');
    Route::get('/inst/fetch-initials','UsersController@fetchInitials')->name('user.fetch.initials');
    Route::get('/inst/fetch-events', 'UsersController@fetchEvents')->name('user.fetch.events');
    Route::get('/inst/fetch-single-event/{id}', 'UsersController@fetchSingleEvent')->name('user.fetch.single.events');
    Route::get('/inst/fetch-levels', 'LevelsController@fetchLevels')->name('user.fetch.levels');
    Route::get('/inst/fetch-subjects', 'SubjectsController@fetchSubjects')->name('user.fetch.subjects');
    Route::get('/inst/fetch-regions', 'RegionsController@fetchRegions')->name('user.fetch.regions');
    Route::get('/inst/fetch-event-regions/{id}', 'RegionsController@fetchEventRegions')->name('user.fetch.event.regions');
    Route::get('/inst/fetch-event-levels/{id}', 'LevelsController@fetchEventLevels')->name('user.fetch.event.levels');
    Route::get('/inst/fetch-event-subjects/{id}', 'SubjectsController@fetchEventSubjects')->name('user.fetch.event.subjects');
    Route::get('/inst/event-participants/{id}', 'BookingsController@fetchEventParticipants')->name('user.fetch.event.participants');
    Route::get('/inst/fetch-eventowner/{id}', 'EventsController@fetchEventOwner')->name('user.fetch.event.owner');
});

// スーパー管理者のメンバー管理
Route::group(['middleware' => ['auth', 'can:superAdmin']], function(){
    Route::post('/inst/invite-members', 'UsersController@process_invites')->name('user.process_invites');
    Route::get('/inst/fetch-members', 'UsersController@fetchTeamMembers')->name('user.fetch.members');
    Route::post('/inst/delete-members/{id}', 'UsersController@deleteTeamMembers')->name('user.delete.members');
});

//Event Charts
Route::group(['middleware' => ['auth', 'can:institution']], function(){
    Route::get('/inst/participant-countries/{id}', 'CountriesController@fetchStudentCountries')->name('user.participant.countries');
    Route::get('/inst/participant-levels/{id}', 'LevelsController@fetchStudentLevels')->name('user.participant.levels');
    Route::get('/inst/participant-destinations/{id}', 'CountriesController@fetchStudentDestinations')->name('user.participant.destinations');
    Route::get('/inst/participant-subjects/{id}', 'SubjectsController@fetchStudentSubjects')->name('user.participant.subjects');
    Route::get('/inst/event-bookings/{id}', 'BookingsController@fillChartDataForBookings')->name('user.event.bookings');
    Route::get('/inst/event-likes/{id}', 'LikesController@fillChartDataForLikes')->name('user.event.likes');
    Route::get('/inst/bookings-number/{id}', 'BookingsController@countBookingsNumber')->name('user.bookings.number');
    Route::get('/inst/likes-number/{id}', 'LikesController@countLikesNumber')->name('user.likes.number');
    Route::get('/inst/questions-number/{id}', 'QueriesController@countQuestionsNumber')->name('user.questions.number');
});


// Create event
Route::group(['middleware' => ['auth', 'can:institution']], function(){
    Route::post('/inst/create-basics', 'EventsController@storeBasics')->name('user.create.basics');
    Route::post('/inst/create-selects', 'EventsController@storeSelects')->name('user.create.selects');
    Route::post('/inst/create-file', 'EventsController@storeFile')->name('user.create.files');
});

// Edit event
Route::group(['middleware' => ['auth', 'can:institution']], function(){
    Route::post('/inst/update-basics', 'EventsController@updateBasics')->name('user.update.basics');
    Route::post('/inst/update-regions', 'EventsController@updateRegions')->name('user.update.regions');
    Route::post('/inst/update-levels', 'EventsController@updateLevels')->name('user.update.levels');
    Route::post('/inst/update-subjects', 'EventsController@updateSubjects')->name('user.update.subjects');
    Route::post('/inst/update-description', 'EventsController@updateDescription')->name('user.update.description');
    Route::post('/inst/update-image', 'EventsController@updateImage')->name('user.update.image');
    Route::post('/inst/publish-event/{id}', 'EventsController@publishEvent')->name('user.publish.event');
    Route::post('/inst/unpublish-event/{id}', 'EventsController@unpublishEvent')->name('user.unpublish.event');
});

// Notifications
Route::group(['middleware' => ['auth', 'can:institution']], function(){
    Route::post('/inst/email-participants', 'ParticipantNotificationsController@store')->name('user.email.participants');
    Route::get('/inst/emailstoparticipants-list', 'ParticipantNotificationsController@fetchList')->name('user.email.participantslist');
    Route::post('/inst/schedule-emailstoparticipants', 'ParticipantNotificationsController@schedule')->name('user.schedule.emailstoparticipants');
    Route::post('/inst/reschedule-emailstoparticipants', 'ParticipantNotificationsController@reschedule')->name('user.reschedule.emailstoparticipants');
    Route::get('/inst/send-emailstoparticipants', 'BookingsController@sendEmailsToParticipants')->name('user.send.emailstoparticipants');
    Route::get('/inst/fetchevents-emails', 'EventsController@fetchEventsForEmails')->name('user.fetch.event.emails');
});

//Edit Profile
Route::group(['middleware' => ['auth', 'can:institution']], function(){
    Route::post('/user/update-basicinfo', 'UsersController@updateBasics')->name('user.update.basicinfo');
    Route::post('/user/update-email', 'UsersController@updateEmail')->name('user.update.email');
    Route::get('/user/timezone-list', 'UsersController@getTimezoneList')->name('user.timezone.list');
    Route::post('/user/update-timezone', 'UsersController@updateTimezone')->name('user.update.timezone');
});



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
Route::group(['middleware' => ['auth:student', 'can:student']], function(){
   
});

Route::get('/student/fetch-user','StudentsController@fetchStudentUser')->name('student.fetch.user');
Route::get('/student/fetch-initials','StudentsController@fetchInitials')->name('student.fetch.initials');
Route::get('/student/fetch-regions','RegionsController@fetchRegions')->name('student.fetch.regions');
Route::get('/student/fetch-levels','LevelsController@fetchLevels')->name('student.fetch.levels');
Route::get('/student/fetch-subjects','SubjectsController@fetchSubjects')->name('student.fetch.subjects');
Route::get('/student/fetch-countries','CountriesController@fetchCountries')->name('student.fetch.countries');
Route::get('/student/fetch-destinations','CountriesController@fetchDestinations')->name('student.fetch.destinations');
Route::get('/student/fetch-years','YearsController@fetchYears')->name('student.fetch.years');
Route::get('/student/fetch-events', 'EventsController@fetchAllEvents')->name('student.fetch.events');
Route::get('/student/event-subjects', 'EventsController@recommendSubjectEvents')->name('student.event.subjects');
Route::get('/student/event-destinations', 'EventsController@recommendDestinationEvents')->name('student.event.destinations');
Route::get('/student/event-regions', 'EventsController@recommendRegionEvents')->name('student.event.regions');
Route::get('/student/fetch-details/{id}', 'EventsController@fetchSingleEvent')->name('student.fetch.details');
Route::get('/student/fetch-inst/{id}', 'InstsController@fetchInst')->name('student.fetch.inst');
Route::get('/student/fetch-bookedevents/{id}', 'BookingsController@fetchBookedEvents')->name('student.fetch.bookedevents');
Route::get('/student/fetch-likedevents/{id}', 'EventsController@fetchLikedEvents')->name('student.fetch.likedevents');
Route::get('/student/fetch-followinginsts/{id}', 'InstsController@fetchFollowedInsts')->name('student.fetch.followinginsts');
Route::get('/student/fetch-eventlist/{id}', 'EventsController@fetchEventsList')->name('student.fetch.eventlist');
Route::get('/student/fetch-bookedevent/{id}', 'EventsController@fetchSingleBookedEvent')->name('student.fetch.bookedevent');

//学生追加情報の登録
Route::group(['middleware' => ['auth:student', 'can:student']], function(){
    Route::post('/student/add-details', 'StudentsController@addStudentDetails')->name('student.add.details');
});

//学生イベント予約
Route::group(['middleware' => ['auth:student', 'can:student']], function(){
    Route::post('/student/register-event', 'BookingsController@store')->name('student.register.event');
    Route::post('/student/cancel-event', 'BookingsController@cancel')->name('student.cancel.event');
    Route::get('/student/fetch-categories', 'CategoriesController@index')->name('student.fetch.categories');
    Route::post('/student/event-queries', 'QueriesController@store')->name('student.event.queries');
    Route::post('/student/like-event', 'LikesController@store')->name('student.like.event');
    Route::post('/student/unlike-event', 'LikesController@unlike')->name('student.unlike.event');
});

// Route::get('/student/test', 'LikesController@test');


//学生フォロー
Route::group(['middleware' => ['auth:student', 'can:student']], function(){
    Route::post('/student/follow-inst', 'FollowsController@store')->name('student.follow.inst');
    Route::post('/student/unfollow-inst', 'FollowsController@unfollow')->name('student.unfollow.inst');
});


//学生プロフィール編集
Route::group(['middleware' => ['auth:student', 'can:student']], function(){
    Route::post('/student/update-basicinfo', 'StudentsController@updateBasics')->name('student.update.basicinfo');
    Route::post('/student/update-email', 'StudentsController@updateEmail')->name('student.update.email');
    Route::post('/student/update-password', 'StudentsController@updatePassword')->name('student.update.password');
    Route::get('/student/timezone-list', 'StudentsController@getTimezoneList')->name('student.update.list');
    Route::post('/student/update-timezone', 'StudentsController@updateTimezone')->name('student.update.timezone');
    Route::get('/student/fetch-year', 'StudentsController@fetchStudentYear')->name('student.fetch.year');
    Route::post('/student/uddate-year', 'StudentsController@updateYear')->name('student.update.year');
    Route::get('/student/fetch-yearlist', 'YearsController@fetchYears')->name('student.fetch.year.list');
    Route::get('/student/fetch-destinations', 'CountriesController@fetchDestinationList')->name('student.fetch.destination.list');
    Route::get('/student/fetch-levels', 'LevelsController@fetchLevelList')->name('student.fetch.level.list');
    Route::get('/student/fetch-subjects', 'SubjectsController@fetchSubjectList')->name('student.fetch.subject.list');
    Route::get('/student/fetch-preference', 'StudentsController@fetchPreference')->name('student.fetch.preference');
    Route::post('/student/update-destinations', 'StudentsController@updateDestinations')->name('student.update.destinations');
    Route::post('/student/update-levels', 'StudentsController@updateLevels')->name('student.update.levels');
    Route::post('/student/update-subjects', 'StudentsController@updateSubjects')->name('student.update.subjects');
});

//学生イベントサーチ
Route::post('/student/search-event', 'EventsController@searchItems')->name('student.search');


//テスト
// Route::get('/test', 'HomeController@test');

// Vue
//Only inst user can access.
Route::group(['middleware' => ['auth', 'can:institution']], function(){
    Route::get('/inst/{any}', function () {
        return view('inst.main');
    })->where('any','.*');
});

// Route::group(['middleware' => ['auth:student', 'can:student']], function(){
    
// });

Route::get('/student/{any}', function () {
    return view('student.main');
})->where('any','.*');

// Route::get('/student/{any}', function () {
//     return view('student.main');
// })->where('any','.*');

