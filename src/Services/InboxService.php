<?php
/**
 * Created by PhpStorm.
 * User: me
 * Date: 08.07.2017
 * Time: 23:25
 */
namespace Evilnet\Inbox\Services;

use Evilnet\Inbox\Conversation;
use Evilnet\Inbox\Messages;
use Evilnet\Inbox\Repository\InboxRepository;
use Evilnet\Inbox\User;

class InboxService{

    protected $inboxRepository;
    function __construct(InboxRepository $inboxRepository)
    {
        $this->inboxRepository = $inboxRepository;
    }

    public function addMessage($request, $id){
        if($request->get('conv_id') != $id->id){
            redirect()->back()->withErrors('Something went wrong...')->send();
        }

        $a = new Messages();
        $a->name = auth()->user()->name;
        $a->message = $request->get('message');
        $a->conversation_id = $request->get('conv_id');
        $a->save();
         return redirect()->back()->send();
    }

    public function addConversation($user,$messg,$subject){

        if($this->inboxRepository->userExists($user)){
            $from = auth()->id();
            $to = User::where('name', $user)->first();
            if(!$this->inboxRepository->conversationExists($to,$from)){
                $message = new Messages();
                $message->name = auth()->user()->name;
                $message->message = $messg;
                $conversation = new Conversation();
                $conversation->subject = $subject;
                $conversation->id_from = $from;
                $conversation->id_to = $to->id;
                $conversation->save();
                $message->conversation_id = $conversation->id;
                $message->save();
                return redirect()->to(url('/').'/conversation/'.$conversation->id)->send();
            }
        else{
                return redirect()->back()->withErrors('Conversation already exists')->send();
        }
        }
        else{
         return redirect()->back()->withErrors('User not found')->send();
        }
    }
    public  function fetchAllConversation(){
        return $this->inboxRepository->fetchAll();
    }

    public  function deleteConversation($conversation){
        //it will delete conversation row and all related rows in messages table
        foreach ($conversation->messages as $messages){
            $messages->forceDelete();
        }
        $conversation->forceDelete();
        return redirect()->back()->send();


    }
    //return array with users that match to display for logged user
        public function getInboxUsers($conversations){
            $users = [];
            foreach ($conversations as $date => $thread){
                foreach ($thread as $conversation){
                    if( auth()->id() == $conversation->id_to) {
                        $users[] = \App\User::where('id', $conversation->id_from)->first();
                    }
                    elseif(auth()->id() == $conversation->id_from)
                        $users[] = \App\User::where('id', $conversation->id_to)->first();
                }
            }
            return $users;
        }

}