<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ add this line
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory; // ✅ keep this here

    protected $table = 'students';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'address',
        'mobile',
    ];
}
