<?php

namespace App\Http\Controllers\admin\books;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\BookAuthor;

class BookController extends Controller
{
    /**php artisan serve
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('id','desc')->get();
        return view('backend.pages.books.index',compact('books'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unapprovedList()
    {
        $books = Book::orderBy('id','desc')->where('is_approved', 0)->get();
        $approved = false;
        return view('backend.pages.books.index',compact('books','approved'));
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request,$id)
    {
       $approved = Book::find($id);
       $approved->is_approved = 1;
       $approved->save();
        return redirect()->route('book-sharing.index')->with('success','Data has been approved successfully!!');
    }
//un
 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approvedList()
    {
        $books = Book::orderBy('id','desc')->where('is_approved', 1)->get();
        $approved = true;
        return view('backend.pages.books.index',compact('books','approved'));
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unapproved(Request $request,$id)
    {
       $approved = Book::find($id);
       $approved->is_approved = 0;
       $approved->save();
        return redirect()->route('book-sharing.index')->with('success','Data has been Unapproved successfully!!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $publishers = Publisher::all();
        $categories = Category::all();
        $authors = Author::all();
        $books = Book::where('is_approved', 1)->get();
        return view('backend.pages.books.create',compact('publishers','categories','authors','books'));

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
            'title'        => 'required|max:255',
            'isbn'         => 'required|max:255',
            'slug'         => 'nullable|unique:books',
            'description'  => 'nullable|min:5',
            'image'        => 'required|image',
            'category_id'  => 'required',
            'publisher_id' => 'required',
            'publish_year' => 'required',
            'translator_id'=> 'nullable',
            'quantity'     => 'required|min:1|numeric',

        ]);

        $book = new book();
        $book->title = $request->title;
        $book->quantity = $request->quantity;
        $book->publish_year = $request->publish_year;
        $book->isbn = $request->isbn;
        $book->category_id = $request->category_id;
        $book->publisher_id = $request->publisher_id;
        $book->translator_id = $request->translator_id;
        if(empty($request->slug)){
            $book->slug = Str::slug($request->title);
        }
        else{
           $book->slug = $request->slug;
        }

        $book->description = $request->description;
        $book->quantity = $request->quantity;
        $book->is_approved = 1;
        $book->user_id = 1;

        //Book model insert image
        if($request->has('image')){
            $image = $request->file('image');
            $reImage = time().'.'.$image->getClientOriginalExtension();
            $dest = public_path('/images/book');
            $image->move($dest,$reImage);

            //now save in database
            $book->image = $reImage;

          }
        $book->save();

        //book authors

        foreach ($request->author_ids as $author_id) {
            $book_author = new BookAuthor();
            $book_author->book_id = $book->id;
            $book_author->author_id = $author_id;
            $book_author->save();
        }


        return redirect()->route('book-sharing.index')->with('success','books has been added successfully!');
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
    public function edit($id)
    {
        $book = Book::find($id);
        $publishers = Publisher::all();
        $categories = Category::all();
        $authors = Author::all();
        $books = Book::where('is_approved', 1)->where('id', '!=', $id)->get();
        return view('backend.pages.books.edit',compact('publishers','categories','authors','book','books'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        $request->validate([
            'title'        => 'required|max:255',
            'isbn'         => 'required|max:255',
            'slug'         => 'nullable|unique:books,slug,'.$book->id,
            'description'  => 'nullable|min:5',
            'image'        => 'nullable|image',
            'category_id'  => 'required',
            'publisher_id' => 'required',
            'publish_year' => 'required',
            'translator_id'=> 'nullable',
            'quantity'     => 'required|min:1|numeric',

        ]);

        $book->title = $request->title;
        $book->quantity = $request->quantity;
        $book->publish_year = $request->publish_year;
        $book->isbn = $request->isbn;
        $book->category_id = $request->category_id;
        $book->publisher_id = $request->publisher_id;
        $book->translator_id = $request->translator_id;
        $book->quantity = $request->quantity;
        if(empty($request->slug)){
            $book->slug = Str::slug($request->title);
        }
        else{
           $book->slug = $request->slug;
        }

        $book->description = $request->description;


        //Book model insert image
        if($request->has('image')){

            // delete old image
            if(File::exists('images/book/'.$book->image)){
                File::delete('images/book/'.$book->image);
            }

            $image = $request->file('image');
            $reImage = time().'.'.$image->getClientOriginalExtension();
            $dest = public_path('/images/book');
            $image->move($dest,$reImage);

            //now save in database
            $book->image = $reImage;

          }
        $book->save();

        //book authors
        //delete old authors table data
        $book_authors = BookAuthor::where('book_id', $book->id)->get();
        foreach ($book_authors as $book_author) {
            $book_author->delete();
        }
        foreach ($request->author_ids as $author_id) {
            $book_author = new BookAuthor();
            $book_author->book_id = $book->id;
            $book_author->author_id = $author_id;
            $book_author->save();
        }


        return redirect()->route('book-sharing.index')->with('success','books has been added successfully!');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = book::find($id);
        if(!is_null($book)){
            $book->delete();
        }


        return back()->with('success','book has been deleted successfully!');
    }
}
