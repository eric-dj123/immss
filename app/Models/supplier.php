<?php

namespace App\Models;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    protected $fillable = ['suppliername', 'tinnumber','phone'];
    public function purchase()
    {
        return $this->hasMany(Purchase::class,'supplier_id','id');
    }
}
