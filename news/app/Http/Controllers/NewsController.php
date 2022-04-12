<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyNewsRequest;
use App\Http\Requests\ShowNewsRequest;
use App\Http\Requests\StoreNewsRequest;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function show(ShowNewsRequest $showNewsRequest)
    {
        $properties = $showNewsRequest->validated();
        try {
            if (isset($properties['id'])) {
                $article = News::get($properties['id']);
            } else {
                $article = News::search($properties['q']);
            }
        } catch (\Exception $exception) {
            abort(404);
        }
        return view('NewsTemplate', compact('article'));
    }

    public function store(StoreNewsRequest $storeNewsRequest)
    {
        $properties = $storeNewsRequest->validated();
        try {
            News::create($properties['title'], $properties['announcement'], $properties['body'], $properties['tags'] ?? '');
            return 'success';
        } catch (\Exception $exception) {
            return 'error';
        }
    }

    public function destroy(DestroyNewsRequest $destroyNewsRequest)
    {
        $properties = $destroyNewsRequest->validated();
        if (News::delete($properties['id'])) {
            return 'success';
        };
        return 'error';
    }
}
