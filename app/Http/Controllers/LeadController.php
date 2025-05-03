<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {   
        $leads = Lead::with('proyek')->paginate(5);
        return view('lead.index', compact('leads'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'status' => 'required|in:new,negotiation,won,lost',
        ]);

        Lead::create([
            'nama' => $request->name,
            'email' => $request->email,
            'alamat' => $request->address,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Data calon customer berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'address' => 'required|string',
            'status' => 'required|in:new,negotiation,won,lost',
        ]);        

        $lead = Lead::findOrFail($id);
        $lead->update([
            'nama'   => $request->name,
            'email'  => $request->email,
            'alamat' => $request->address,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Data calon customer berhasil diperbarui');
    }

    public function destroy($id)
    {
        Lead::destroy($id);
        return redirect()->back()->with('success', 'Data lead berhasil dihapus');
    }
}
