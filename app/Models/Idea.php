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
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryID', 'categoryID');
    }
}
