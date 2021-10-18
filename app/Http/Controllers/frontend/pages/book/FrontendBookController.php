<?php

namespace App\Http\Controllers\frontend\pages\book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

Use File;
Use Auth;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\BookAuthor;

class FrontendBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('id','desc')->where('is_approved',1)->get();
        return view('frontend.pages.books.index',compact('books'));
    }

     /**
     * Display a listing of the resource.
     * search
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
       $searched = $request->search;
       if(empty($searched)){
           return $this->index();
       }
       $books = Book::orderBy('id','desc')->where('is_approved',1)->where('title', 'like', '%'.$searched.'%')
       ->orWhere('description', 'like', '%'.$searched.'%')
       ->get();

       foreach ($books as $book) {
           $book->increment('total_search');
           $book->save();
       }
        return view('frontend.pages.books.index',compact('books','searched'));
    }

    public function AdvancedSearch(Request $request)
    {
       $AdvancedSearched_title = $request->t;
       $AdvancedSearched_publisher = $request->p;
       $AdvancedSearched_category = $request->c;

       if(empty($AdvancedSearched_title && empty($AdvancedSearched_publisher) &&   empty($AdvancedSearched_category))){
           return $this->index();
       }

       if(empty($AdvancedSearched_title) && empty($AdvancedSearched_category) && !empty($AdvancedSearched_publisher)){
         $books = Book::orderBy('id','desc')->where('is_approved',1)
        ->Where('publisher_id', $AdvancedSearched_publisher)
        ->get();
       }

       elseif(empty($AdvancedSearched_title) && !empty($AdvancedSearched_category) && empty($AdvancedSearched_publisher)){
        $books = Book::orderBy('id','desc')->where('is_approved',1)
        ->Where('category_id', $AdvancedSearched_category)
        ->get();
       }
       else{
        $books = Book::orderBy('id','desc')->where('is_approved',1)->where('title', 'like', '%'.$searched.'%')
        ->orWhere('description', 'like', '%'.$searched.'%')
        ->orWhere('category_id', $AdvancedSearched_category)
        ->orWhere('publisher_id', $AdvancedSearched_publisher)
        ->get();
       }


       foreach ($books as $book) {
           $book->increment('total_search');
           $book->save();
       }
        return view('frontend.pages.books.index',compact('books','searched'));
    }

    public function recent_upload_book(){
      $books = Book::all();
      return view('frontend.pages.index',compact('books'));
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

        return view('frontend.pages.books.create',compact('publishers','categories','authors','books'));
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

        ]);

        $book = new book();
        $book->title = $request->title;
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
        $book->is_approved = 0;
        $book->quantity = $request->quantity;
        $book->user_id = Auth::id();

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


        return back()->with('success','books has been added successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $book = Book::where('slug', $slug)->get();
        if (!is_null($book)) {
            return view('frontend.pages.books.show',compact('book'));
        }
        return redirect()->route('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
