<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchOrder extends Model
{
    use HasFactory;
    protected $table = 'branchorder';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'order_id',
        'item_id',
        'bid',
        'quantity',
        'regnumber',
    ];
}
