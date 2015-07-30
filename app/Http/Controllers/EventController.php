<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\SendEventRequest;
use App\Repositories\EventRepository;
use App\Repositories\UserRepository;
use App\User;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    protected $eventRepository;

    /**
     * init the repositories and the middleware.
     *
     * @param EventRepository $eventRepository
     * @param UserRepository $userRepository
     */
    function __construct(EventRepository $eventRepository, UserRepository $userRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $events = $this->eventRepository->getEventsForUser(Auth::id());

        $update = $this->eventRepository->updateEventsRead(Auth::id());

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $delete = $this->eventRepository->deleteEvent($id);

        if($delete)
        {
            return back()->withMessage('The event has been deleted.');
        } else {
            return back()->withMessage('There was an error deleting that event.');
        }
    }

    /**
     * Display form for sending the event
     *
     * @param $events
     *
     * @return \Illuminate\View\View
     */
    public function sendForm($events)
    {
        $event = $this->eventRepository->getEvent($events);
        return view('events.send', compact('event'));
    }

    /**
     * Send a specified event to a specified user
     *
     * @param $events
     * @param SendEventRequest|Request $request
     *
     * @return mixed
     * @internal param Event $event
     *
     */
    public function send($events, SendEventRequest $request)
    {
        $event = $this->eventRepository->getEvent($events);
        $user = $request->input('user');

        $send = $this->eventRepository->sendEvent($event->event, $user);

        if(array_key_exists('error',$send))
        {
            return redirect()->back()->withMessage($send['error']);
        } else {
            return redirect()->route('events.index')->withMessage('The event has been sent to '.$send['name'].'.');
        }
    }
}
