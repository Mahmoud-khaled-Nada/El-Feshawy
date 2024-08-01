<?php

namespace App\Http\Controllers\AdminPanel;

use App\Helpers\Constants;
use App\Helpers\Services;
use App\Http\Controllers\Controller;
use App\Http\Traits\HandleApiResponse;
use App\Models\PagesContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ServiceController extends Controller
{

    // public function index()
    // {
    //     $services =  PagesContent::Services()->get();
    //     return view('AdminPanel.services.index', get_defined_vars());
    // }

    // public function create()
    // {
    //     return view('AdminPanel.services.create', get_defined_vars());
    // }

    // public function store(Request $request)
    // {
    //     $request->merge(['type' => 'services']);
    //     $validated = $request->validate(PagesContent::rules());
    //     PagesContent::create($validated);
    //     flashy()->success(__('lang.created'));
    //     return redirect()->route('services.index');
    // }

    // public function edit($id)
    // {
    //     $service = PagesContent::Services()->findOrFail($id);
    //     return view('AdminPanel.services.edit', get_defined_vars());
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->merge(['type' => 'services']);
    //     $validated = $request->validate(PagesContent::updaterules());
    //     $service = PagesContent::Services()->findOrFail($id);


    //     if ($request->hasFile('image')) {
    //         $services = new Services();
    //         $path = Constants::PAGES_CONTENT_PATH->value;
    //         $services->removeFileFromUpload($service->image, $path);
    //         $validated['image'] = $request->file('image');
    //     }

    //     if (!empty($validated))
    //         $service->update($validated);



    //     flashy()->success(__('lang.updated'));
    //     return redirect()->route('services.index');
    // }


    // public function destroy(string $id)
    // {
    //     $service = PagesContent::Services()->findOrFail($id);
    //     $services = new Services();
    //     $path = Constants::PAGES_CONTENT_PATH->value;
    //     $services->removeFileFromUpload($service->image, $path);
    //     // Delete the database record
    //     $service->delete();
    //     flashy()->success(__('lang.deleted'));
    //     return redirect()->route('services.index');
    // }

    // //TODOS: Start Api support

    // public function servicesApi()
    // {
    //     $services = PagesContent::Services()->get();
    //     if ($services->count() > 0)
    //         return $this->handleSuccess($services, 'services', 200);
    //     else
    //         return $this->handleError('Services not found', 404);
    // }



    protected const CACHE_KEY_SERVICES = 'services';
    protected const CACHE_EXPIRATION = 60; // in minutes

    public function index()
    {
        $services = $this->getCachedServices();
        return view('AdminPanel.services.index', compact('services'));
    }

    public function create()
    {
        return view('AdminPanel.services.create');
    }

    public function store(Request $request)
    {
        $request->merge(['type' => 'services']);
        $validated = $request->validate(PagesContent::rules());
        PagesContent::create($validated);

        // Clear cache after creating a new service
        $this->clearServicesCache();

        flashy()->success(__('lang.created'));
        return redirect()->route('services.index');
    }

    public function edit($id)
    {
        $service = PagesContent::Services()->findOrFail($id);
        return view('AdminPanel.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->merge(['type' => 'services']);
        $validated = $request->validate(PagesContent::updaterules());
        $service = PagesContent::Services()->findOrFail($id);

        if ($request->hasFile('image')) {
            $services = new Services();
            $path = Constants::PAGES_CONTENT_PATH->value;
            $services->removeFileFromUpload($service->image, $path);
            $validated['image'] = $request->file('image');
        }

        if (!empty($validated)) {
            $service->update($validated);

            // Clear cache after updating a service
            $this->clearServicesCache();
        }

        flashy()->success(__('lang.updated'));
        return redirect()->route('services.index');
    }

    public function destroy(string $id)
    {
        $service = PagesContent::Services()->findOrFail($id);
        $services = new Services();
        $path = Constants::PAGES_CONTENT_PATH->value;
        $services->removeFileFromUpload($service->image, $path);

        // Delete the database record
        $service->delete();

        // Clear cache after deleting a service
        $this->clearServicesCache();

        flashy()->success(__('lang.deleted'));
        return redirect()->route('services.index');
    }

    // TODO: Start API support
    public function servicesApi()
    {
        $services = $this->getCachedServices();
        if ($services->count() > 0) {
            return $this->handleSuccess($services, 'services', 200);
        } else {
            return $this->handleError('Services not found', 404);
        }
    }

    private function getCachedServices()
    {
        return Cache::remember(self::CACHE_KEY_SERVICES, now()->addMinutes(self::CACHE_EXPIRATION), function () {
            return PagesContent::Services()->get();
        });
    }

    private function clearServicesCache()
    {
        Cache::forget(self::CACHE_KEY_SERVICES);
    }
}
