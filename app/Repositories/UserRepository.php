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

        public function getUsersInCity()
        {
            return $this->userOb->with('rank')->where('city_id', \Auth::user()->city_id)->orderBy('rank_id', 'desc')->get();
        }

        public function getCrimeTimer($id)
        {
            return $this->userOb->where('id', $id)->first(['crimeTime']);
        }
        public function getTravelTimer($id)
        {
            return $this->userOb->where('id', $id)->first(['travelTime']);
        }

        public function where($column, $deliminator, $value)
        {
            return $this->userOb->where($column, $deliminator, $value);
        }

        public function first()
        {
            return $this->userOb->firs();
        }
    }