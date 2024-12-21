<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = "messages";


    public function supportRequest()
    {
        return $this->belongsTo(SupportRequest::class, 'support_request_id');
    }
}
