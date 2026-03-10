<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $table = 'Contact_Message';

    protected $primaryKey = 'MessageID';

    public $timestamps = true;

    protected $fillable = [
        'Name',
        'Email',
        'Message',
        'UserID',
        'CreatedAt',
    ];
}
