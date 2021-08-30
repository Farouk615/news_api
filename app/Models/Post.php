<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'content',
        'date_written',
        'featured_image',
        'vote_up',
        'vote_down',
    ];
    public function author(){ // foreign key of author (author_id)
        return $this->belongsTo(User::class,'user_id','id');
    }
    public  function  comments(){
        return $this->hasMany(Comments::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
