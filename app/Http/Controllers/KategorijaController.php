<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategorijaStoreRequest;
use App\Http\Requests\KategorijaUpdateRequest;
use App\Models\Kategorija;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KategorijaController extends Controller
{
    public function index(Request $request)
    {
        $kategorijas = Kategorija::all();

        return view('kategorija.index', [
            'kategorijas' => $kategorijas,
        ]);
    }

    public function create(Request $request)
    {
        return view('kategorija.create');
    }

    public function store(KategorijaStoreRequest $request)
    {
        $kategorija = Kategorija::create($request->validated());

        $request->session()->flash('kategorija.id', $kategorija->id);

        return redirect()->route('kategorijas.index');
    }

    public function show(Request $request, Kategorija $kategorija)
    {
        return view('kategorija.show', [
            'kategorija' => $kategorija,
        ]);
    }

    public function edit(Request $request, Kategorija $kategorija)
    {
        return view('kategorija.edit', [
            'kategorija' => $kategorija,
        ]);
    }

    public function update(KategorijaUpdateRequest $request, Kategorija $kategorija)
    {
        $kategorija->update($request->validated());

        $request->session()->flash('kategorija.id', $kategorija->id);

        return redirect()->route('kategorijas.index');
    }

    public function destroy(Request $request, Kategorija $kategorija)
    {
        $kategorija->delete();

        return redirect()->route('kategorijas.index');
    }
}
