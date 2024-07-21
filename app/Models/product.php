<?php

namespace App\Models;

use App\Models\productCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'product_category_id',
        'name',
        'price'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(productCategory::class, 'product_category_id');
    }
}
