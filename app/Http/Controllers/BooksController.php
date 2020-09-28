<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    //
    public function store(){

        $data=$this->input_validation();
        Book::create($data);
    }

    public function update(Book $book)
    {

        $data=$this->input_validation();
        $book->update($data);
    }

    protected function input_validation()
    {
        return request()->validate(
        [
            'title'=>'required',
            'author'=>'required',
        ] );
    }
}