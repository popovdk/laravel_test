<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Answer extends Model
{
    protected $fillable = ['text', 'question_id', 'form_answer_id'];

    // Обратная с моделей реацией на формы (FormAnswers)
    public function formAnswers (){
        return $this->belongsTo('App\FormAnswers');
    }
}
