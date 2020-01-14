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
Route::get('/', function(){
    var_dump("current time" + new DateTime());
    var_dump("current time" + date("Y m d H"));
});
Route::get('/logoff', '\App\Http\Controllers\Auth\LoginController@logout')->name("logofff");

Auth::routes(['verify' => true]);
Route::get('/crud', function () {
    return view('test');
});
/**
 * User dashboard.
 */
Route::group(['middleware' => ['verified']], function() {

    Route::get('/test', 'PostController@home');
    //Route::get('/{any}', 'PostController@home')->where('any', '.*');
    Route::resource('/posts', 'PostController');

    Route::post('/notification/get', 'NotificationController@get');
    Route::post('/notification/read', 'NotificationController@read');

    Route::get('get_all', 'PostController@getAllPosts');
    Route::post('create_post', 'PostController@createPost');

    // Authorization related routes.
    //Route::get('/', 'WelcomeController@index')->name('welcome');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name("logoff");
    Route::get('onderdeel/{id}', 'AssigmentController@index')->name('assigment');
    Route::get('', 'WelcomeController@index')->name('welcome');
    Route::get('onderdeel/{id}', 'AssigmentController@index')->name('assigment');
    Route::post('onderdeel/upload', 'AssigmentController@upload')->name('assigment.upload');
    Route::get('onderdelen', 'ComponentController@index')->name('components');




    Route::resource('forum', 'ForumController', [
        'names' => [
            'index' => 'forum',
            'create' => 'createForum',
            'store' => 'storeForum',
            'show' => 'showForum',
            'edit' => 'editForum',
            'update' => 'updateForum',
            'destroy' => 'deleteForum'
        ]
    ]);

    Route::resource('comment', 'ForumCommentController', [
        'names' => [
            'index' => 'comment',
            'edit' => 'editComment',
            'update' => 'updateComment',
            'destroy' => 'deleteComment'
        ]
    ]);

    Route::resource('account', 'AccountController', [
        'names' => [
            'index' => 'account',
            'create' => 'createAccount',
            'store' => 'storeAccount',
            'show' => 'showAccount',
            'edit' => 'editAccount',
            'update' => 'updateAccount',
            'destroy' => 'deleteAccount',
        ]
    ]);


//    Route::get('/nieuws', 'NewsController@index')->name('news');
//    Route::post('/nieuws/store', 'NewsController@store')->name('news.store');
//    Route::post('/nieuws/update/{id}', 'NewsController@update')->name('news.update');
//    Route::post('/nieuws/delete/{id}', 'NewsController@destroy')->name('news.destroy');

    Route::post('/nieuws/comment', 'CommentsController@store')->name('comment.store');

    Route::get('/voortgang', 'ProgressController@index')->name('voortgang');

    Route::get('/profile/{id}', 'AccountController@showProfile')->name('profile');
    Route::get('/profile/wijzigen/{id}', 'AccountController@editProfile')->name('profile.edit');

    Route::patch('profile/wijzigen/foto/{user}', 'AccountController@changeProfileImg')->name('profile.user.edit-img');
    Route::patch('profile/wijzigen/over/{user}', 'AccountController@editAbout')->name('profile.user.edit-about');
    Route::patch('profile/wijzigen/account/{user}', 'AccountController@editAccount')->name('profile.user.edit-account');

    Route::post('profilePicture', 'AccountController@changeProfilePicture')->name('changeProfilePicture');
    Route::post('changeRating', 'AccountController@changeRating')->name('changeRating');
    Route::post('upload', 'AssigmentController@upload')->name('upload');
    Route::post('download', 'AssigmentController@download')->name('download');
    Route::post('getUser', 'ProgressController@getuser')->name('getUser');

    Route::post('date', 'ComponentController@setDate')->name('setDate');
});

