<?php


use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/survey_api',['uses'=>'Api\SurveyController@surveys']);
Route::post('/survey_filled_data',['uses'=>'Api\SurveyController@save_app_survey_filled_data']);
Route::post('organization/users' , ['uses'=>"Api\SurveyController@organization_users"]);

//api for complaint box Android App
Route::post('/send_complaint' , [ 'uses' =>'Api\FeedbackController@complaintAppResponce'] );
Route::get('/dataset/{active_code}/{token}' , [ 'uses' =>'Organization\dataset\DatasetController@api_response'] );

