<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;
    protected $fillable = [
        'pob',
        'branch_id',
        'size',
        'status',
        'name',
        'email',
        'phone',
        'available',
        'date',
        'pob_category',
        'serviceType',
        'pob_type',
        'amount',
        'year',
        'attachment',
        'customer_id',
        'available',
        'aprooved',
        'booked',
        'cotion',
        'hasAddress',
        'EMSNationalContract',
        'profile',
        'homeAddress',
        'homePhone',
        'homeEmail',
        'homeVisible',
        'homeLocation',
        'officeAddress',
        'officePhone',
        'officeLocation',
        'officeEmail',
        'officeVisible',

    ];
    #function to get the branch of the box
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
