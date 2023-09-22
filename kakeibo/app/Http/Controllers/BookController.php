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
}
