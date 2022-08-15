<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Parental\HasChildren;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasChildren;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fist_name',
        'last_name',
        'dob',
        'type',
        'email',
        'password',
        'mobile',
        'adresse',
        'cin',
        'annee_afectation',
        'diplome',
        'grade',
        'salaire',
        'specialite',
        'street',
        'city',
        'gouverneant',
        'zipcode',
    
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $childTypes = [
        'eleve' => Eleve::class,
        'professeur' => Professeur::class,
        'userparent' => UserParent::class,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
