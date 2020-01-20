<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, $formID)
 * @method static selectReactions($formID)
 */
class FormAnswer extends Model
{
    protected $fillable = ['form_id'];

    // Выбор реаций на форму по ID
    public function scopeSelectReactions($query, int $formID) {
        return $query->where('form_id', $formID);
    }

    // Связь с моделей ответов в реации на форму (Answer)
    public function answers() {
        return $this->hasMany('\App\Answer');
    }

    // Связь с моделей вопросы (Question)
    public function questions() {
        return $this->hasManyThrough('\App\Question', 'App\Form', 'id', 'form_id', 'form_id');
    }

    // Обратная связь с моделей пользователяй (User)
    public function user (){
        return $this->belongsTo('App\User');
    }

    // Обратная связь с моделей пользователяй (Form)
    public function form (){
        return $this->belongsTo('App\Form');
    }


}
