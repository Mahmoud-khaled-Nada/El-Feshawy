<?php

namespace App\Http\Controllers\AdminPanel;

use App\Helpers\Constants;
use App\Helpers\Services;
use App\Http\Controllers\Controller;
use App\Http\Traits\HandleApiResponse;
use App\Models\PagesContent;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use HandleApiResponse;

    // protected $news;
    public function __construct()
    {
        $this->middleware('permission:view news', ['only' => ['index']]);
        $this->middleware('permission:create news', ['only' => ['create', 'store']]);
        $this->middleware('permission:update news', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete news', ['only' => ['destroy']]);
        // $this->news = collect([]);
    }

    // protected function getNews()
    // {
    //     if ($this->news->isEmpty())
    //         $this->news = PagesContent::News()->get();
    //     return $this->news;
    // }

    // protected function refreshNews()
    // {
    //     $this->news = PagesContent::News()->get();
    //     return $this->news;
    // }

    public function index()
    {
        $news = PagesContent::News()->get();
        return view('AdminPanel.news.index', compact('news'));
    }

    public function create()
    {
        return view('AdminPanel.news.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        $request->merge(['type' => 'news']);
        $validated = $request->validate(PagesContent::rules());

        if ($request->hasFile('image'))
            $validated['image'] = $request->file('image');

        PagesContent::create($validated);
        flashy()->success(__('lang.created'));
        return redirect()->route('news.index');
    }

    public function edit(string $id)
    {
        $news = PagesContent::News()->findOrFail($id);
        return view('AdminPanel.news.edit', get_defined_vars());
    }

    public function update(Request $request, string $id)
    {
        $request->merge(['type' => 'news']);
        $validated = $request->validate(PagesContent::updaterules());
        $news = PagesContent::News()->findOrFail($id);
        if ($request->hasFile('image')) {
            $services = new Services();
            $path = Constants::PAGES_CONTENT_PATH->value;
            $services->removeFileFromUpload($news->image, $path);
            $validated['image'] = $request->file('image');
        }

        if (!empty($validated)) {
            $news->update($validated);
        }

        flashy()->success(__('lang.updated'));
        return redirect()->route('news.index');
    }


    public function destroy(string $id)
    {
        $news = PagesContent::News()->findOrFail($id);
        $services = new Services();
        $path = Constants::PAGES_CONTENT_PATH->value;
        $services->removeFileFromUpload($news->image, $path);
        // Delete the database record
        $news->delete();

        flashy()->success(__('lang.deleted'));
        return redirect()->route('news.index');
    }

    //TODOS: Start Api support
    public function newsApi()
    {
        $news = PagesContent::News()->get();
        if ($news->count() > 0)
            return $this->handleSuccess($news, 'news', 200);

        return $this->handleError('News not found', 404);
    }

    public function newsByIdApi(string $id)
    {
        $news = PagesContent::News()->where('id', $id)->get();
        return $this->handleSuccess($news, "news by id {$id}", 200);
    }
}
