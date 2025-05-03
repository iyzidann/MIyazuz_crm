<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\Produk;
use App\Models\Proyek;
use Illuminate\Http\Request;

class ProyekController extends Controller
{
    public function index()
    {
        $projects = Proyek::with(['lead', 'produk'])->paginate(5);
        $leads = Lead::all();
        $products = Produk::all();
        
        return view('proyek.index', compact('projects', 'leads', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lead_id' => 'required|exists:lead,id',
            'produk_id' => 'required|exists:produk,id',
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        Proyek::create([
            'lead_id' => $request->lead_id,
            'produk_id' => $request->produk_id,
            'status' => $request->status,
        ]);

        return redirect()->back()
            ->with('success', 'Project berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lead_id' => 'required|exists:lead,id',
            'produk_id' => 'required|exists:produk,id',
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $project = Proyek::findOrFail($id);
        $project->update([
            'lead_id' => $request->lead_id,
            'produk_id' => $request->produk_id,
            'status' => $request->status,
        ]);

        return redirect()->back()
            ->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $project = Proyek::findOrFail($id);
        $project->delete();
        
        return redirect()->back()
            ->with('success', 'Project berhasil dihapus!');
    }

    public function approval(Request $request, Proyek $proyek)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);
        
        $status = $request->status;
        $proyek->status = $status;
        $proyek->save();
        
        $lead = $proyek->lead;
        if ($lead) {
            $lead->status = ($status === 'accepted') ? 'won' : 'lost';
            $lead->save();
        }

        if ($status === 'accepted') {
            // Get the lead data
            $lead = Lead::find($proyek->lead_id);
            
            $existingCustomer = Customer::where('email', $lead->email)->first();
            
            if (!$existingCustomer) {
                Customer::create([
                    'nama' => $lead->nama,
                    'email' => $lead->email,
                    'alamat' => $lead->alamat,
                    'produk_id' => $proyek->produk_id,
                    'project_id' => $proyek->id
                ]);
            }
        }
        
        return redirect()->back()->with('success', 'Project berhasil ' . ($status === 'accepted' ? 'disetujui' : 'ditolak'));
    }
}
