<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $table = 'addresses';

    protected $fillable = [
        'account_id',
        'fullname',
        'phone',
        'province',
        'district',
        'ward',
        'full_address',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
