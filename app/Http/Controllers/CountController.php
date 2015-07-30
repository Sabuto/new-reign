<?php

namespace App\Http\Controllers;

use App\Repositories\CountRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CountController extends Controller
{

    protected $countRepository;

    function __construct(CountRepository $countRepository)
    {
        $this->countRepository = $countRepository;
    }

    public function events()
    {
        $count = $this->countRepository->getEventCount();

        return $count;
    }
}
