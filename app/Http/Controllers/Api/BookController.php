<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Book::orderBy('title')->get();
        return response()->json([
            'status' => true,
            'message' => 'Book data found',
            'book' => $book
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book();

        $rules = [
            'title' => 'required',
            'author' => 'required',
            'publish' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => true,
                'message' => 'Book data has been entered fialed',
                'data' => $validator->errors()
            ]);
        }

        $book->title = $request->title;
        $book->author = $request->author;
        $book->publish = $request->publish;

        $post = $book->save();

        return response()->json([
                'status' => true,
                'message' => 'Book data has been entered successfully',
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        if($book){
            return response()->json([
                'status' => true,
                'message' => 'Book data found',
                'book' => $book
            ], 200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Book data not found',
            ]);   
        }
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
        $book =  Book::find($id);

        if(empty($book)){
            return response()->json([
                'status' => false,
                'message' => 'Book data not found',
            ], 404);   
        }

        $rules = [
            'title' => 'required',
            'author' => 'required',
            'publish' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => true,
                'message' => 'Book data has been updated fialed',
                'data' => $validator->errors()
            ]);
        }

        $book->title = $request->title;
        $book->author = $request->author;
        $book->publish = $request->publish;

        $post = $book->save();

        return response()->json([
                'status' => true,
                'message' => 'Book data has been updated successfully',
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $book =  Book::find($id);

        if(empty($book)){
            return response()->json([
                'status' => false,
                'message' => 'Book data not found',
            ], 404);   
        }

        $post = $book->delete();

        return response()->json([
                'status' => true,
                'message' => 'Book data has been delete successfully',
            ]);
    }
}
