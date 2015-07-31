<?php

    namespace App\Repositories;

    use App\User;
    use App\Vehicle;
    use Auth;

    class VehicleRepository
    {

        protected $model;

        /**
         * VehicleRepository constructor.
         *
         * @param $model
         */
        public function __construct(Vehicle $model)
        {
            $this->model = $model;
        }

        public function all()
        {
            return $this->model->all();
        }

        public function with($relationship)
        {
            return $this->model->with($relationship);
        }

        public function get()
        {
            return $this->model->get();
        }

        public function where($option1, $delimiter, $option2)
        {
            return $this->model->where($option1, $delimiter, $option2);
        }

        public function handleBuy($id)
        {
            $vehicle = $this->find($id);

            if (Auth::user()->cashHand < $vehicle->price) {
                return ['error' => 'You do not have enough money to buy that vehicle.'];
            }

            if ($vehicle->id == Auth::user()->vehicle_id) {
                return ['error' => 'There is no point in buying a vehicle you already own.'];
            }

            if ($vehicle->rank_id > Auth::user()->rank_id) {
                return ['error' => 'You cannot buy that vehicle.'];
            }

            $user             = User::find(Auth::id());
            $user->cashHand   = $user->cashHand - $vehicle->price;
            $user->vehicle_id = $id;

            if ($user->save()) {
                return ['message' => 'You have bought a ' . $vehicle->name . ' costing you &pound;' . number_format($vehicle->price) . '.'];
            } else {
                return ['error' => 'Something went wrong when saving.'];
            }
        }

        public function find($id)
        {
            return $this->model->find($id);
        }

    }
