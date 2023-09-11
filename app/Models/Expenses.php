<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    protected $table = 'expenses';
    protected $primaryKey = 'e_id';
    protected $fillable = [
        'e_type',
        'e_name',
        'e_description',
        'e_amount',
        'branch_id',
        'e_file',
        'e_status'
    ];
}
