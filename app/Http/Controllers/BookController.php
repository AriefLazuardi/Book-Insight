<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class BookController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->get('limit', 10);
        $search = $request->get('search');

        $books = Book::with(['author', 'category', 'rating'])
            ->join('ratings', 'books.rating_id', '=', 'ratings.id')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('books.title', 'like', "%$search%")
                      ->orWhereHas('author', function ($q2) use ($search) {
                          $q2->where('name', 'like', "%$search%");
                      });
                });
            })
            ->orderByDesc('ratings.average_rating')
            ->select('books.*')
            ->paginate($limit)
            ->appends(['limit' => $limit, 'search' => $search]);

        return view('books.index', compact('books', 'limit', 'search'));
    }

    public function showForm()
    {
        $authors = Author::all();
        return view('books.rating', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'author_id' => 'required|exists:authors,id',
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        $book = Book::findOrFail($request->book_id);
        $rating = $book->rating;

        $totalVotes = $rating->voter + 1;
        $newAverage = (($rating->average_rating * $rating->voter) + $request->rating) / $totalVotes;

        $success = $rating->update([
            'voter' => $totalVotes,
            'average_rating' => $newAverage
        ]);

        if ($success) {
            Log::info('Rating updated successfully.', [
                'book_id' => $book->id,
                'book_title' => $book->title,
                'author_id' => $book->author_id,
                'new_rating' => $request->rating,
                'new_average' => $newAverage,
                'total_votes' => $totalVotes,
            ]);
        } else {
            Log::error('Failed to update rating.', [
                'book_id' => $book->id,
            ]);
        }

        return redirect()->route('books.index')->with('success', 'Rating submitted successfully.');
    }


    public function searchBooks(Request $request)
    {
        $term = $request->get('q');

        $books = Book::with('author')
            ->where('title', 'like', '%' . $term . '%')
            ->limit(10)
            ->get();

        return response()->json($books->map(function ($book) {
            return [
                'id' => $book->id,
                'text' => "{$book->title} by {$book->author->name}",
            ];
        }));
    }

    public function getBooksByAuthor($authorId)
    {
        $books = Book::where('author_id', $authorId)->get(['id', 'title']);
        return response()->json($books);
    }
}
