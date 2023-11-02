<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //post -> table name = post
    //custome table name :
    //protected $table ='table_name

    //define column name
    protected $fillable = array ('title', 'content', 'status', 'user_id');

    //untuk melakukan table field created_at dan updated_at secara otomatis
    public $timestamps = true;
}