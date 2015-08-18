<?php

    namespace App\Repositories;

    use App\City;
    use App\User;
    use App\Vehicle;
    use Auth;
    use Carbon\Carbon;

    class PagesRepository
    {

        /**
         * City Model
         * @var City
         */
        protected $cities;

        protected $user;

        protected $vehicle;

        /**
         * PagesRepository constructor.
         *
         * @param City $cities
         *
         * @internal param $travel
         */
        public function __construct(City $cities, Vehicle $vehicle)
        {
            $this->cities = $cities;
            $this->vehicle = $vehicle;
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
        public function handleTravel($cityId, $vehicleId)
        {
            $city = $this->cities->find($cityId);
            $vehicle = $this->vehicle->find($vehicleId, ['travel_time']);
            if (Auth::user()->city_id == $cityId) {
                return ['error' => 'You cannot travel to the city you are already in.'];
            }

            if (Auth::user()->cashHand < $city->cost) {
                return ['error' => 'You cannot afford to travel there.'];
            }

            $now = Carbon::now();
            $nextTravel = $now->modify($vehicle->travel_time);

            $user           = User::find(Auth::id());
            $user->cashHand = $user->cashHand - $city->cost;
            $user->travelTime = $nextTravel;
            $user->city()->associate($city);
            $user->save();

            return ['message' => 'You have travelled to ' . $city->name . ' costing you &pound;' . number_format($city->cost) . '.'];
        }
    }
