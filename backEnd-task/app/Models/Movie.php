<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'image',
        'rate',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getImagePathAttribute()
    {
        return $this->image ? url($this->image) : url('assets/admin/app-assets/images/no-image.png');
    }
}
