<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //post -> table name = post
    //custome table name :
    //protected $table ='table_name

    //define column name
    protected $fillable = array ('nama_depan', 'nama_akhir', 'email', 'tahun_lahir','alamat','gender');

    //untuk melakukan table field created_at dan updated_at secara otomatis
    public $timestamps = true;
}