<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with([
            'inquiry' => function ($query) {
                $query->select('customer_id', 'second_phone');
            }
        ])->paginate(15);
        return view('AdminPanel.customers.index', get_defined_vars());
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        flashy()->success(__('lang.deleted'));
        return redirect()->route('customers.index');
    }
}