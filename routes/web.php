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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
* This is the main app route [Chatify Messenger]
*/
Route::get('/Messenger', 'Messenger\MessagesController@index')->name('messenger.index')->middleware('auth');

/**
 *  Fetch info for specific id [user/group]
 */
Route::post('/idInfo', 'Messenger\MessagesController@idFetchData')->middleware('auth');

/**
 * Send message route
 */
Route::post('/sendMessage', 'Messenger\MessagesController@send')->name('send.message')->middleware('auth');

/**
 * Fetch messages
 */
Route::post('/fetchMessages', 'Messenger\MessagesController@fetch')->name('fetch.messages')->middleware('auth');

/**
 * Download attachments route to create a downloadable links
 */
Route::get('/download/{fileName}', 'Messenger\MessagesController@download')->name(config('chatify.attachments.route'))->middleware('auth');

/**
 * Authintication for pusher private channels
 */
Route::post('/chat/auth', 'Messenger\MessagesController@pusherAuth')->name('pusher.auth')->middleware('auth');

/**
 * Make messages as seen
 */
Route::post('/makeSeen', 'Messenger\MessagesController@seen')->name('messages.seen')->middleware('auth');

/**
 * Get contacts
 */
Route::post('/getContacts', 'Messenger\MessagesController@getContacts')->name('contacts.get')->middleware('auth');

/**
 * Get users
 */
Route::post('/Messenger/getUsers', 'Messenger\MessagesController@getUsers')->name('users.get')->middleware('auth');

/**
 * Update contact item data
 */
Route::post('/updateContacts', 'Messenger\MessagesController@updateContactItem')->name('contacts.update')->middleware('auth');


/**
 * Star in favorite list
 */
Route::post('/star', 'Messenger\MessagesController@favorite')->name('star')->middleware('auth');

/**
 * get favorites list
 */
Route::post('/favorites', 'Messenger\MessagesController@getFavorites')->name('favorites')->middleware('auth');

/**
 * Search in messenger
 */
Route::post('/search', 'Messenger\MessagesController@search')->name('search')->middleware('auth');

/**
 * Get shared photos
 */
Route::post('/shared', 'Messenger\MessagesController@sharedPhotos')->name('shared')->middleware('auth');

/**
 * Delete Conversation
 */
Route::post('/deleteConversation', 'Messenger\MessagesController@deleteConversation')->name('conversation.delete')->middleware('auth');

/**
 * Delete Conversation
 */
Route::post('/updateSettings', 'Messenger\MessagesController@updateSettings')->name('avatar.update')->middleware('auth');

/**
 * Set active status
 */
Route::post('/setActiveStatus', 'Messenger\MessagesController@setActiveStatus')->name('activeStatus.set')->middleware('auth');






/*
* [Group] view by id
*/
Route::get('/group/{id}', 'Messenger\MessagesController@index')->name('group')->middleware('auth');

/*
* user view by id.
* Note : If you added routes after the [User] which is the below one,
* it will considered as user id.
*
* e.g. - The commented routes below :
*/
// Route::get('/route', function(){ return 'Munaf'; }); // works as a route
Route::get('/{id}', 'Messenger\MessagesController@index')->name('user')->middleware('auth');
// Route::get('/route', function(){ return 'Munaf'; }); // works as a user id
