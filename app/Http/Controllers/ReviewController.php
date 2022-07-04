<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product){
        
        $request->validate([
            'comment' => 'required|min:5',
            'rating' => 'required|min:1|max:5|integer'
        ]);

        $product->reviews()->create([
            'comment' => $request->comment,
            'rating' => $request->rating,
            'user_id' => auth()->id()
        ]); 

        session()->flash('flash.banner', 'Su reseña se agregó con éxito');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->back();

    }
}
