<?php

namespace App\Models\Eric;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AirportDispach extends Model
{
    use HasFactory;
    protected $fillable = [
        'dispatchNumber','cntp_id','airport_id','status','created_at','updated_at',
        'grossweight','currentweight','wtype','comment','token','cntppickupdate','mailtype',
        'dispachetype','mailweight','numberitem','mailnumber','mailstypes','orgincountry','cntpweight',
        'omweight','olweight','rmweight','rlweight','regstatus',
        'mstatus','cntpcomment','packagecomment','jurweight','prmweight','gadeight','pcardeight','rpcomment','mailnumberreg'
    ];
}
