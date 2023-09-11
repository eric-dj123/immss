<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailStock extends Model
{
    use HasFactory;
    protected $fillable = [
        'mailtype',
        'mailin',
        'mid',
        'mailout',
        'datereceive',
        'bid',
        'status',


    ];
}
