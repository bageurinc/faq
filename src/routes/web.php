<?php
Route::name('bageur.')->group(function () {
	Route::group(['prefix' => 'bageur/v1'], function () {
		Route::apiResource('faq', 'bageur\faq\FAQController');
		Route::post('urutan-faq', 'bageur\faq\FAQController@urutan');
	});
});
