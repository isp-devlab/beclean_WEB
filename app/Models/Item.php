<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'items';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'transaction_id',
        'product_name',
        'price',
        'weight',
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}


