<?php
/**
 * Created by PhpStorm.
 * User: me
 * Date: 09.07.2017
 * Time: 19:37
 */
Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('conversation', 'Evilnet\Inbox\InboxController@create');
    Route::post('conversation', 'Evilnet\Inbox\InboxController@store');
    Route::get('conversation/{id}', 'Evilnet\Inbox\InboxController@show');
    Route::post('message/{id}', 'Evilnet\Inbox\InboxController@addMessage');
    Route::get('inbox', 'Evilnet\Inbox\InboxController@index')->name('inbox');
    Route::delete('/conversation/{id}', '\Evilnet\Inbox\InboxController@destroy');
});