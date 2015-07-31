<?php

    namespace App\Repositories;

    use App\Rank;

    class RankRepository
    {

        protected $model;

        /**
         * RankRepository constructor.
         *
         * @param Rank $rank
         *
         * @internal param $model
         */
        public function __construct(Rank $rank)
        {
            $this->model = $rank;
        }

        public function all()
        {
            return $this->model->all();
        }
    }
