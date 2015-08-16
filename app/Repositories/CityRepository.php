<?php

    namespace App\Repositories;

    use App\City;

    class CityRepository
    {
        protected $model;

        /**
         * CityRepository constructor.
         *
         * @param $model
         */
        public function __construct(City $model)
        {
            $this->model = $model;
        }

        public function all()
        {
            return $this->model->all();
        }


    }
