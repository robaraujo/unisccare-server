<?php


Route::post('register', 'Api\UserController@register');
Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
Route::post('authenticate', 'AuthenticateController@authenticate');
Route::get('authenticate', 'AuthenticateController@authenticate');
	
Route::post('user/update', 'Api\UserController@update');
Route::get('authenticateRefresh', 'AuthenticateController@refreshToken');
Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');

Route::get('photos', 'Api\PhotoController@index');
Route::post('photos/store', 'Api\PhotoController@store');

Route::get('weights', 'Api\WeightController@index');
Route::post('weights/store', 'Api\WeightController@store');

Route::get('user-food', 'Api\UserFoodController@index');
Route::post('user-food/store', 'Api\UserFoodController@store');
Route::post('user-meal/store', 'Api\UserFoodController@storeMeal');

Route::get('user-medicine', 'Api\UserMedicineController@index');
Route::post('user-medicine/store', 'Api\UserMedicineController@store');

Route::get('water', 'Api\WaterController@index');
Route::post('water/store', 'Api\WaterController@store');

Route::get('forum', 'Api\ForumController@index');
Route::get('forum/{id}', 'Api\ForumController@find');
Route::post('forum/store', 'Api\ForumController@store');
Route::delete('forum/remove/{id}', 'Api\ForumController@destroy');

Route::get('feed', 'Api\PostController@index');
Route::get('feed/{user_id}', 'Api\PostController@listByUser');
Route::post('post/store/{forum_id}', 'Api\PostController@store');

Route::get('follow', 'Api\UserFollowController@index');
Route::get('follow/{user_id}', 'Api\UserFollowController@store');
Route::delete('unfollow/{user_id}', 'Api\UserFollowController@destroy');

Route::get('schedules/month/{month}', 'Api\ScheduleController@month');
Route::post('schedules/store', 'Api\ScheduleController@store');
Route::post('schedules/update/{id}', 'Api\ScheduleController@update');
Route::delete('schedules/remove/{id}', 'Api\ScheduleController@destroy');

Route::get('staffs', 'Api\Staff2Controller@listStaffs');
Route::get('staffs/ratings', 'Api\Staff2Controller@ratings');
Route::post('staffs/rate', 'Api\Staff2Controller@rate');

Route::post('step/store', 'Api\StepController@store');

Route::get('report/food', 'Api\ReportController@food');
Route::get('report/water', 'Api\ReportController@water');
Route::get('report/weight', 'Api\ReportController@weight');
Route::get('report/step', 'Api\ReportController@step');
Route::get('report/medicine', 'Api\ReportController@medicine');

Route::get('messages', 'Api\MsgController@index');
Route::post('messages/store', 'Api\MsgController@store');