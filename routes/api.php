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
Route::post('/update-profile',['uses'=>'Organization\users\UsersController@updateAppProfile']);

//Api for ajax requests
Route::match(['get','post'],'ajax/handle' , ['uses'=>'Api\AjaxController@handle']);


//api for complaint box Android App
Route::post('/send_complaint' , [ 'uses' =>'Api\FeedbackController@complaintAppResponce'] );
Route::get('/dataset/{active_code}/{token}' , [ 'uses' =>'Organization\dataset\DatasetController@api_response'] );

Route::group(['prefix'=>'v2'], function(){
    Route::post('/survey_api',['uses'=>'Api\SurveyController@listAllSurveys']); 

    Route::post('/update/password',['uses'=>'Api\UserController@updatePassword']);
    Route::post('/update/profile',['uses'=>'Api\UserController@updateProfile']);

});
