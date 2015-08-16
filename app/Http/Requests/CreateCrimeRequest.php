<?php

    namespace App\Http\Requests;

    class CreateCrimeRequest extends Request
    {

        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            return [
                /*'name'            => 'required|string',
                'off_shown'       => 'required|numeric',
                'def_shown'       => 'required|numeric',
                'stl_shown'       => 'required|numeric',
                'off_real'        => 'required|numeric',
                'def_real'        => 'required|numeric',
                'stl_real'        => 'required|numeric',
                'points_needed'   => 'required|numeric',
                'points'          => 'required|numeric',
                'city_id'         => 'required|numeric',
                'success_message' => 'required|min:10',
                'fail_message'    => 'required|min:10',
                'jail_message'    => 'required|min:10',
                'min_money'       => 'required|numeric',
                'max_money'       => 'required|numeric',
                'crime_timer'     => 'required',
                'jail_timer'      => 'required'*/
            ];
        }
    }
