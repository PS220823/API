<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soort extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "soorten";
    protected $fillable = ["soort"];
}
