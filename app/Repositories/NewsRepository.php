<?php

    namespace App\Repositories;

    use App\Events\NewsItemPosted;
    use App\News;
    use Auth;

    class NewsRepository
    {

        /**
         * Return all news items
         *
         * @return mixed
         */
        public function getallNews()
        {
            $news = News::orderBy('updated_at', 'desc')->get();

            return $news;
        }

        /**
         * Return a sing news item
         *
         * @param $id
         *
         * @return mixed
         */
        public function getNewsItem( $id )
        {
            $news = News::find($id);

            return $news;
        }

        /**
         * Update a news item
         *
         * @param $id
         * @param $title
         * @param $text
         *
         * @return mixed
         */
        public function updateNewsItem( $id, $title, $text)
        {
            $news = News::find($id);

            $news->title = $title;
            $news->text = $text;

            $save = $news->save();

            return $save;
        }

        public function deleteNewsItem( $id )
        {
            $news = News::find($id);

            $delete = $news->delete();

            return $delete;
        }

        /**
         * Persist the news item to storage
         *
         * @param $title
         * @param $text
         *
         * @return \Illuminate\Database\Eloquent\Model
         */
        public function postNews( $title, $text )
        {
            $news = new News();
            $user = Auth::user();

            $news->title = $title;
            $news->text = $text;

            $save = $user->news()->save($news);

            event(new NewsItemPosted($news));

            return $save;
        }
    }