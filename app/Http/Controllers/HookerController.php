<?php namespace App\Http\Controllers;

use App\Event;
use App\Hooker;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\HookerRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
class HookerController extends Controller {

    protected $hookerRepository;

	function __construct(HookerRepository $hookerRepository)
	{
        $this->hookerRepository = $hookerRepository;
		$this->middleware('auth');
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $time = new Carbon('12:00:00 am tomorrow');
        $diff = $time->diffForHumans();
		$hookers = $this->hookerRepository->getHookerstoBuy();
		$userHookers = User::find(Auth::user()->id)->hookers;
		return view('hookers.index', compact('hookers', 'userHookers', 'diff'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$detach = $this->hookerRepository->sellHooker(Hooker::find($id), Auth::user());

        if(!$detach)
        {
            return redirect()->back()->withMessage('Error selling hooker.');
        }

        return redirect()->back()->withMessage('Hooker has been sold for '. $detach.'.');
	}

	public function buy(Request $request)
	{
		$id = $request->input('hooker');

        $buy = $this->hookerRepository->buyHooker(Hooker::find($id), Auth::user());

        if(!$buy)
        {
            return redirect()->back()->withMessage('You do not have enough money to buy her.');
        }

		return redirect()->back()->withMessage('You have bought that hooker.');
	}

    public function payout()
    {
       if($this->hookerRepository->payUsers())
        {
            return redirect()->back()->withMessage('Your hookers went out and sold them selves for you, money earned is in your hand.');
        }
        return redirect()->back()->withMessage('Error.');
    }

}
