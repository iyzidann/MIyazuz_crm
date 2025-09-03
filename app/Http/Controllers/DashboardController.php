<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Customer;
use App\Models\Produk;
use App\Models\Proyek;

class DashboardController extends Controller
{
    public function index()
    {
        $leadCount = Lead::count();
        $produkCount = Produk::count();
        $proyekCount = Proyek::count();
        $customerCount = Customer::count();

        return view('dashboard', compact('leadCount', 'produkCount', 'proyekCount', 'customerCount'));
    }
}