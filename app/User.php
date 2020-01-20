<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    // Связь с моделей форм (Form)
    public function forms() {
        return $this->hasMany('\App\Form');
    }

    // Связь с моделей реацией на формы (FormAnswers)
    public function formAnswers() {
        return $this->hasMany('\App\FormAnswers');
    }


}
