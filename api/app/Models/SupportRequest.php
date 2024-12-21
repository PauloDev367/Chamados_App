<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportRequest extends Model
{
    protected $table = "support_requests";

    public function messages()
    {
        return $this->hasMany(Message::class, 'support_request_id');
    }
}
