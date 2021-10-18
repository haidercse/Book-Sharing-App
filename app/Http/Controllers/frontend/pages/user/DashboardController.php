<?php

namespace App\Http\Controllers\frontend\pages\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Use File;
Use Auth;
use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\BookAuthor;
use App\Models\BookRequest;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * use middleware ..
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if (!is_null($user)) {
            return view('frontend.pages.users.dashboard',compact('user'));
        }
        return redirect()->route('frontend.index')->with('error','You are not Logged in!');
    }

    public function books()
    {

        $user = Auth::user();

        if (!is_null($user)) {
            $books = $user->books;
            return view('frontend.pages.users.dashboard_book_list',compact('user','books'));
        }
        return redirect()->route('frontend.index')->with('error','You are not Logged in!');
    }

    /** user
     * Book Edit function
     */
    public function bookEdit($slug)
    {
        $book = Book::where('slug',$slug)->first();
        $publishers = Publisher::all();
        $categories = Category::all();
        $authors = Author::all();
        $books = Book::where('is_approved', 1)->where('slug', '!=', $slug)->get();
        return view('frontend.pages.users.edit',compact('publishers','categories','authors','book','books'));
    }


     /**
      * user
     * Book Update function
     */
    public function bookUpdate(Request $request,$slug)
    {
        $book = Book::where('slug', $slug)->first();

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

        ]);

        $book->title = $request->title;
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


        return redirect()->route('user.upload.book.list')->with('success','books has been added successfully!');
    }


     /**
      * user
     * Book Delete function
     */
    public function bookDelete($id)
    {
        $book = book::find($id);
        if(!is_null($book)){
            $book->delete();
        }


        return back()->with('success','book has been deleted successfully!');
    }
    public function bookRequest(Request $request,$slug)
    {
        $book = Book::where('slug', $slug)->first();
        $request->validate([
            'user_message'        => 'required|max:300',


        ]);
        if (!is_null($book)) {

            $book_request = new BookRequest();
            $book_request->book_id = $book->id;
            $book_request->user_id = Auth::id();
            $book_request->owner_id = $book->user_id;
            $book_request->status = 1;
            $book_request->user_message = $request->user_message;
            $book_request->save();

            return back()->with('success','Book has been requested to the user!');
        }
        else{
            return back()->with('error','No book Found!!');
        }

    }
    public function bookRequestApproved(Request $request,$request_id)
    {
        $book_request = BookRequest::find($request_id);
        if (!is_null($book_request)) {

            $book_request->status = 2; //confirm by owner
            $book_request->save();

            return back()->with('success','Book request has been approved!');
        }
        else{
            return back()->with('error','No book Found!!');
        }

    }
    public function bookRequestReject(Request $request,$request_id)
    {
        $book_request = BookRequest::find($request_id);
        if (!is_null($book_request)) {

            $book_request->status = 3; //reject by owner
            $book_request->save();

            return back()->with('success','Book rejected by owner  successfully!');
        }
        else{
            return back()->with('error','No book Found!!');
        }

    }
    public function bookUpdateRequest(Request $request,$request_id)
    {
        $book_request = BookRequest::find($request_id);
        $request->validate([
            'user_message'        => 'required|max:300',


        ]);
        if (!is_null($book_request)) {
            $book_request->user_message = $request->user_message;
            $book_request->save();

            return back()->with('success','Book has been Updated requested to the user!');
        }
        else{
            return back()->with('error','No book Found!!');
        }

    }

    public function bookDeleteRequest($id)
    {
        $book_request = BookRequest::find($id);
        if (!is_null($book_request)) {
            $book_request->delete();
        }
        return back()->with('success','Your Request cancel successfully!!');
    }

    public function showRequestBook($slug)
    {
        $book = Book::where('slug',$slug)->first();
        return view('frontend.pages.books.show',compact('book'));
    }
    public function bookRequestList()
    {
        $user = Auth::user();
        if (!is_null($user)) {
            $book_requests = BookRequest::where('owner_id', $user->id)->orderBy('id','desc')->get();
        }
        return view('frontend.pages.users.requestBook',compact('book_requests'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
