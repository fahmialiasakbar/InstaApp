<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table="comments";
    protected $primaryKey="id";
    protected $fillable=['user_id','post_id','comment'];
}
