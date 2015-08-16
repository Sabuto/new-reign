<?php

    namespace App\Repositories;

    use App\Crime;

    class CrimesRepository
    {

        protected $model;

        /**
         * CrimesRepository constructor.
         *
         * @param $model
         */
        public function __construct(Crime $model)
        {
            $this->model = $model;
        }

        public function where($column, $delib, $value)
        {
            return $this->model->where($column, $delib, $value);
        }

        public function first()
        {
            return $this->model->first();
        }

        public function orderBy($column, $order)
        {
            return $this->model->orderBy($column, $order);
        }

        public function get()
        {
            return $this->model->get();
        }

        public function crimeMoney($id)
        {
            $crime = $this->find($id);

            return rand($crime->min_money, $crime->max_money);
        }

        public function find($id)
        {
            return $this->model->find($id);
        }

        public function compileSuccessMessage($message, $money)
        {
            return str_replace("*MONEY*", $money, $message);
        }

        public function persistCrime($id = null, $input = [])
        {
            if ($id == null) {
                $crime = new Crime();
            } else {
                $crime = $this->find($id);
            }

            $crime->name            = $input['name'];
            $crime->off_shown       = $input['off_shown'];
            $crime->def_shown       = $input['def_shown'];
            $crime->stl_shown       = $input['stl_shown'];
            $crime->off_real        = $input['off_real'];
            $crime->def_real        = $input['def_real'];
            $crime->stl_real        = $input['stl_real'];
            $crime->points_needed   = $input['points_needed'];
            $crime->points          = $input['points'];
            $crime->city_id         = $input['city'];
            $crime->success_message = $input['success_message'];
            $crime->fail_message    = $input['fail_message'];
            $crime->jail_message    = $input['jail_message'];
            $crime->min_money       = $input['min_money'];
            $crime->max_money       = $input['max_money'];
            $crime->crime_timer     = $input['crime_timer'];
            $crime->jail_timer      = $input['jail_timer'];

            if ($crime->save()) {
                if ($id == null) {
                    return ['Success' => 'You have successfully added a crime.'];
                } else {
                    return ['Success' => 'You have successfully edited a crime.'];
                }
            } else {
                return ['Error' => 'Something went wrong when saving it to the db, try again.'];
            }
        }
    }
