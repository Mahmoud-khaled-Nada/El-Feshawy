<?php

namespace App\Http\Controllers\AdminPanel;

use App\Helpers\Constants;
use App\Helpers\Formater;
use App\Helpers\Services;
use App\Http\Controllers\Controller;
use App\Models\PagesContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OurPeopleController extends Controller
{

    protected const CACHE_KEY = 'our_people';
    protected const CACHE_EXPIRATION = 60; // in minutes

    public function index()
    {
        $peoples = $this->fetchCachedPeople();
        return view('AdminPanel.ourpeople.index', compact('peoples'));
    }

    public function create()
    {
        return view('AdminPanel.ourpeople.create');
    }

    public function store(Request $request)
    {
        $request->merge(['type' => 'our_people']);
        $validated = $request->validate(PagesContent::rules());

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image');
        }

        PagesContent::create($validated);
        $this->clearPeopleCache();
        flashy()->success(__('lang.created'));
        return redirect()->route('people.index');
    }

    public function edit($id)
    {
        $people = PagesContent::OurPeople()->findOrFail($id);
        return view('AdminPanel.ourpeople.edit', compact('people'));
    }

    public function update(Request $request, $id)
    {
        $request->merge(['type' => 'our_people']);
        $validated = $request->validate(PagesContent::updaterules());
        $people = PagesContent::OurPeople()->findOrFail($id);

        if ($request->hasFile('image')) {
            $services = new Services();
            $path = Constants::PAGES_CONTENT_PATH->value;
            $services->removeFileFromUpload($people->image, $path);
            $validated['image'] = $request->file('image');
        }

        if (!empty($validated)) {
            $people->update($validated);
            $this->clearPeopleCache();
        }

        flashy()->success(__('lang.updated'));
        return redirect()->route('people.index');
    }

    public function destroy(string $id)
    {
        $people = PagesContent::OurPeople()->findOrFail($id);

        if ($people->image) {
            $services = new Services();
            $path = Constants::PAGES_CONTENT_PATH->value;
            $services->removeFileFromUpload($people->image, $path);
        }

        $people->delete();
        $this->clearPeopleCache();

        flashy()->success(__('lang.deleted'));
        return redirect()->route('people.index');
    }


    public function peopleApi()
    {
        $people = $this->fetchCachedPeople();

        if ($people->isEmpty())
            return $this->handleError('Our People not found', 404);

        // Group people by their job titles
        $groupedPeopleByTitle = $people->groupBy('title');

        $formatter = new Formater();
        $sortedPeopleByTitle = $formatter->formatByJobTitles($groupedPeopleByTitle);

        return $this->handleSuccess($sortedPeopleByTitle, 'people', 200);
    }

    public function personApi(string $id)
    {
        $person = PagesContent::OurPeople()->find($id);

        if ($person) {
            return $this->handleSuccess($person, 'person', 200);
        }

        return $this->handleError('Person not found', 404);
    }

    private function fetchCachedPeople()
    {
        return Cache::remember(self::CACHE_KEY, now()->addMinutes(self::CACHE_EXPIRATION), function () {
            return PagesContent::OurPeople()->get();
        });
    }

    private function clearPeopleCache()
    {
        Cache::forget(self::CACHE_KEY);
    }
}
