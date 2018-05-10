<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\SaveBookRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{
    /*Middleware to restrict user to access to auth only pages*/
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Books=Book::all();
        return view('favourite',compact('Books'));
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
    public function store(SaveBookRequest $request)
    {
        //save book
        try {
            $request['user_id']=Auth::user()->id;
            Book::create($request->all());
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
        return 'The book has been saved!';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //if user is logged in
        if(Auth::check()){
            //user object
            $user=User::find(Auth::user()->id);
            //return boolean depending on whther an user has saved a book or not
            $saved=is_null($user->books->where('identifier','=',$id)->first()) ? 'Save' : 'Delete';
            return view('singlePage',compact('id','saved'));
        }
        //the user is not logged in
        return view('singlePage',compact('id'));
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
        if(Auth::check()){
            //user object
            $user=User::find(Auth::user()->id);
            //return boolean depending on whther an user has saved a book or not
            $Book_id=$user->books->where('identifier','=',$id)->first()->id;
            //delete the book or retur
            try {
                Book::destroy($Book_id);
            }
            catch (\Exception $e) {
                return $e->getMessage();
            }
            return 'The book has been deleted!';
        }
    }
}
