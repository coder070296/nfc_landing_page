<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Visit;
use Illuminate\Http\Request;

class PublicCardController extends Controller
{
    public function show($slug)
    {
        $card = Card::where('slug',$slug)->firstOrFail();

        Visit::create([
            'card_id' => $card->id,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'referrer' => request()->headers->get('referer'),
            'created_at' => now(),
        ]);

        return inertia('Public/Card', [
            'card' => $card,
            'qrUrl' => route('card.public',$card->slug),
        ]);
    }
}
