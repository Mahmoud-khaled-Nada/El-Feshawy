<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\PageRequest;
use App\Http\Traits\HandleApiResponse;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    //     public function __construct()
    //     {
    //         $this->middleware('permission:view pages')->only('index');
    //         $this->middleware('permission:update pages')->only('edit', 'update');
    //     }

    //     public function index()
    //     {
    //         $pages = Page::orderBy('created_at', 'asc')->get();
    //         return view('AdminPanel.pages.index', get_defined_vars());
    //     }

    //     public function edit(Page $page)
    //     {
    //         return view('AdminPanel.pages.edit', get_defined_vars());
    //     }


    //     public function update(PageRequest $request, Page $page)
    //     {
    //         $page->update($request->validated());
    //         flashy()->success(__('lang.updated'));
    //         return redirect()->route('pages.index');
    //     }


    //     //TODO: Support Api
    //     public function pagesApi()
    //     {
    //         $page = Page::all();
    //         if ($page->count() > 0)
    //             return $this->handleSuccess($page, 'page', 200);
    //         else
    //             return $this->handleError('Page not found', 404);
    //     }




    protected const CACHE_KEY_PAGES = 'pages';
    protected const CACHE_EXPIRATION = 60; // in minutes

    public function __construct()
    {
        $this->middleware('permission:view pages')->only('index');
        $this->middleware('permission:update pages')->only('edit', 'update');
    }

    public function index()
    {
        $pages = $this->getCachedPages();
        return view('AdminPanel.pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        return view('AdminPanel.pages.edit', compact('page'));
    }

    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->validated());

        // Clear cache after updating a page
        $this->clearPagesCache();

        flashy()->success(__('lang.updated'));
        return redirect()->route('pages.index');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        // Clear cache after deleting a page
        $this->clearPagesCache();

        flashy()->success(__('lang.deleted'));
        return redirect()->route('pages.index');
    }

    // TODO: Support API
    public function pagesApi()
    {
        $pages = $this->getCachedPages();
        if ($pages->count() > 0) {
            return $this->handleSuccess($pages, 'Pages retrieved successfully', 200);
        } else {
            return $this->handleError('Pages not found', 404);
        }
    }

    private function getCachedPages()
    {
        return Cache::remember(self::CACHE_KEY_PAGES, now()->addMinutes(self::CACHE_EXPIRATION), function () {
            return Page::orderBy('created_at', 'asc')->get();
        });
    }

    private function clearPagesCache()
    {
        Cache::forget(self::CACHE_KEY_PAGES);
    }
}
