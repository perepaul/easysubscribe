<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_id',
        'slug',
        'title',
        'body',
    ];


    public function getRouteKey()
    {
        return 'slug';
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
