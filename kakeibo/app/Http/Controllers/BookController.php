<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book; //追記

class BookController extends Controller
{
    function index() {
        //bookテーブルに入っているデータを全てとってくる
        $books = Book::all();
        //使うビューファイルを指定
        //compactにはビューファイルに送るデータを選択
        return view("books.index", compact("books"));
        //books.indexはビューファイル名。booksフォルダ内のindex.blade.phpを表す
        //compactの記述がないと$booksを画面に表示させることができない
    }

    function show(Book $book) {
        return view("books.show", compact("book"));
    }

    public function create() {
        return view("books.create");
    }

    public function store(Request $request){
        $book = new Book();
        $book->inout = $request->input("inout");
        $book->year = $request->input("year");
        $book->month = $request->input("month");
        $book->category = $request->input("category");
        $book->amount = $request->input("amount");
        $book->save();

        return redirect()->route('books.show', $book);
    }

    public function edit(Book $book) {
        return view("books.edit", compact("book"));
    }

    public function update(Request $request, Book $book) {
        $book->inout = $request->input("inout");
        $book->year = $request->input("year");
        $book->month = $request->input("month");
        $book->category = $request->input("category");
        $book->amount = $request->input("amount");
        $book->save();

        return redirect()->route("books.show", $book);
    }

    public function destroy(Book $book) {
        $book->delete();
        return redirect()->route("books.index");
    }
}
