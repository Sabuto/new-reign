<?php
    namespace App\Repositories;

    use App\User;

    class UserRepository
    {

        protected $userOb;

        /**
         * UserRepository constructor.
         */
        public function __construct(User $user)
        {
            $this->userOb = $user;
        }

        /**
         * Get the Model for a user
         *
         * @param $id
         *
         * @return mixed
         */
        public function getUser($id)
        {
            return $this->userOb->find($id);
        }

        public function getEveryOneExceptCertainUser($id)
        {
            return $this->userOb->where('id', '!=', $id)->get();
        }

        public function whereNotIn($userId)
        {
            return $this->userOb->whereNotIn('id', $userId)->get();
        }

        public function getAssasinationTarget($id)
        {
            return $this->userOb->find($id)->where('ass_id', $id)->get();
        }

        public function getCurrentVehicle($id)
        {
            return $this->userOb->with('vehicle')->where('id', $id)->get();
        }
    }