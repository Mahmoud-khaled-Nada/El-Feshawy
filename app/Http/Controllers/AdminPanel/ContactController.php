<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{

    // public function index()
    // {
    //     $contacts = Contact::all();
    //     return view('AdminPanel.contact.index', get_defined_vars());
    // }

    // public function create()
    // {
    //     return view('AdminPanel.contact.create', get_defined_vars());
    // }

    // public function store(Request $request)
    // {
    //     $contact = Contact::first();
    //     if ($contact)
    //         return $this->update($request, $contact->id);
    //     $validated = $request->validate(Contact::rules());
    //     Contact::create($validated);
    //     flashy()->success(__('lang.created'));
    //     return redirect()->route('contact.index');
    // }

    // public function edit(string $id)
    // {
    //     $contact = Contact::findOrFail($id);
    //     return view('AdminPanel.contact.edit', get_defined_vars());
    // }

    // public function update(Request $request, string $id)
    // {
    //     $validated = $request->validate(Contact::updaterules());
    //     $contact = Contact::findOrFail($id);

    //     if (!empty($validated)) {
    //         $contact->update($validated);
    //     }

    //     flashy()->success(__('lang.updated'));
    //     return redirect()->route('contact.index');
    // }

    // public function destroy(string $id)
    // {
    //     $contact = Contact::findOrFail($id);
    //     $contact->delete();
    //     flashy()->success(__('lang.deleted'));
    //     return redirect()->route('contact.index');
    // }

    // //TODOS: Start Api support

    // public function ContactUsApi()
    // {
    //     $contact = Contact::all();
    //     if ($contact->count() > 0)
    //         return $this->handleSuccess($contact, 'contact', 200);
    //     else
    //         return $this->handleError('Contact not found', 404);
    // }


    protected const CACHE_KEY_CONTACT = 'contact';
    protected const CACHE_EXPIRATION = 60; // in minutes

    public function index()
    {
        $contacts = $this->getCachedContacts();
        return view('AdminPanel.contact.index', compact('contacts'));
    }

    public function create()
    {
        return view('AdminPanel.contact.create');
    }

    public function store(Request $request)
    {
        $contact = Contact::first();

        if ($contact)
            return $this->update($request, $contact->id);

        $validated = $request->validate(Contact::rules());
        Contact::create($validated);

        // Clear cache after creating a contact
        $this->clearContactCache();

        flashy()->success(__('lang.created'));
        return redirect()->route('contact.index');
    }

    public function edit(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('AdminPanel.contact.edit', compact('contact'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate(Contact::updaterules());
        $contact = Contact::findOrFail($id);

        if (!empty($validated)) {
            $contact->update($validated);

            // Clear cache after updating a contact
            $this->clearContactCache();
        }

        flashy()->success(__('lang.updated'));
        return redirect()->route('contact.index');
    }

    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        // Clear cache after deleting a contact
        $this->clearContactCache();

        flashy()->success(__('lang.deleted'));
        return redirect()->route('contact.index');
    }

    // TODO: Start API support
    public function ContactUsApi()
    {
        $contacts = $this->getCachedContacts();
        if ($contacts->count() > 0) {
            return $this->handleSuccess($contacts, 'contact', 200);
        } else {
            return $this->handleError('Contact not found', 404);
        }
    }

    private function getCachedContacts()
    {
        return Cache::remember(self::CACHE_KEY_CONTACT, now()->addMinutes(self::CACHE_EXPIRATION), function () {
            return Contact::all();
        });
    }

    private function clearContactCache()
    {
        Cache::forget(self::CACHE_KEY_CONTACT);
    }
}
