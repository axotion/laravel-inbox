<?php

namespace Evilnet\Inbox;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function messages(){
        return $this->hasMany('Evilnet\Inbox\Messages');
    }
}
