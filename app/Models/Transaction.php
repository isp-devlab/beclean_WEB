<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'schedules';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'user_id',
        'product_category_id',
        'longitude',
        'latitude',
        'product_status',
        'transaction_status'
    ];
}
