<?php

namespace App\Http\Controllers;

use App\Events\NewsItemPosted;
use App\Http\Requests\PostNewsRequest;
use App\Repositories\NewsRepository;
use App\Repositories\UserRepository;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    protected $newsRepository;

    protected $userRepository;

    function __construct(NewsRepository $newsRepository, UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->middleware('admin', ['except' => 'index']);
        $this->newsRepository = $newsRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $news = $this->newsRepository->getallNews();
        $user = $this->userRepository->getUser(Auth::id());

        return view('news.index', compact('news', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostNewsRequest $request
     *
     * @return Response
     */
    public function store( PostNewsRequest $request)
    {
        $postNews = $this->newsRepository->postNews($request->input('title'), $request->input('news'));

        return redirect()->route('news.index')->withMessage('You have created a new news item with the title "'.$postNews->title.'".');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $news = $this->newsRepository->getNewsItem($id);

        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostNewsRequest $request
     * @param  int $id
     *
     * @return Response
     */
    public function update(PostNewsRequest $request, $id)
    {
        $title = $request->input('title');
        $text = $request->input('news');
        $update = $this->newsRepository->updateNewsItem($id, $title, $text);

        if($update)
        {
            return redirect()->route('news.index')->withMessage('The news item has been updated');
        } else {
            return redirect()->back()->withMessage('There was an error updating the news item');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $delete = $this->newsRepository->deleteNewsItem($id);
        
        if($delete)
        {
            redirect()->route('news.index')->withMessage('That news item has been deleted.');
        } else {
            redirect()->route('news.index')->withMessage('There was an error deleting that news item.');
        }
    }
}