/**
 * Administrator dashboard.
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['role:administrator|docent']], function() {

    /**
     * Dashboard
     */
    Route::get('/', 'AdminController@index')->name('admin.index');

    /**
     * User management related routes.
     */
    Route::group(['prefix' => 'gebruikers'], function() {
        // List all users.
        Route::get('', 'UserController@index')->name('admin.users.index');
        Route::get('mentoren', 'UserController@showMentors')->name('admin.users.mentors');
        Route::get('studenten', 'UserController@showStudents')->name('admin.users.students');
        // Searching through users.
        Route::get('zoeken/{user}', 'UserController@index')->name('admin.users.search');
        // Creation of users.
        Route::post('nieuw', 'UserController@addUser')->name('create');
        Route::get('nieuw', 'UserController@showCreateUserForm')->name('admin.users.show-create');
        // Delete
        Route::delete('verwijderen/{user}', 'UserController@deleteUser')->name('admin.users.delete-user');
        // Edit stuff.
        Route::patch('aanpassen/{user}', 'UserController@editUser')->name('admin.users.edit-user');
        Route::patch('aanpassen/profile/{user}', 'UserController@changeProfileImg')->name('admin.users.edit-img');
        Route::patch('aanpassen/roles/{user}', 'UserController@changeRole')->name('admin.users.edit-role');
        Route::patch('aanpassen/password/{user}', 'UserController@changePassword')->name('admin.users.edit-password');
        Route::get('aanpassen/{user}', 'UserController@showEditUserForm')->name('admin.users.show-edit');
    });

    /**
     * Role management.
     */
    Route::group(['prefix' => 'rollen'], function() {
        // List all roles.
        Route::get('', 'RoleController@index')->name('admin.roles.index');
        // Creation of roles.
        Route::post('nieuw', 'RoleController@createRole')->name('admin.roles.create');
        Route::get('nieuw', 'RoleController@showCreateRoleForm')->name('admin.roles.show-create');
        // Delete
        Route::delete('verwijderen/{role}', 'RoleController@deleteRole')->name('admin.roles.delete-role');
        // Edit stuff.
        Route::patch('aanpassen/{role}', 'RoleController@editRole')->name('admin.roles.edit-role');
        Route::get('aanpassen/{role}', 'RoleController@showEditRoleForm')->name('admin.roles.show-edit');
    });

    /**
     * Assignment and lecturer related
     */
    Route::group(['prefix' => 'opdrachten'], function() {
        // Assignment related routes.
        Route::get('', 'AdminController@rate')->name('admin.assignments.teacher');
        Route::get('/beoordeeld', 'AdminController@rated')->name('admin.assignments.rated');
        Route::get('beoordelen/{id}', 'AdminController@rateUser')->name('admin.assignments.rating');
        Route::post('feedback', 'AdminController@giveFeedback')->name('admin.assignments.feedback');
        Route::post('toevoegen', 'AdminController@addAssignment')->name('admin.assignments.add-assignment');
        Route::post('verwijderen', 'AdminController@deleteAssignment')->name('admin.assignments.delete-assignment');
    });

    /**
     * Notification management related routes.
     */
//    Route::group(['prefix' => 'nieuws'], function() {
//        // List all users.
//        Route::get('', 'NotificationsController@index')->name('admin.notifications.index');
//
//        // Searching through users.
//        Route::get('zoek/{user}', 'NotificationsController@search')->name('admin.notifications.search');
//
//        // Creation of users.
//        Route::post('nieuw', 'NotificationsController@addNotification')->name('admin.notifications.create');
//        Route::get('nieuw', 'NotificationsController@showCreateNotificationForm')->name('admin.notifications.show-create');
//
//        // Delete
//        Route::delete('delete/{user}', 'NotificationsController@deleteNotification')->name('admin.notifications.delete');
//
//        // Edit stuff.
//        Route::patch('aanpassen/{user}', 'NotificationsController@editNotification')->name('admin.notifications.edit');
//        Route::get('aanpassen/{user}', 'NotificationsController@showEditNotificationForm')->name('admin.notifications.show-edit');
//    });
});

