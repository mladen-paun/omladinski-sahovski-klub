<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrenerStoreRequest;
use App\Http\Requests\TrenerUpdateRequest;
use App\Models\Trener;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrenerController extends Controller
{
    public function index(Request $request)
    {
        $treners = Trener::all();

        return view('trener.index', [
            'treners' => $treners,
        ]);
    }

    public function create(Request $request)
    {
        return view('trener.create');
    }

    public function store(TrenerStoreRequest $request)
    {
        $trener = Trener::create($request->validated());

        $request->session()->flash('trener.id', $trener->id);

        return redirect()->route('treners.index');
    }

    public function show(Request $request, Trener $trener)
    {
        return view('trener.show', [
            'trener' => $trener,
        ]);
    }

    public function edit(Request $request, Trener $trener)
    {
        return view('trener.edit', [
            'trener' => $trener,
        ]);
    }

    public function update(TrenerUpdateRequest $request, Trener $trener)
    {
        $trener->update($request->validated());

        $request->session()->flash('trener.id', $trener->id);

        return redirect()->route('treners.index');
    }

    public function destroy(Request $request, Trener $trener)
    {
        $trener->delete();

        return redirect()->route('treners.index');
    }
}
