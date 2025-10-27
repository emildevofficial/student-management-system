<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = [
        'student_id',
        'amount',
        'paid_at',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    protected $casts = [
    'paid_at' => 'datetime',
];

}
