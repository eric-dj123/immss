<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zone extends Model
{
    use HasFactory;
    protected $table = "zone";
    protected $primaryKey = "zone_id";
    protected $fillable = [
        'zonename'
    ];
}
