<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $fillable = ['division_name', 'active'];
    protected $table = "division";
    public $timestamps = true;

    public function roles()
    {
        return $this->belongsTo('App\Models\Role','id_role', 'id_role');
    }
    public function divisions()
    {
        return $this->belongsTo('App\Models\Division','id_division', 'id_division');
    }
}
