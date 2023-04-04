<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;
    protected $table = "ideas";
    protected $primaryKey = "ideaID";
    protected $fillable = [
        'ideaName',
        'categoryID',
        'ideaContent',
        'uploader',
        'view',
        'document',
        'likeCount',
    ];
}
