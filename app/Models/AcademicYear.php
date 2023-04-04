<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class academicyear extends Model
{
    use HasFactory;
    protected $table = "academicyear";
    protected $primaryKey = "academicYearID";
    protected $fillable = [
        'open_date',
        'close_date',
    ];
    public $timestamps = false;
}
