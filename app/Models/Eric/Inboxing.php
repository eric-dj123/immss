<?php

namespace App\Models\Eric;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inboxing extends Model
{
    use HasFactory;
    protected $fillable = [
        'innumber', 'inname', 'userid', 'intracking', 'phone', 'pob',
        'location', 'comment', 'orgcountry','from', 'to', 'amount',
        'paystatus', 'instatus', 'notification','mailtranserf', 'checks', 'av',
        'addre', 'mdate', 'userinv','weight', 'unit', 'afternotification',
        'akabati', 'email', 'bid','mailtype','akabati','pob_bid','customer_id','transdate','rcndate',
        'notdate','delivdate'

    ];
    public function branches()
    {
        return $this->belongsTo(Branch::class,'pob_bid');
    }
}
