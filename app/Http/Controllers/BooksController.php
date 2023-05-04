<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Book::create($this->validateRequest());
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Book $book)
    {
        $book->update($this->validateRequest());
    }


    public function destroy(string $id)
    {
        //
    }

    protected function validateRequest()
    {
        return request()->validate([
            'title'  =>  'required',
            'author'  =>  'required',
        ]);
    }
}
