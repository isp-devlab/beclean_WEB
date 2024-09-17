<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Withdraw extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'withdraws';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'user_id',
        'debit',
        'bank_name',
        'account_number',
        'account_name',
        'is_approve',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
