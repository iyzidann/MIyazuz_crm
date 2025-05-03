<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(5);
        return view('customer.index', compact('customers'));
    }

    public function destroy($id)
    {
        Customer::destroy($id);
        return redirect()->back()->with('success', 'Customer berhasil dihapus');
    }
}
