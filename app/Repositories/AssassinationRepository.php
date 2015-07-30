<?php

    namespace App\Repositories;

    use App\Assassination;
    use App\User;

    class AssassinationRepository
    {

        protected $assassination;
        protected $user;

        /**
         * AssassinationRepository constructor.
         *
         * @param $assassination
         */
        public function __construct(Assassination $assassination, UserRepository $userRepository)
        {
            $this->assassination = $assassination;
            $this->user          = $userRepository;
        }

        public function getAllTargets()
        {
            $targets = $this->assassination->with('users')->get();

            return $targets;
        }

        public function getUserTarget($id)
        {
            $target = $this->user->getUser($id);

            return $target;
        }

        public function giveUserATarget($id)
        {
            $giveTarget = User::find($id);
            $target     = $this->randomTarget();
            $giveTarget->assassination()->associate($target);
            $giveTarget->save();

            return $target;
        }

        protected function randomTarget()
        {
            $target = $this->assassination->orderByRaw("RAND()")->first();

            return $target;
        }

        public function kill($userId)
        {
            /* TODO: Add jail functionality to assassination

            */

            $user   = User::find($userId);
            $target = $user->assassination;

            $hit  = $this->checkHit($user->offence, $target->defence);
            $city = $this->checkCity($user->city_id, $target->city);

            if ( ! $city) {
                return ['error' => 'You need to be in the same city to assassinate someone.'];
            }

            if ($hit) {
                $money = $user->cashHand + $target->bounty;
                /*TODO: Add time limit on assassination*/
                /*TODO: Add Stats functionality global and user specific*/

                $user->cashHand         = $money;
                $user->assassination_id = 0;
                $user->save();

                return [
                    'message' => 'You have successfully assassinated ' . $target->name . ' and received &pound;' . number_format($target->bounty,
                            1) . ' for your efforts. You have benn assigned a new Target.'
                ];
            } else {
                return ['message' => 'You have failed to assassinate ' . $target->name . ' he was not notified this time, you have another chance.'];
            }
        }

        protected function checkHit($offence, $defence)
        {
            if ($offence > $defence) {
                return true;
            } else {
                return false;
            }
        }

        protected function checkCity($userCity, $targetCity)
        {
            if ($userCity == $targetCity) {
                return true;
            } else {
                return false;
            }
        }
    }
