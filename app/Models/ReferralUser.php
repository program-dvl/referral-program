<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralUser extends Model
{
    use HasFactory;

    protected $table = 'referral_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'referred_by',
        'referral_email',
        'status'
    ];

}
