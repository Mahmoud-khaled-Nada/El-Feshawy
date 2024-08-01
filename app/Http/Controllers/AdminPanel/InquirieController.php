<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Traits\HandleApiResponse;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Inquirie;
use Illuminate\Http\Request;

class InquirieController extends Controller
{
    use HandleApiResponse;

    public function index()
    {
        $inquiries = Inquirie::with('customer')->orderBy('created_at')->paginate(10);
        return view('AdminPanel.inquiries.index', [
            'inquiries' => $inquiries ? $inquiries : [],
        ]);
    }

    public function create($customerId)
    {
        $employees = Employee::all();
        $customer = Customer::where('id', $customerId)->first();
        return view('AdminPanel.inquiries.create', [
            'customer' => $customer,
            'employees' => $employees,
        ]);
    }



    public function destroy(string $id)
    {
        $inquirie = Inquirie::findOrFail($id);
        $inquirie->delete();
        flashy()->success(__('lang.deleted'));
        return redirect()->route('inquiries.index');
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate(Inquirie::rules());
        $customerId = auth('customer')->user()->id;
        try {
            if ($customerId) {
                $validated['customer_id'] = $customerId;
                Inquirie::create($validated);
                return $this->handleSuccess('', 'Request sent successfully', 200);
            } else
                return $this->handleError('User not authenticated', 401);
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(Inquirie::rules());
        $inquirie = Inquirie::find($id);
        if (!$inquirie)
            return $this->handleError('Request not found', 404);
        try {
            $inquirie->update($validated);
            
            return $this->handleSuccess($inquirie, 'Request updated successfully', 200);
        } catch (\Exception $e) {
            return $this->handleError($e->getMessage(), 500);
        }
    }


}
