<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $breakingNews = News::where(['is_breaking_news' => 1,])
            ->activeEntries()
            ->withLocalize()
            ->orderBy('id', 'DESC')
            ->take(10)
            ->get();
        return view('frontend.home', compact('breakingNews'));
    }

    public function ShowNews(string $slug)
    {
        $news = News::with(['auther', 'tags', 'comments'])->where('slug', $slug)
            ->activeEntries()
            ->withLocalize()
            ->first();

        $recentNews = News::with(['category', 'auther'])->where('slug', '!=', $news->slug)
            ->activeEntries()
            ->withLocalize()
            ->orderBy('id', 'DESC')->take(4)->get();

        $mostCommonTags = $this->mostCommonTags();



        $this->countView($news);

        return view('frontend.news-details', compact('news', 'recentNews', 'mostCommonTags'));
    }

    public function countView($news)
    {
        if (session()->has('viewed_posts')) {
            $postIds = session('viewed_posts');

            if (!in_array($news->id, $postIds)) {
                $postIds[] = $news->id;
                $news->increment('views');
            }
            session(['viewed_posts' => $postIds]);
        } else {
            session(['viewed_posts' => [$news->id]]);
            $news->increment('views');
        }
    }

    public function mostCommonTags()
    {
        return Tag::select('name', \DB::raw('COUNT(*) as count'))
            ->where('language', getLanguage())
            ->groupBy('name')
            ->orderByDesc('count')
            ->take(15)
            ->get();
    }

    public function handleComment(Request $request)
    {
        $request->validate([
            'comment' => ['required', 'string', 'max:1000']
        ]);

        $comment = new Comment();
        $comment->news_id = $request->news_id;
        $comment->user_id = Auth::user()->id;
        $comment->parent_id = $request->parent_id;
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->back();
    }

    public function handleReplay(Request $request)
    {
        $request->validate([
            'replay' => ['required', 'string', 'max:1000']
        ]);

        $comment = new Comment();
        $comment->news_id = $request->news_id;
        $comment->user_id = Auth::user()->id;
        $comment->parent_id = $request->parent_id;
        $comment->comment = $request->replay;
        $comment->save();

        return redirect()->back();
    }

    public function commentDestroy(Request $request)
    {
        $comment = Comment::findOrFail($request->id);
        if (Auth::user()->id === $comment->user_id) {
            $comment->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        }

        return response(['status' => 'error', 'message' => 'Something went wrong!']);
    }
}
