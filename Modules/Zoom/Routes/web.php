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
Route::group(['middleware' => ['auth']], function () {
    // Admin routes
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

        Route::group(['middleware' => ['role:admin']], function () {
            Route::get('zoom-meeting/table', 'AdminZoomMeetingController@tableView')->name('zoom-meeting.table-view');
            Route::get('zoom-meeting/start-meeting/{id}', 'AdminZoomMeetingController@startMeeting')->name('zoom-meeting.startMeeting');
            Route::post('zoom-meeting/cancel-meeting', 'AdminZoomMeetingController@cancelMeeting')->name('zoom-meeting.cancelMeeting');
            Route::post('zoom-meeting/end-meeting', 'AdminZoomMeetingController@endMeeting')->name('zoom-meeting.endMeeting');
            Route::get('zoom-meeting/leave-meeting/{id}', 'AdminZoomMeetingController@leaveMeeting')->name('zoom-meeting.leaveMeeting');
            Route::post('zoom-meeting/updateOccurrence/{id}', 'AdminZoomMeetingController@updateOccurrence')->name('zoom-meeting.updateOccurrence');
            Route::resource('zoom-meeting', 'AdminZoomMeetingController');
            Route::resource('category', 'CategoryController');
            Route::resource('room', 'RoomController');
            Route::get('zoom-meeting/invite/{meeting}', 'AdminZoomMeetingController@OnlineInvite')->name('zoom-meeting.invite');
            Route::get('off-meeting/invite/{meeting}', 'MeetingController@OfflineInvite')->name('off-meeting.invite');
            Route::resource('zoom-setting', 'ZoomMeetingSettingController');
            // ...
        });
        
        Route::group(['middleware' => ['role:admin|employee']], function () {
            Route::get('offmeeting/calendar', 'MeetingController@calendar')->name('offmeeting.calendar');
            Route::get('offmeeting/roomajax', 'MeetingController@roomajax')->name('roomajax.create');
            Route::resource('offmeeting', 'MeetingController');
            Route::post('offmeeting/cancel-meeting', 'MeetingController@cancelMeeting')->name('offmeeting.cancelMeeting');
        });
        
        Route::group(['middleware' => ['role:admin|employee|client']], function () {
            Route::get('zomm-meeting-files/download/{id}', ['uses' => 'AdminZoomMeetingController@download'])->name('zoom-meeting-files.download');
            Route::post('zoom-meeting/storeFile', 'AdminZoomMeetingController@storeFile')->name('zoom-meeting.storeFile');
        });

    });
    
    // Employee routes
    Route::group(['prefix' => 'member', 'as' => 'member.', 'middleware' => ['role:employee']], function () {
        Route::get('zoom-meeting/table', 'EmployeeZoomMeetingController@tableView')->name('zoom-meeting.table-view');
        Route::get('zoom-meeting/start-meeting/{id}', 'EmployeeZoomMeetingController@startMeeting')->name('zoom-meeting.startMeeting');
        Route::post('zoom-meeting/cancel-meeting', 'EmployeeZoomMeetingController@cancelMeeting')->name('zoom-meeting.cancelMeeting');
        Route::post('zoom-meeting/end-meeting', 'EmployeeZoomMeetingController@endMeeting')->name('zoom-meeting.endMeeting');
        Route::post('zoom-meeting/updateOccurrence/{id}', 'EmployeeZoomMeetingController@updateOccurrence')->name('zoom-meeting.updateOccurrence');
        Route::get('zoom-meeting/invite/{meeting}', 'EmployeeZoomMeetingController@OnlineInvite')->name('zoom-meeting.invite');
        Route::resource('zoom-meeting', 'EmployeeZoomMeetingController');
        Route::resource('zoom-setting', 'MemberZoomMeetingSettingController');
    });

    // Client routes
    Route::group(['prefix' => 'client', 'as' => 'client.', 'middleware' => ['role:client']], function () {
        Route::get('zoom-meeting/start-meeting/{id}', 'ClientZoomMeetingController@startMeeting')->name('zoom-meeting.startMeeting');
        Route::resource('zoom-meeting', 'ClientZoomMeetingController');
    });
});

Route::post('zoom-webhook', 'ZoomWebhookController@index')->name('zoom-webhook');
