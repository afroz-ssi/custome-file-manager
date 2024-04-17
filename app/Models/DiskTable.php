<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiskTable extends Model
{
    use HasFactory;
    protected $table = 'disk_tables';
    protected $fillable = ['user_id','disk','path','name'];
}
