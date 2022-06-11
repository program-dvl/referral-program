<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
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

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'referred_by',
        'referral_email',
        'status',
        'created_at',
        'updated_at',
        'user',
        'created',
        'status_name'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['created', 'status_name'];

    /**
     * Get the user which belongs to referral
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'referred_by', 'id');
    }

    /**
     * Get the created at converted to human date format
     *
     * @return string
     */
    public function getCreatedAttribute()
    {
        return $this->dat = (new Carbon($this->created_at))->format('d M, Y');
    }

    /**
     * Get the created at converted to human date format
     *
     * @return string
     */
    public function getStatusNameAttribute()
    {
        return $this->status_name = ($this->status == config('constants.referral_status.INVITATION_SENT')) ? 
            config('constants.referral_status_text.INVITATION_SENT') : 
                config('constants.referral_status_text.INVITATION_ACCEPTED');
    }
}
