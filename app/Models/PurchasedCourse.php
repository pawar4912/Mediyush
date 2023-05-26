<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedCourse extends Model
{
    use HasFactory;

    protected $table = 'purchased_courses';
    protected $guarded = ['id'];
}
