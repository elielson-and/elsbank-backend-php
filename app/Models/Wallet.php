<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $fillable = ['uuid','balance','user_id'];
    protected $hidden = ['id','user_id'];
    // -- Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
