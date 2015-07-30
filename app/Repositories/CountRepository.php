<?php

    namespace App\Repositories;

    use Auth;

    class CountRepository
    {
        protected $user;

        function __construct()
        {
            $this->user = Auth::user();
        }

        public function getEventCount()
        {
            $count = $this->user->events()->count();

            return $count;
        }
    }