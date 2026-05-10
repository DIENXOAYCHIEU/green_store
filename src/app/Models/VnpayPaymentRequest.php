<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VnpayPaymentRequest extends Model
{
    protected $fillable = [
        'order_id',
        'vnp_txn_ref',
        'vnp_amount',
        'vnp_bank_code',
        'vnp_transaction_no',
        'vnp_response_code',
        'vnp_data',
        'processed',
    ];

    protected $casts = [
        'vnp_data' => 'array',
        'processed' => 'boolean',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
