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

Route::post('/show', 'RecordController@get')->name('showRecord');
Route::get('/show/{id}', 'RecordController@show')->name('showRecord');


Route::post('save', 'RecordController@store');
Route::post('{id}/upvote', 'RecordController@upvote');
Route::post('{id}/downvote', 'RecordController@downvote');


Route::resource('/', 'RecordController');
Route::get('/{id}', 'RecordController@show')->name('showRecord');

Route::get('/{id}/next', function ($uri_tail) {
	$id = (int) $uri_tail+1;
	$record = App\Record::find($id);

	if ($record == null) {
		$record = App\Record::latest()->first();
		return redirect()->route('showRecord', [$record]);
	}else{
		return redirect()->route('showRecord', [$record]);
	}
});

Route::get('/{id}/prev', function ($uri_tail) {
	$id = (int) $uri_tail-1;
	$record = App\Record::find($id);

	if ($record == null) {
		$record = App\Record::latest()->first();
		return redirect()->route('showRecord', [$record]);
	}else{
		return redirect()->route('showRecord', [$record]);
	}
});

// Route::get('/', function () {
//     return view('records.index');
// });
