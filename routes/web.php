<?php
Route::get('/', function() {
    return Redirect::to('/staff');
});
Route::group(['prefix' => 'staff', 'guard'=>'staff'], function () {
	Route::auth();
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );
});
Route::group(['middleware' => ['staff'], 'prefix' => 'staff'], function () {
    
    Route::get('/', 'StaffController@index');
    Route::get('/users', ['as'=> 'staff.users.index', 'uses' => 'Staff\UserController@index']);
	Route::post('/users', ['as'=> 'staff.users.store', 'uses' => 'Staff\UserController@store']);
	Route::get('/users/create', ['as'=> 'staff.users.create', 'uses' => 'Staff\UserController@create']);
	Route::put('/users/{users}', ['as'=> 'staff.users.update', 'uses' => 'Staff\UserController@update']);
	Route::patch('/users/{users}', ['as'=> 'staff.users.update', 'uses' => 'Staff\UserController@update']);
	Route::delete('/users/{users}', ['as'=> 'staff.users.destroy', 'uses' => 'Staff\UserController@destroy']);
	Route::get('/users/{users}', ['as'=> 'staff.users.show', 'uses' => 'Staff\UserController@show']);
	Route::get('/users/{users}/edit', ['as'=> 'staff.users.edit', 'uses' => 'Staff\UserController@edit']);

	Route::get('/report', ['as'=> 'staff.report.index', 'uses' => 'Staff\ReportController@index']);
	Route::any('/report/food', ['as'=> 'staff.report.food', 'uses' => 'Staff\ReportController@food']);
	Route::get('/report/weight', ['as'=> 'staff.report.weight', 'uses' => 'Staff\ReportController@weight']);
	Route::get('/report/water', ['as'=> 'staff.report.water', 'uses' => 'Staff\ReportController@water']);
	Route::any('/report/step', ['as'=> 'staff.report.step', 'uses' => 'Staff\ReportController@step']);
	Route::any('/report/medicine',['as'=> 'staff.report.medicine','uses' => 'Staff\ReportController@medicine']);

	Route::get('/chat', ['as'=> 'staff.msg.index', 'uses' => 'Staff\MsgController@index']);
	Route::get('/msg/users', ['as'=> 'staff.msg.users', 'uses' => 'Staff\MsgController@users']);
	Route::any('/msg/list', ['as'=> 'staff.msg.list', 'uses' => 'Staff\MsgController@list']);
	Route::any('/msg/store', ['as'=> 'staff.msg.list', 'uses' => 'Staff\MsgController@store']);

	Route::get('/automatedMsgs', ['as'=> 'staff.automatedMsgs.index', 'uses' => 'Staff\AutomatedMsgController@index']);
	Route::post('/automatedMsgs', ['as'=> 'staff.automatedMsgs.store', 'uses' => 'Staff\AutomatedMsgController@store']);
	Route::get('/automatedMsgs/create', ['as'=> 'staff.automatedMsgs.create', 'uses' => 'Staff\AutomatedMsgController@create']);
	Route::put('/automatedMsgs/{automatedMsgs}', ['as'=> 'staff.automatedMsgs.update', 'uses' => 'Staff\AutomatedMsgController@update']);
	Route::patch('/automatedMsgs/{automatedMsgs}', ['as'=> 'staff.automatedMsgs.update', 'uses' => 'Staff\AutomatedMsgController@update']);
	Route::delete('/automatedMsgs/{automatedMsgs}', ['as'=> 'staff.automatedMsgs.destroy', 'uses' => 'Staff\AutomatedMsgController@destroy']);
	Route::get('/automatedMsgs/{automatedMsgs}', ['as'=> 'staff.automatedMsgs.show', 'uses' => 'Staff\AutomatedMsgController@show']);
	Route::get('/automatedMsgs/{automatedMsgs}/edit', ['as'=> 'staff.automatedMsgs.edit', 'uses' => 'Staff\AutomatedMsgController@edit']);

	Route::get('/diets', ['as'=> 'staff.diets.index', 'uses' => 'Staff\DietController@index']);
	Route::post('/diets', ['as'=> 'staff.diets.store', 'uses' => 'Staff\DietController@store']);
	Route::get('/diets/create', ['as'=> 'staff.diets.create', 'uses' => 'Staff\DietController@create']);
	Route::put('/diets/{diets}', ['as'=> 'staff.diets.update', 'uses' => 'Staff\DietController@update']);
	Route::patch('/diets/{diets}', ['as'=> 'staff.diets.update', 'uses' => 'Staff\DietController@update']);
	Route::delete('/diets/{diets}', ['as'=> 'staff.diets.destroy', 'uses' => 'Staff\DietController@destroy']);
	Route::get('/diets/{diets}', ['as'=> 'staff.diets.show', 'uses' => 'Staff\DietController@show']);
	Route::get('/diets/{diets}/edit', ['as'=> 'staff.diets.edit', 'uses' => 'Staff\DietController@edit']);

	Route::get('/foods', ['as'=> 'staff.foods.index', 'uses' => 'Staff\FoodController@index']);
	Route::post('/foods', ['as'=> 'staff.foods.store', 'uses' => 'Staff\FoodController@store']);
	Route::get('/foods/create', ['as'=> 'staff.foods.create', 'uses' => 'Staff\FoodController@create']);
	Route::put('/foods/{foods}', ['as'=> 'staff.foods.update', 'uses' => 'Staff\FoodController@update']);
	Route::patch('/foods/{foods}', ['as'=> 'staff.foods.update', 'uses' => 'Staff\FoodController@update']);
	Route::delete('/foods/{foods}', ['as'=> 'staff.foods.destroy', 'uses' => 'Staff\FoodController@destroy']);
	Route::get('/foods/{foods}', ['as'=> 'staff.foods.show', 'uses' => 'Staff\FoodController@show']);
	Route::get('/foods/{foods}/edit', ['as'=> 'staff.foods.edit', 'uses' => 'Staff\FoodController@edit']);

	Route::get('/medicines', ['as'=> 'staff.medicines.index', 'uses' => 'Staff\MedicineController@index']);
	Route::post('/medicines', ['as'=> 'staff.medicines.store', 'uses' => 'Staff\MedicineController@store']);
	Route::get('/medicines/create', ['as'=> 'staff.medicines.create', 'uses' => 'Staff\MedicineController@create']);
	Route::put('/medicines/{medicines}', ['as'=> 'staff.medicines.update', 'uses' => 'Staff\MedicineController@update']);
	Route::patch('/medicines/{medicines}', ['as'=> 'staff.medicines.update', 'uses' => 'Staff\MedicineController@update']);
	Route::delete('/medicines/{medicines}', ['as'=> 'staff.medicines.destroy', 'uses' => 'Staff\MedicineController@destroy']);
	Route::get('/medicines/{medicines}', ['as'=> 'staff.medicines.show', 'uses' => 'Staff\MedicineController@show']);
	Route::get('/medicines/{medicines}/edit', ['as'=> 'staff.medicines.edit', 'uses' => 'Staff\MedicineController@edit']);

	Route::get('/schedules', ['as'=> 'staff.schedules.index', 'uses' => 'Staff\ScheduleController@index']);
	Route::post('/schedules', ['as'=> 'staff.schedules.store', 'uses' => 'Staff\ScheduleController@store']);
	Route::get('/schedules/create', ['as'=> 'staff.schedules.create', 'uses' => 'Staff\ScheduleController@create']);
	Route::put('/schedules/{schedules}', ['as'=> 'staff.schedules.update', 'uses' => 'Staff\ScheduleController@update']);
	Route::patch('/schedules/{schedules}', ['as'=> 'staff.schedules.update', 'uses' => 'Staff\ScheduleController@update']);
	Route::delete('/schedules/{schedules}', ['as'=> 'staff.schedules.destroy', 'uses' => 'Staff\ScheduleController@destroy']);
	Route::get('/schedules/{schedules}/edit', ['as'=> 'staff.schedules.edit', 'uses' => 'Staff\ScheduleController@edit']);

	Route::get('/medRatings', ['as'=> 'staff.medRatings.index', 'uses' => 'Staff\MedRatingController@index']);

	Route::get('staff/staff', ['as'=> 'staff.staff.index', 'uses' => 'Staff\StaffController@index']);
	Route::post('staff/staff', ['as'=> 'staff.staff.store', 'uses' => 'Staff\StaffController@store']);
	Route::get('staff/staff/create', ['as'=> 'staff.staff.create', 'uses' => 'Staff\StaffController@create']);
	Route::put('staff/staff/{staff}', ['as'=> 'staff.staff.update', 'uses' => 'Staff\StaffController@update']);
	Route::patch('staff/staff/{staff}', ['as'=> 'staff.staff.update', 'uses' => 'Staff\StaffController@update']);
	Route::delete('staff/staff/{staff}', ['as'=> 'staff.staff.destroy', 'uses' => 'Staff\StaffController@destroy']);
	Route::get('staff/staff/{staff}', ['as'=> 'staff.staff.show', 'uses' => 'Staff\StaffController@show']);
	Route::get('staff/staff/{staff}/edit', ['as'=> 'staff.staff.edit', 'uses' => 'Staff\StaffController@edit']);
});