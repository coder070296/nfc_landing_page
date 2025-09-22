<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function dashboard()
    {
        $cards = auth()->user()->cards()->withCount('visits')->get();
        return inertia('Dashboard/Index', compact('cards'));
    }

    public function index()
    {
        $cards = auth()->user()->cards()->paginate(10);
        return inertia('Cards/Index', compact('cards'));
    }

    public function create()
    {
        return inertia('Cards/Form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => 'required|alpha_dash|unique:cards,slug',
            'display_name' => 'required|max:120',
            'title' => 'nullable|max:120',
            'bio' => 'nullable|max:1000',
            'website' => 'nullable|url',
        ]);

        auth()->user()->cards()->create($data);

        return redirect()->route('cards.index')->with('success','Card created');
    }

    public function edit(Card $card)
    {
        $this->authorize('update', $card);
        return inertia('Cards/Form', ['card' => $card]);
    }

    public function update(Request $request, Card $card)
    {
        $this->authorize('update', $card);

        $data = $request->validate([
            'display_name' => 'required|max:120',
            'title' => 'nullable|max:120',
            'bio' => 'nullable|max:1000',
            'website' => 'nullable|url',
        ]);

        $card->update($data);

        return back()->with('success','Card updated');
    }

    public function destroy(Card $card)
    {
        $this->authorize('delete', $card);
        $card->delete();
        return redirect()->route('cards.index');
    }
}
