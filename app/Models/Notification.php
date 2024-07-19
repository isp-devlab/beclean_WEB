<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'notifications';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'user_id',
        'content',
    ];
}
