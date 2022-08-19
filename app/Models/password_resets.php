<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class password_resets extends Model
{
    use HasFactory;
   
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'password_resets';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

/**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'email';
    
    protected $fillable = [
        'email',
        'token',
    ];
}
