<?php
    namespace App\Repositories;

    use App\User;

    class AdminRepository
    {

        public function getUsersForDashboard($currentId)
        {
            $users = User::where('id', '!=', $currentId)->get();

            return $users;
        }
    }