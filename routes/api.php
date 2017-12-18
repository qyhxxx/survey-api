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

Route::get('/', function () {
    //
});

Route::get('login/{from?}', 'LoginController@login');
Route::get('loginStatus', 'LoginController@loginStatus');
Route::get('qnid/{qnid}/{src?}', 'QuestionnaireController@getResponseOfQuestionnaire')->middleware('GetDataMiddleware');
Route::get('qinfo/{qnid}', 'QuestionnaireController@qinfo');
Route::post('submit/qnid/{qnid}', 'QuestionnaireController@submit')->middleware('submitAnswer');
Route::get('ifAnswered/{qnid}', 'QuestionnaireController@ifAnswered');

Route::group(['middleware' => ['Authentication']], function () {
    Route::group(['prefix' => 'status/{status}'], function () {
        Route::post('edit', 'QuestionnaireController@add');
        Route::post('update/qnid/{qnid}', 'QuestionnaireController@update')->middleware('Update');
    });
    Route::get('getVerifiedPhoneQuery', 'VerifiedPhoneController@getVerifiedPhoneQuery');
    Route::post('getVerifiedPhoneSign', 'VerifiedPhoneController@getVerifiedPhoneSign');
    Route::group(['prefix' => 'statistics'], function () {
        Route::get('qnid/{qnid}/init', 'StatisticsController@init');
        Route::get('qid/{qid}/getOptions', 'StatisticsController@getOptions');
        Route::post('qid/{qid}/data', 'StatisticsController@statisticsOfOneQuestion');
    });

    //我的问卷
    Route::group(['prefix' => 'minequestion'], function () {
        //问卷缩略图页面
        //     Route::post('/mine', 'MineQuestionController@reach');
        Route::post('/mine', 'MineQuestionController@mine');
        Route::get('/mine', 'MineQuestionController@questionnaire');

        //问卷展开[概述、设置]
        Route::get('/overview/{id}', 'MineQuestionController@overview');
  //      Route::post('/overview/{id}', 'MineQuestionController@overview');
        Route::any('/install/{id}', 'MineQuestionController@install');
    //    Route::get('/install/{id}', 'MineQuestionController@installInfo');
        Route::post('/killed/{id}', 'MineQuestionController@killed');
        Route::get('/killed/{id}', 'MineQuestionController@killed');
//        Route::get('/overview/{id}', function () {
//            return view('minequestion.overview');
//        });

//        //问卷展开[数据]
//        Route::get('/answerdata/{id}','MineQuestionController@answerdata');
    });

    Route::get('logout', 'LogoutController@logout');
});
