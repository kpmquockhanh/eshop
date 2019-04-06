<?php
use Illuminate\Support\Facades\Route;
Route::namespace('Khanhlq\Crawler')->group(function (){
    Route::get('/test-cr', 'CrawlerController@test');
});




