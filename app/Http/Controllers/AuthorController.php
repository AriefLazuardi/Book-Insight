<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function topauthor()
    {
        $authors = DB::table('books')
            ->join('ratings', 'books.rating_id', '=', 'ratings.id')
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->where('ratings.average_rating', '>', 5) // Filter hanya rating > 5
            ->select('authors.id', 'authors.name', DB::raw('SUM(ratings.voter) as total_voter'))
            ->groupBy('authors.id', 'authors.name')
            ->orderByDesc('total_voter')
            ->limit(10)
            ->get();

        return view('authors.top', compact('authors'));
    }
}
