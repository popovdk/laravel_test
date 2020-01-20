<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
/**
 * @method static where(string $string, $formID)
 * @method static getFormCreatorID($formID)
 * @method static getMyForm()
 * @method static create(array $array)
 * @method static findOrFail($formID)
 * @method static find($formID)
 */
class Form extends Model
{
    protected $fillable = ['title', 'user_id'];

    public function scopeGetMyForm ($query) {
        return $query->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
    }

    // Получить ИД создателя формы
    public function scopeGetFormCreatorID ($query, $formID) {
        return $query->findOrFail($formID)->get()->first()->user_id;
    }

    // Обратная связь с моделей пользователяй (User)
    public function user (){
        return $this->belongsTo('App\User');
    }

    // Связь с формы с ее вопросами (Question)
    public function questions (){
        return $this->hasMany('App\Question');
    }

    // Связь с реакциями на формы пользователя (FormAnswer)
    public function formAnswers (){
        return $this->hasMany('App\FormAnswer');
    }

}
