<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class AdminEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function event(){
    //     return view('pages.admin.sponsorships',[
    //         'events' => Event::all(),
    //     ]);
    // }
    // public function product(string $slug)
    // {
    //     $product = Product::where('slug', $slug)->firstOrFail();
    //     return view('pages.product-page',compact('product'));
    // }
    public function index()
    {
        $events = Event::all();
        return view('pages.admin.events',compact('events'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'link'=>'required',
            'status' => 'required',
        ]);
        $create = Event::create($request->all());
        if ($create) {
            toast('Data berhasil ditambahkan!', 'success');
            return redirect()->route('admin.event');
        }else{
            toast('Gagal!', 'error');
            // return redirect()->route('admin.event');
        }

    }

    /**
     * Display the specified resource.
     */
    // public function show(string $slug)
    // {
    //     $product = Product::where('slug', $slug)->firstOrFail();
    //     return view('pages.admin.sponsorships',compact('product'));
    // }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $prod = Product::find($id);
        return view('admin.product.edit',compact('prod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'slug' => 'required',
            'image' => 'required',
            'desc' => 'required',
            'stock' => 'required',
            'size' => 'required',
            'price' => 'required',
        ]);
        $product->update($request->all());
     
        return redirect()->route('productadmin.index')->with('success','user created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Event::destroy($id);
        // return redirect()->route('pages.admin.events')->with('success','user deleted successfully');
        if ($delete) {
            toast('Data berhasil dihapus!', 'success');
            return redirect()->route('admin.event');
        }else{
            toast('Gagal', 'error');
            return redirect()->route('admin.event');
        }
    }
}
