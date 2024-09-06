<?php

namespace App\Models;

use App\Models\Item;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Support\Carbon;
use App\Models\productCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'transactions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'transaction_code',
        'user_id',
        'product_category_id',
        'address',
        'longitude',
        'latitude',
        'product_status',
        'transaction_status'
    ];

    // Event saat model sedang dibuat
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            $now = Carbon::now();
            $categoryId = $transaction->product_category_id;
            $transaction->transaction_code = 'TRANS-' .$categoryId.$now->format('YmdHis');
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(productCategory::class, 'product_category_id');
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }

    public function item(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
