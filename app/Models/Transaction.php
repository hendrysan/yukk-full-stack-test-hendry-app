<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "transactions";

    protected $casts = [
        'id' => 'string'
    ];

    protected $fillable = [
        'code', 'type', 'amount', 'note', 'image', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
