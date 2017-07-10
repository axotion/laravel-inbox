<?php
/**
 * Created by PhpStorm.
 * User: me
 * Date: 08.07.2017
 * Time: 23:26
 */

namespace Evilnet\Inbox\Repository;

use Evilnet\Inbox\Conversation;
use Evilnet\Inbox\User;
use Carbon\Carbon;

class InboxRepository
{
	public function fetchAll()
    {
        return Conversation::where('id_from', auth()->id())->orderBy('id', 'desc')->orWhere('id_to', auth()->id())->orderBy('id', 'desc')->get()->groupBy(function ($data){
            return Carbon::parse($data->created_at)->format('Y-m-d');
        });
    }

    public function userExists($user)
    {
        if (count(User::where('name', $user)->first())) {
            return true;
        } else {
            return false;
        }
    }

    public function conversationExists($to, $from)
    {
        //prevent to pm yourself
        if(auth()->user()->name == $to->name){
            return true;
        }
        //check if conversation already exists
        if (count(Conversation::where('id_to', $to->id)->first()) == 1 AND count(Conversation::where('id_from', $from)->first()) == 1 OR count(Conversation::where('id_to', $from)->first()) == 1 AND count(Conversation::where('id_from', $to->id)->first()) == 1) {
            return true;
        }
        return false;
    }

}