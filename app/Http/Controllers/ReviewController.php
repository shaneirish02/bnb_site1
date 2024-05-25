<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Models\Review;
use App\Models\User;
use App\Models\Book;

class ReviewController extends Controller {

    use ApiResponser;

    private $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function getReviews() {
        $reviews = Review::all();
        return response()->json($users, 200); 
    }

    /**
     * Return the list of reviews
     * @return Illuminate\Http\Response
     */
    public function index() {
        
        $reviews = Review::all();
        
        return $this->successResponse($reviews);
    }

    /**
     * Obtains and show one review
     * @return Illuminate\Http\Response
     */
    public function show($id) {

        $reviews = Review::findOrFail($id);

        return $this->successResponse($reviews);
    }

    public function add(Request $request) {

        $rules = [
            'user_id' => 'required|numeric|min:1|not_in:0',
            'book_id' => 'required|numeric|min:1|not_in:0',
            'rating' => 'required|numeric|max:5',
            'comment' => 'max:255',
        ];

        $this->validate($request, $rules);

        // validate if user_id exists in the User table
        $user = User::findOrFail($request->user_id);

        // validate if book_id exists in the Book table (in database2)
        $books = Book::findOrFail($request->book_id);

        $reviews = Review::create($request->all());

        return $this->successResponse($reviews, Response::HTTP_CREATED);
    }

    /**
     * Update an existing review
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $rules = [
            'user_id' => 'required|numeric|min:1|not_in:0',
            'book_id' => 'required|numeric|min:1|not_in:0',
            'rating' => 'numeric|max:5',
            'comment' => 'max:255',
        ];

        $this->validate($request, $rules);

        // validate if user_id exists in the User table
        $user = User::findOrFail($request->user_id);

        // validate if book_id exists in the Book table (in database2)
        $books = Book::findOrFail($request->book_id);

        $reviews = Review::findOrFail($id);
        
        $reviews->fill($request->all());

        // if no changes happen
        if ($reviews->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $reviews->save();

        return $this->successResponse($reviews);

    }

    public function delete($id) {

        $reviews = Review::findOrFail($id);
        $reviews->delete();
        return $this->successResponse($reviews);
    }
}