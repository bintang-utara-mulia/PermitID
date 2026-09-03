<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number',
        'student_id',
        'letter_type',
        'event_name',
        'event_organizer',
        'start_date',
        'end_date',
        'reason',
        'attachment_path',
        'status',
        'rejected_by',
        'rejection_reason',
        'qr_token',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function rejector()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }
}
