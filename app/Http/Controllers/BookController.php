<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Category;
use Yajra\DataTables\DataTables;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $books = Book::with('category')->get();

        $datatables = Datatables::of($books)
            ->addColumn('action', function($book){
                return '<a class="btn btn-primary" href="'.route("books.edit", $book->id).'">Edit</a>
                <form action="'.route('books.destroy', $book->id).'" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger" >Delete</button>
                </form>
                <button class="changeStatus btn btn-success" data-bookid="'.$book->id.' }}" data-toggle="modal" data-target="#changeStatusModal">
                    Change status
                </button>';
            });

        return datatables()->of($datatables)
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data() {

    }
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'published_date' => 'required',
            'category_id' => 'required'
        ]);
        Book::create($request->all());

        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {   
        $categories = Category::all();
        return view('books.edit',compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {   
        
        
        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'published_date' => 'required',
            'category_id' => 'required',
        ]);

        $book->update($request->all());
        return redirect('home');
    }

    public function updateStatus(Request $request, $id)
    {   
        $book = Book::find($id);

        if(empty($request->user_id)){
            $book->user_id = NULL;
        } else {

            $book->user_id = $request->user_id;
        }

        $book->update();
        
        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('home')->with('success','Book deleted successfully');
    }

    public function dataTable() {
        $books = Book::with('category')->with('user')->get();

        $datatables = Datatables::of($books)
            ->addColumn('action', function($book){
                return '<a class="btn btn-primary" href="'.route("books.edit", $book->id).'">Edit</a>
                <form action="'.route('books.destroy', $book->id).'" method="POST">
                    <input type="hidden" name="_token" value="hbPyVzqvEwgHUZG8DKLix0mun1Oos4T4y5hhtj1s">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger" >Delete</button>
                </form>
                <button class="changeStatus btn btn-success" data-bookid="'.$book->id.'" data-toggle="modal" data-target="#changeStatusModal">
                    Change status
                </button>';
            })->addColumn('username', function($book){

                if(empty($book->user->id)){
                    return 'The book is available';
                }

                else{
                    return $book->user->name.' is reading the book';
                }      
                
            });;

        return $datatables
            ->make(true);
    }
}
