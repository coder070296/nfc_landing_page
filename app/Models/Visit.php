<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    public $timestamps = false; // because we only have created_at

    protected $fillable = ['card_id','ip','user_agent','referrer','created_at'];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
