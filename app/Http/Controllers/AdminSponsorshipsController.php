<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SponsorshipService;
use App\Models\sponsorship_categori;
use App\Models\Sponsorships;

class AdminSponsorshipsController extends Controller
{
    public function index(SponsorshipService $sponsorshipService)
    {
       $sponsorshipscategoriesdata = sponsorship_categori::get();
        $sponsorships = $sponsorshipService->getData();
        return view('pages.admin.sponsorship.sponsorships',compact('sponsorships','sponsorshipscategoriesdata'));
    }
    public function store(Request $request,SponsorshipService $sponsorshipService)
    {
        $store=$sponsorshipService->store($request);   
        if ($store=='1') {
            toast('Data berhasil ditambahkan!', 'success');
            return redirect()->back();
        }else{
            toast('Gagal!', 'error');
            return redirect()->back();
        }
    }

    public function edit(SponsorshipService $sponsorshipService,$id){
        $sponsorshipscategoriesdata = sponsorship_categori::get();
        $sponsorships= $sponsorshipService->getWhere($id)->first();
       return view('pages.admin.sponsorship.editsponsorship',compact('sponsorships','sponsorshipscategoriesdata'));
    }

    public function update(Request $request, $id)
    {   
        $sponsorship = Sponsorships::findOrFail($id);
        
        $sponsorship->name = $request->name;
        $sponsorship->id_sponsorship_categori = $request->id_sponsorship_categori;

        if ($request->hasFile('logo')) {
            $sponsorship->logo = $this->uploadLogo($request);
        }

        if ($sponsorship->save()) {
            return redirect()->route('admin.sponsorship')->with('success', 'Data sponsorship berhasil diubah.');
        }

        return redirect()->back()->with('error', 'Gagal mengubah data sponsorship.');
    }

    public function destroy($id, SponsorshipService $sponsorshipService)
    {
        try {
            $sponsorship = $sponsorshipService->getWhere($id)->firstOrFail();

            if ($sponsorship->logo) {
                Storage::disk('local')->delete($sponsorship->logo);
            }

            $sponsorshipService->destroy($id);

            toast('Data berhasil dihapus!', 'success');
            return redirect()->route('admin.sponsorship');
        } catch (\Exception $e) {
            toast('Gagal menghapus data: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }
}
