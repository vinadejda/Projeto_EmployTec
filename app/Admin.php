<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    
    protected $table = 'users';
    
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email', 
        'password',
        'ds_rua',
        'nr_endereco',
        'ds_bairro',
        'ds_complemento',
        'nr_tel',
        'nl_user',
        'nr_cel',
        'im_perfil',
        'link_linkedin',
        'link_facebook',
        'link_twitter',
        'link_site',   
    ];

    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
