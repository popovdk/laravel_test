<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static getID_byFormID_byOrder($formID, int|string $key)
 * @method static create(array $array)
 */
class Question extends Model
{
    protected $fillable = ['text', 'order','form_id'];

    public function scopeGetForm ($query, $id) {
        return $query->where('form_id', $id);
    }

    // Обратная с моделей формы в которой находится вопрос (Form)
    public function form (){
        return $this->belongsTo('App\Form');
    }
}
