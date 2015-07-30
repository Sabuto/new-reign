<?php

    namespace App\Repositories;

    use App\Events\HookerBought;
    use App\Hooker;
    use App\User;
    use Auth;

    class HookerRepository
    {

        public function getHookerstoBuy()
        {
            return Hooker::whereDoesntHave('users')->get();
        }

        public function buyHooker( Hooker $hooker, User $user )
        {
            if($user->cashHand < $hooker->price)
            {
                return false;
            }

            $user->cashHand = $user->cashHand - $hooker->price;

            $user->save();

            $user->hookers()->attach($hooker->id);

            event(new HookerBought($hooker));

            return $hooker;
        }

        public function sellHooker( Hooker $hooker, User $user )
        {
            $sellPrice = $hooker->price / 2;
            $user->cashHand = $user->cashHand + $sellPrice;

            $user->save();
            $user->hookers()->detach($hooker->id);

            return $sellPrice;
        }

        public function payUsers()
        {
            foreach(User::all() as $user)
            {
                foreach($user->hookers as $hooker)
                {
                    $user->cashHand = $hooker->payout + $user->cashHand;

                    $user->save();
                }
            }

            return true;
        }
    }