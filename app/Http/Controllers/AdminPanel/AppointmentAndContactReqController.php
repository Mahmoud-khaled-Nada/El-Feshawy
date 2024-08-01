<?php

namespace App\Http\Controllers\AdminPanel;

use App\Helpers\Constants;
use App\Helpers\Services;
use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AppointmentAndContactReqController extends Controller
{
    public function indexAppointment()
    {
        $appointments = ContactRequest::AppointmentType()->get();
        return view('AdminPanel.RequestWithMe.appointment_index', compact('appointments'));
    }
    public function indexContactUs()
    {
        $contactUs = ContactRequest::ContactUsType()->get();
        return view('AdminPanel.RequestWithMe.contactUs_index', compact('contactUs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(ContactRequest::rules());
        try {
            ContactRequest::create($validated);
            return $this->handleSuccess('', 'Your request has been successfully sent.', 200);
        } catch (\Exception $e) {
            return $this->handleException($e->getMessage(), 500);
        }
    }

    public function destroyAppointment($id)
    {
        try {
            $appointment = ContactRequest::AppointmentType()->findOrFail($id);
            if ($appointment->file) {
                $services = new Services();
                $path = Constants::CONTACT_REQUESTS_PATH->value;
                $services->removeFileFromUpload($appointment->file, $path);
            }

            $appointment->delete();
            flashy()->success(__('lang.deleted'));
            return redirect()->route('appointmentReq.index');
        } catch (\Exception $e) {
            flashy()->warning(__('lang.warning'));
            return redirect()->back();
        }
    }

    public function destroyContactUs($id)
    {
        try {
            $contact = ContactRequest::ContactUsType()->findOrFail($id);
            $contact->delete();
            flashy()->success(__('lang.deleted'));
            return redirect()->route('contactUsReq.index');
        } catch (\Exception $e) {
            flashy()->warning(__('lang.warning'));
            return redirect()->back();
        }
    }

    public function downloadFile(string $filename)
    {
        $path = $this->downloadFileRequest($filename);
        if (!$path) {
            return redirect()->back()->with('error', 'File not found.');
        }
        $headers = ['Content-Type' => 'application/octet-stream'];
        return response()->download($path, basename($path), $headers);
    }

    private function downloadFileRequest($filename)
    {
        $path = public_path(Constants::CONTACT_REQUESTS_PATH->value . '/' . $filename);

        if (!File::exists($path)) {
            return false;
        }

        return $path;
    }
}
