<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book; //追記
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    //ログインしていない状態ではログイン画面へリダイレクト
    public function __construct() {
        $this->middleware('auth');
    }

    function index() {
        //bookテーブルに入っているデータを全てとってくる
        // $books = Book::all();
        //ログイン機能追加により、全てではなく自分のデータのみ取得するように変更
        $books = Auth::user()->books;
        //使うビューファイルを指定
        //compactにはビューファイルに送るデータを選択
        return view("books.index", compact("books"));
        //books.indexはビューファイル名。booksフォルダ内のindex.blade.phpを表す
        //compactの記述がないと$booksを画面に表示させることができない
    }

    function show(Book $book) {
        $this->checkMyData($book);
        return view("books.show", compact("book"));
    }

    public function create() {
        return view("books.create");
    }

    public function store(Request $request){
        $book = new Book();
        $book->fill($request->all());
        $book->user_id = Auth::user()->id;
        $book->save();

        return redirect()->route('books.index', $book);
    }

    public function edit(Book $book) {
        $this->checkMyData($book);
        return view("books.edit", compact("book"));
    }

    public function update(Request $request, Book $book) {
        $this->checkMyData($book);
        $book->fill($request->all());
        $book->save();

        return redirect()->route("books.show", $book);
    }

    public function destroy(Book $book) {
        $this->checkMyData($book);
        $book->delete();
        return redirect()->route("books.index");
    }

    private function checkMyData(Book $book) {
        if($book->user_id != Auth::user()->id) {
            return redirect()->route('books.index');
        }
    }
}
