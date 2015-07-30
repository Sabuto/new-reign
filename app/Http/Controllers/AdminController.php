<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\AdminStoreEvent;
use App\Repositories\AdminRepository;
use App\Repositories\AssassinationRepository;
use App\Repositories\EventRepository;
use App\User;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $adminRepository;
    protected $eventRepoistory;
    protected $assassinationRepository;

    function __construct(AdminRepository $adminRepository, EventRepository $eventRepository, AssassinationRepository $assassinationRepository)
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->adminRepository = $adminRepository;
        $this->eventRepoistory = $eventRepository;
        $this->assassinationRepository = $assassinationRepository;
    }

    public function index()
    {
        $users = $this->adminRepository->getUsersForDashboard( Auth::user()->id);
        return view('admin.index', compact('users'));
    }

    public function event()
    {
        return view('admin.event');
    }

    /**
     * Store an custom event into the db
     *
     * @param AdminStoreEvent $request
     *
     * @return mixed
     */
    public function storeEvent( AdminStoreEvent $request)
    {
        $user = $request->input('user');
        $event = $request->input('event');

        /*$createdEvent = new Event(['event' => $event]);

        $createEvent = User::find($user)->events()->save($createdEvent);*/

        $createEvent = $this->eventRepoistory->sendEvent($event, $user);

        if(!$createEvent)
        {
            return redirect()->back()->withMessage('There was an error creating your event.');
        }

        return redirect()->back()->withMessage('Event has been created');
    }

    public function assassinationTargets()
    {
        $targets = $this->assassinationRepository->getAllTargets();

        return view('admin.assassination', compact('targets'));
    }

    public function viewRanks(){
        $ranks =
    }
}
