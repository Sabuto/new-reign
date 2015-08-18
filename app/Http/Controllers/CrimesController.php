<?php

    namespace App\Http\Controllers;

    use App\Http\Requests;
    use App\Http\Requests\CreateCrimeRequest;
    use App\Repositories\CityRepository;
    use App\Repositories\CrimesRepository;
    use App\Repositories\UserRepository;
    use Auth;
    use Carbon\Carbon;
    use Illuminate\Http\Request;

    class CrimesController extends Controller
    {

        protected $repo;
        protected $userRepo;
        protected $cityRepo;

        /**
         * CrimesController constructor.
         *
         * @param CrimesRepository $repo
         * @param UserRepository $userRepository
         * @param CityRepository $cityRepository
         */
        public function __construct(
            CrimesRepository $repo,
            UserRepository $userRepository,
            CityRepository $cityRepository
        ) {
            $this->repo     = $repo;
            $this->userRepo = $userRepository;
            $this->cityRepo = $cityRepository;
            $this->middleware('auth');
            $this->middleware('admin', ['except' => 'index']);
        }

        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
        public function index()
        {
            $crimes = $this->repo->where('city_id', '=', Auth::user()->city_id)->get();
            $timer  = $this->userRepo->getCrimeTimer(Auth::id());

            return view('crimes.index', compact('crimes', 'timer'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return Response
         */
        public function create()
        {
            $cities = $this->cityRepo->all();

            return view('crimes.create', compact('cities'));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param CreateCrimeRequest $request
         *
         * @return Response
         */
        public function store(CreateCrimeRequest $request)
        {
            $input = $request->all();

            $message = $this->repo->persistCrime(null, $input);

            return $this->processPersistResponse($message);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         *
         * @return Response
         */
        public function edit($id)
        {
            $crime = $this->repo->find($id);
            $cities = $this->cityRepo->all();

            return view('crimes.edit', compact('crime', 'cities'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param CreateCrimeRequest $request
         * @param  int $id
         *
         * @return Response
         */
        public function update(CreateCrimeRequest $request, $id)
        {
            $input = $request->all();

            $message = $this->repo->persistCrime($id, $input);

            return $this->processPersistResponse($message);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         *
         * @return Response
         */
        public function destroy($id)
        {
            //
        }

        public function doCrime(Request $request)
        {
            $id = $request->input('crime');

            $crime = $this->repo->find($id);

            if (Auth::user()->points < $crime->points_needed) {
                $randN = rand(1, 10);
                if ($randN > 8) {
                    /* Todo: Implement Jail */
                    return redirect()->back()->withMessage('Yu would have been jailed! except we are being kind.');
                } else {
                    return redirect()->back()->withMessage($crime->fail_message);
                }
            }

            $money = $this->repo->crimeMoney($id);

            $timer           = Carbon::now();
            $timer           = $timer->modify($crime->crime_timer);
            $user            = Auth::user();
            $user->offence   = $user->offence + $crime->off_real;
            $user->defence   = $user->defence + $crime->def_real;
            $user->stealth   = $user->stealth + $crime->stl_real;
            $user->points    = $user->points + $crime->points;
            $user->cashHand  = $user->cashHand + $money;
            $user->crimeTime = $timer;
            $user->save();

            $message = $this->repo->compileSuccessMessage($crime->success_message, $money);

            return redirect()->back()->withMessage($message);
        }

        /**
         * @param $message
         *
         * @return mixed
         */
        private function processPersistResponse($message)
        {
            if (array_key_exists('Success', $message)) {
                return redirect()->back()->withMessage($message['Success']);
            } else if (array_key_exists('error', $message)) {
                return redirect()->back()->withMessage($message['Error']);
            }
        }
    }
