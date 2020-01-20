<?php
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Авторизация
Auth::routes();


// Формы
Route::name('form.')->group(function () {
    Route::group([
        'namespace' => 'Form',
        'prefix' => 'form'
    ], function () {

        Route::middleware(['auth'])->group(function () {

            // Спискок созданых пользователем форм
            Route::get('/', 'FormController@list')->name('my');


            // Создание новой формы
            Route::get('/create', 'FormController@create')->name('create');

            // Обработчик создания новой формы
            Route::post('/create', 'FormController@save')->name('saveCreate');

            // Сохранение в PDF реакции на форму
            Route::get('/answers/{id}/savePDF', 'FormController@saveAnswersPdf')->name('savePDF');

            // Реакции на форму
            Route::get('/answers/{id}', 'FormController@formAnswers')->name('answers');



            // Ответы в реакции на форму
            Route::get('/answer/{id}', 'FormController@formAnswer')->name('answer');

            // Обработчик удаления формы
            Route::get('/delete/{id}', 'FormController@formDelete')->name('delete');

        });

        // Обработчик сохранения ответа
        Route::post('/answer/save/{id}', 'FormController@saveAnswer')->name('saveAnswers');

        // Заглушка
        Route::view('/thanks', 'form.thanks')->name('thanks');

        // Заглушка не найдена анкета
        Route::view('/error', 'form.error')->name('error');

        // Формы для ввода ответов
        Route::get('/{id}', 'FormController@show')->name('show');

    });
});
