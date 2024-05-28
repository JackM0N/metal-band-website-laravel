<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', News::class);
        return view(
            'news.index'
        );
    }

    public function create()
    {
        $this->authorize('create', News::class);
        return view(
            'news.form'
        );
    }

    public function edit(News $news)
    {
        $this->authorize('update', $news);
        return view(
            'news.form',
            [
                'news' => $news
            ]
        );
    }
}
