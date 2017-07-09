<?php

namespace Evilnet\Inbox;
use Evilnet\Inbox\Controller;
use Evilnet\Inbox\Services\InboxService;
use Illuminate\Http\Request;

class InboxController extends Controller
{

    protected $inboxService;

    public function __construct(InboxService $inboxService)
    {
        $this->inboxService = $inboxService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conversations = $this->inboxService->fetchAllConversation();

      $users = $this->inboxService->getInboxUsers($conversations);


     return view('inbox::inbox.index', compact('conversations', 'users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inbox::inbox.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'user' => 'required',
                'message' => 'required|max:10000',
                'subject' => 'required'
            ]
            );
        $this->inboxService->addConversation($request->get('user'), $request->get('message'), $request->get('subject'));
    }

    /**
     * Display the specified resource.
     *
     * @param conversation|int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Conversation $id)
    {
        if(auth()->id() == $id->id_to OR auth()->id() == $id->id_from) {
            return view('inbox::inbox.show')->with('conversation', $id);
        }
        return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param conversation|int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function addMessage(Request $request, Conversation $id)
    {
        $this->validate($request,
            [
                'message' => 'required|max:10000'
            ]
        );
        if(auth()->id() == $id->id_to OR auth()->id() == $id->id_from) {

            $this->inboxService->addMessage($request, $id);
        }
        return redirect()->back();

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversation $id)
    {
        if(auth()->id() == $id->id_to OR auth()->id() == $id->id_from) {

            $this->inboxService->deleteConversation($id);
        }
        return redirect()->back();

    }
}
