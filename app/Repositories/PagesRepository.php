<?php

    namespace App\Repositories;

    use App\City;
    use App\User;
    use Auth;

    class PagesRepository
    {

        /**
         * City Model
         * @var City
         */
        protected $cities;

        protected $user;

        /**
         * PagesRepository constructor.
         *
         * @param City $cities
         *
         * @internal param $travel
         */
        public function __construct(City $cities)
        {
            $this->cities = $cities;
        }

        /**
         * Retrieve all the cities in the table
         * @return \Illuminate\Database\Eloquent\Collection|static[]
         */
        public function getAllCities()
        {
            $cities = $this->cities->all();

            return $cities;
        }

        /**
         * Retrieve cities available
         * @return mixed
         */
        public function getTravelableCities($isAdmin = '0')
        {
            if(!$isAdmin)
            {
                return $this->cities->where('id', '!=', Auth::user()->city_id)->where('status', 'Open')->get();
            } else {
                return $this->cities->where('id', '!=', Auth::user()->city_id)->get();
            }
        }

        /**
         * @param $cityId
         *
         * @return array
         */
        public function handleTravel($cityId)
        {
            $city = $this->cities->find($cityId);
            if (Auth::user()->city_id == $cityId) {
                return ['error' => 'You cannot travel to the city you are already in.'];
            }

            if (Auth::user()->cashHand < $city->cost) {
                return ['error' => 'You cannot afford to travel there.'];
            }

            $user           = User::find(Auth::id());
            $user->cashHand = $user->cashHand - $city->cost;
            $user->city()->associate($city);
            $user->save();

            return ['message' => 'You have travelled to ' . $city->name . ' costing you &pound;' . number_format($city->cost) . '.'];
        }
    }
