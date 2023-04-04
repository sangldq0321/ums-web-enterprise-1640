<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;
    protected $table = "acayear";
    protected $primaryKey = "acaYearID";
    protected $fillable = [
        'semester',
        'openDate',
        'closeDate',
    ];
    public $timestamps = false;
}
