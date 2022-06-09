<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $table = "division";
    protected $primaryKey = "id_division";
    protected $fillable = ['division_name', 'active'];
    public $timestamps = false;
}
