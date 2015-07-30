<?php

    namespace App\Repositories;

    use Carbon\Carbon;
    use Cmgmyr\Messenger\Models\Message;
    use Cmgmyr\Messenger\Models\Participant;
    use Cmgmyr\Messenger\Models\Thread;

    class MessagesRepository
    {

        protected $threadObj;
        protected $messageObj;
        protected $participantsObj;

        /**
         * MessagesRepository constructor.
         *
         * @param $threadObj
         * @param $messageObj
         * @param $participantsObj
         */
        public function __construct(Thread $threadObj, Message $messageObj, Participant $participantsObj)
        {
            $this->threadObj       = $threadObj;
            $this->messageObj      = $messageObj;
            $this->participantsObj = $participantsObj;
        }


        public function getAllThreads()
        {
            return $this->threadObj->all();
        }

        public function getThread($id)
        {
            return $this->threadObj->findOrFail($id);
        }

        public function createThread($subject)
        {
            return $this->threadObj->create([
                'subject' => $subject,
            ]);
        }

        public function createMessage($threadId, $userId, $body)
        {
            return $this->messageObj->create([
                'thread_id' => $threadId,
                'user_id'   => $userId,
                'body'      => $body,
            ]);
        }

        public function addParticipents($threadId, $userId)
        {
            return $this->participantsObj->create([
                'thread_id' => $threadId,
                'user_id'   => $userId,
                'last_read' => new Carbon,
            ]);
        }
    }