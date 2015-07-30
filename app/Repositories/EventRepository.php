<?php

    namespace App\Repositories;

    use App\Event;
    use App\User;
    use Auth;

    /**
     * Class EventRepository
     * @package App\Repositories
     */
    class EventRepository
    {

        protected $model;
        protected $userModel;
        /**
         * @var User
         */
        private $user;

        /**
         * EventRepository constructor.
         *
         * @param $model
         */
        public function __construct(Event $model, User $user)
        {
            $this->model = $model;
            $this->user  = $user;
        }


        /**
         * Return all event for a specified user
         *
         * @param $id
         *
         * @return mixed
         * @internal param User $user
         *
         */
        public function getEventsForUser($id)
        {
            return $this->user->find($id)->events;
        }

        /**
         * Return an event
         *
         * @param $eventId
         *
         * @return mixed
         */
        public function getEvent($eventId)
        {
            return $this->model->find($eventId);
        }

        /**
         * Delete a event for the auth user
         *
         * @param $id
         *
         * @return bool
         */
        public function deleteEvent($id)
        {
            $event = Event::find($id);

            if ($event->user_id != Auth::id()) {
                return false;
            }
            $delete = $event->delete();

            return $delete;
        }

        /**
         * Send an event to a user
         *
         * @param $event
         * @param $id
         *
         * @return mixed
         * @internal param $user
         *
         */
        public function sendEvent($event, $id)
        {
            $user = User::find($id);

            if ($user->state->id != 1) {
                return ['error' => 'You cannot send an event to a user that is dead'];
            }

            $sendEvent = new Event(['event' => $event]);

            $save = $user->events()->save($sendEvent);

            $saveArray = $save->toArray();
            $array     = $user->toArray();

            return $array + $saveArray;
        }

        public function updateEventsRead($id)
        {
            $user = User::find($id);

            if ($user->eventsRead == 0) {
                $user->eventsRead = 1;
                $user->save();

                return $user;
            }
        }
    }