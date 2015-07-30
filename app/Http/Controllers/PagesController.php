<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\PagesRepository;
use Illuminate\Http\Request;

class PagesController extends Controller {

    protected $pagesRepository;

    /**
     * PagesController constructor.
     *
     * @param $pagesRepository
     */
    public function __construct(PagesRepository $pagesRepository)
    {
        $this->middleware('auth', ['except' => 'index']);
        $this->pagesRepository = $pagesRepository;
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
        $cities = $this->pagesRepository->getTravelableCities(\Auth::user()->isAdmin());

        return view('location.travel', compact('cities'));
	}

    public function travel(Request $request)
    {
        $travel = $this->pagesRepository->handleTravel($request->input('city'));
        
        if(array_key_exists('error', $travel))
        {
            return redirect()->back()->withMessage($travel['error']);
        } else {
            return redirect()->back()->withMessage($travel['message']);
        }
    }
}
