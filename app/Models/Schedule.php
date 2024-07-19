<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'schedules';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'user_id',
        'transaction_id',
        'date'
    ];
}
