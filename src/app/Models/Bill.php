<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model{
	protected $table = 'bills';
    protected $fillable = [
        'order_id',
        'method',
        'bank_code',
        'transaction_no',
        'amount',
        'paid_at',
    ];

    protected $dates = [
        'paid_at',
        'created_at',
        'updated_at',
    ];

    public function orders(){
        return $this->belongsTo(Order::class, 'order_id');
    }
}
