<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table="posts";
    protected $primaryKey="id";
    protected $fillable=['user_id','content','image'];
}
