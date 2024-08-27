<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        $tags = $request->query('tags', []);
        $links = Link::where(function ($query) use ($tags) {
            foreach ($tags as $tag) {
                $query->where('tags', 'like', '%' . $tag . '%');
            }
        })->get();

        return response()->json($links);
    }
}
