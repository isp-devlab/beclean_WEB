<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productCategory extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'product_categories';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
    ];
}
