<?php

namespace App\Http\Controllers\AdminPanel;

use App\Helpers\Constants;
use App\Helpers\Services;
use App\Http\Controllers\Controller;
use App\Http\Traits\HandleApiResponse;
use App\Models\PagesContent;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{

    public function index()
    {
        $getAboutus =  PagesContent::AboutUs()->get();
        return view('AdminPanel.aboutus.index', compact('getAboutus'));
    }

    public function create()
    {
        return view('AdminPanel.aboutus.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        $request->merge(['type' => 'about_us']);
        $validated = $request->validate(PagesContent::rules());

        if ($request->hasFile('image'))
            $validated['image'] = $request->file('image');

        PagesContent::create($validated);
        flashy()->success(__('lang.created'));
        return redirect()->route('aboutus.index');
    }


    public function edit(string $id)
    {
        $aboutus = PagesContent::AboutUs()->findOrFail($id);
        return view('AdminPanel.aboutus.edit', compact('aboutus'));
    }


    public function update(Request $request, string $id)
    {
        $request->merge(['type' => 'about_us']);
        $validated = $request->validate(PagesContent::updaterules());

        $aboutus = PagesContent::AboutUs()->findOrFail($id);

        if ($request->hasFile('image')) {
            $services = new Services();
            $path = Constants::PAGES_CONTENT_PATH->value;
            $services->removeFileFromUpload($aboutus->image, $path);
            $validated['image'] = $request->file('image');
        }

        if (!empty($validated))
            $aboutus->update($validated);


        flashy()->success(__('lang.updated'));
        return redirect()->route('aboutus.index');
    }


    public function destroy(string $id)
    {
        $about = PagesContent::aboutUs()->findOrFail($id);
        $services = new Services();
        $path = Constants::PAGES_CONTENT_PATH->value;
        $services->removeFileFromUpload($about->image, $path);

        // Delete the database record
        $about->delete();

        flashy()->success(__('lang.deleted'));
        return redirect()->route('aboutus.index');
    }

    //TODOS: Start Api support

    public function aboutUsApi()
    {
        $about =  PagesContent::AboutUs()->get();
        if ($about->count() > 0)
            return $this->handleSuccess($about, 'About page', 200);
        else
            return $this->handleError('AboutUs not found', 404);
    }
}
