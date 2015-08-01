<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\PagesRepository;
use App\Repositories\UserRepository;
use App\Repositories\VehicleRepository;
use Auth;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    protected $pagesRepository;
    protected $vehicleRepository;
    protected $userRepository;

    /**
     * PagesController constructor.
     *
     * @param $pagesRepository
     */
    public function __construct(
        PagesRepository $pagesRepository,
        VehicleRepository $vehicleRepository,
        UserRepository $userRepository
    ) {
        $this->middleware('auth', ['except' => 'index']);
        $this->pagesRepository   = $pagesRepository;
        $this->vehicleRepository = $vehicleRepository;
        $this->userRepository    = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('index');
    }

    public function travelForm()
    {
        $cities = $this->pagesRepository->getTravelableCities(Auth::user()->isAdmin());

        return view('location.travel', compact('cities'));
    }

    public function travel(Request $request)
    {
        $travel = $this->pagesRepository->handleTravel($request->input('city'));

        if (array_key_exists('error', $travel)) {
            return redirect()->back()->withMessage($travel['error']);
        } else {
            return redirect()->back()->withMessage($travel['message']);
        }
    }

    public function vehicles()
    {
        /* TODO: Add travel time to vehicle */
        $vehicles       = $this->vehicleRepository->with('rank')->where('id', '!=',
            Auth::user()->vehicle_id)->where('rank_id', '<=', Auth::user()->rank_id)->get();
        $currentVehicle = $this->vehicleRepository->find(Auth::user()->vehicle_id);

        return view('location.vehicles', compact('vehicles', 'currentVehicle'));
    }

    public function vehiclePost(Request $request)
    {
        $buy = $this->vehicleRepository->handleBuy($request->input('vehicle'));

        if (array_key_exists('error', $buy)) {
            return redirect()->back()->withMessage($buy['error']);
        } else {
            return redirect()->back()->withMessage($buy['message']);
        }
    }

    public function inCity()
    {
        $users = $this->userRepository->getUsersInCity();

        return view('city.inCity', compact('users'));
    }
}
