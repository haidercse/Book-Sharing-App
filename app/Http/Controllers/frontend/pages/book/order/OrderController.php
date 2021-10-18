<?php

namespace App\Http\Controllers\frontend\pages\book\order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\BookAuthor;
use App\Models\BookRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if (!is_null($user)) {
            $book_orders = BookRequest::where('user_id', $user->id)->orderBy('id','desc')->get();
            return view('frontend.pages.users.orders_book',compact('book_orders'));
        }

    }

    public function orderApproved(Request $request,$request_id)
    {
        $book_request = BookRequest::find($request_id);
        if (!is_null($book_request)) {

            $book_request->status = 2; //confirm by user
            $book_request->save();
            $book = Book::find($book_request->book_id);
            $book->decrement('quantity');

            return back()->with('success','Book order has been confirm!');
        }
        else{
            return back()->with('error','No book Found!!');
        }

    }
    public function orderReject(Request $request,$request_id)
    {
        $book_request = BookRequest::find($request_id);
        if (!is_null($book_request)) {

            $book_request->status = 5; //reject by user
            $book_request->save();

            return back()->with('success','Book order rejected by user  successfully!');
        }
        else{
            return back()->with('error','No book Found!!');
        }

    }

    public function orderReturnStore(Request $request,$request_id)
    {
        $book_request = BookRequest::find($request_id);
        if (!is_null($book_request)) {

            $book_request->status = 6; //return by user
            $book_request->save();


            return back()->with('success','Book order has been return!');
        }
        else{
            return back()->with('error','No book Found!!');
        }

    }

    public function orderReturnConfirm(Request $request,$request_id)
    {
        $book_request = BookRequest::find($request_id);
        if (!is_null($book_request)) {

            $book_request->status = 7; //return by owner
            $book_request->save();

            $book = Book::find($book_request->book_id);
            $book->increment('quantity');

            return back()->with('success','Book order has been return successfully!');
        }
        else{
            return back()->with('error','No book Found!!');
        }

    }
    /**orderReject
     * orderReturnConfirm
     * orderApproved
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
