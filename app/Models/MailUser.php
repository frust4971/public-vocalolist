<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailUser extends Model
{
    //
    protected $primaryKey = 'ip_address';
    public $timestamps = false;
}
