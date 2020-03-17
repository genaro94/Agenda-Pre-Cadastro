<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'AgendaController@index')->name('home');

Route::group(['prefix' => 'agenda'], function(){
    Route::post('store', ['as'=>'agenda.store', 'uses' => 'AgendaController@store']);
    Route::get('search/pacient',  ['as'=>'agenda.search.pacient', 'uses' => 'AgendaController@searchPacient']);
    Route::get('search/professional',  ['as'=>'agenda.search.professional', 'uses' => 'AgendaController@searchProfessional']);
    Route::post('pacient',  ['as'=>'agenda.store.pacient', 'uses' => 'AgendaController@storePacient']);
});
