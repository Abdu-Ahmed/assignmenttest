<?php 

use App\Core\Route;

Route::get('/assignmenttest/public/', 'Home@index');
Route::get('/assignmenttest/public/home', 'Home@index');
Route::post('/assignmenttest/public/delete', 'Home@delete');
Route::get('/assignmenttest/public/add-product', 'Add@index');
Route::post('/assignmenttest/public/save', 'Add@save');