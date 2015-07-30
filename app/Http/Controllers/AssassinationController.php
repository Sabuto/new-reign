<?php

    namespace App\Http\Controllers;

    use App\Http\Requests;
    use App\Repositories\AssassinationRepository;
    use Auth;

    class AssassinationController extends Controller
    {

        protected $assRepository;

        /**
         * AssassinationController constructor.
         *
         * @param $assRepository
         */
        public function __construct(AssassinationRepository $assRepository)
        {
            $this->middleware('auth');
            $this->assRepository = $assRepository;
        }


        public function index()
        {
            if (Auth::user()->assassination_id != 0) {
                $target = Auth::user();

                return view('assassination.index', compact('target'));
            } else {
                $this->assRepository->giveUserATarget(Auth::id());

                return redirect()->refresh()->withMessage(\Session::get('message'));
            }
        }

        public function kill()
        {
            $target = $this->assRepository->kill(Auth::id());
            if (array_key_exists('message', $target)) {
                return redirect()->back()->withMessage($target['message']);
            }
            if (array_key_exists('error', $target)) {
                return redirect()->back()->withMessage($target['error']);
            }
        }
    }
