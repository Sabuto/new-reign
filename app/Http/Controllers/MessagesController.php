<?php

    namespace App\Http\Controllers;

    use App\Repositories\MessagesRepository;
    use App\Repositories\UserRepository;
    use App\User;
    use Auth;
    use Carbon\Carbon;
    use Cmgmyr\Messenger\Models\Message;
    use Cmgmyr\Messenger\Models\Participant;
    use Cmgmyr\Messenger\Models\Thread;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Input;
    use Vinkla\Pusher\PusherManager;

    class MessagesController extends Controller
    {

        protected $messagesRepository;
        protected $userRepository;
        protected $pusher;

        /**
         * MessagesController constructor.
         */
        public function __construct(MessagesRepository $messagesRepository, UserRepository $userRepository, PusherManager $pusherManager)
        {
            $this->middleware('auth');
            $this->messagesRepository = $messagesRepository;
            $this->userRepository = $userRepository;
            $this->pusher = $pusherManager;
        }

        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
        public function index()
        {
            $currentUserId = $this->userRepository->getUser(Auth::id());
            $threads = Thread::forUser($currentUserId->id)->get();

            return view('messages.index', compact('threads', 'currentUserId'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return Response
         */
        public function create()
        {
            $users = $this->userRepository->getEveryOneExceptCertainUser(Auth::id());

            return view('messages.create', compact('users'));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @return Response
         */
        public function store()
        {
            $input = Input::all();
            $thread = $this->messagesRepository->createThread($input['subject']);
            // Message
            $message = $this->messagesRepository->createMessage($thread->id, Auth::id(), $input['message']);
            // Sender
            $this->messagesRepository->addParticipents($thread->id, Auth::id());
            // Recipients
            if (Input::has('recipients')) {
                $thread->addParticipants($input['recipients']);
            }

            $this->pushIt($message);

            return redirect('messages');
        }

        /**
         * Display the specified resource.
         *
         * @param  int $id
         *
         * @return Response
         */
        public function show($id)
        {
            try {
                $thread = $this->messagesRepository->getThread($id);
            } catch (ModelNotFoundException $e) {
                Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

                return redirect('messages');
            }

            // show current user in list if not a current participant
            // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();
            // don't show the current user in list
            $userId = Auth::user()->id;
            $users  = $this->userRepository->whereNotIn($thread->participantsUserIds($userId));
            $thread->markAsRead($userId);

            return view('messages.show', compact('thread', 'users'));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         *
         * @return Response
         */
        public function edit($id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  int $id
         *
         * @return Response
         */
        public function update($id)
        {
            try {
                $thread = Thread::findOrFail($id);
            } catch (ModelNotFoundException $e) {
                Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
                return redirect('messages');
            }
            $thread->activateAllParticipants();
            // Message
            $message = Message::create(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => Auth::id(),
                    'body'      => Input::get('message'),
                ]
            );
            // Add replier as a participant
            $participant = Participant::firstOrCreate(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => Auth::user()->id
                ]
            );
            $participant->last_read = new Carbon;
            $participant->save();
            // Recipients
            if (Input::has('recipients')) {
                $thread->addParticipants(Input::get('recipients'));
            }

            $this->pushIt($message);

            return redirect('messages/' . $id);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         *
         * @return Response
         */
        public function destroy($id)
        {
            //
        }

        protected function pushIt(Message $message)
        {
            $thread = $message->thread;
            $sender = $message->user;

            $data = [
                'thread_id' => $thread->id,
                'div_id' => 'thread_'. $thread->id,
                'sender_name' => $sender->name,
                'thread_url' => route('messages.show', ['id' => $thread->id]),
                'thread_subject' => $thread->subject,
                'html' => view('messages.html-message', compact('message'))->render(),
                'text' => str_limit($message->body, 50)
            ];

            $recipients = $thread->participantsUserIds();
            if(count($recipients) > 0)
            {
                foreach($recipients as $recipient)
                {
                    if($recipient == $sender->id)
                    {
                        continue;
                    }

                    $this->pusher->trigger('for_user_'.$recipient, 'new_message', $data);
                }
            }
        }

        public function unread()
        {
            $count = Auth::user()->newMessagesCount();
            return ['msg_count' => $count];
        }

        public function read($id)
        {
            $thread = Thread::find($id);
            if (!$thread) {
                abort(404);
            }
            $thread->markAsRead(Auth::id());
        }
    }
