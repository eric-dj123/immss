<?php

namespace App\Models\Eric;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transferdetailsout extends Model
{
    use HasFactory;
    protected $fillable = [
        'trid',  'out_id',
    ];
}
