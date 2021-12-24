<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;
    protected $fillable = [ 'id','name','description', 'category', 'description', 'url', 'language', 'country' ];
    protected $casts = ['id' => 'string'];

    public function articles()
    {
        return $this->hasMany(Article::class);

    }
}
