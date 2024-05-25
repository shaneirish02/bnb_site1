<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Models\Library;
use App\Models\User;
use App\Models\Book;

class LibraryController extends Controller {

    use ApiResponser;

    private $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Return the list of libraries
     * @return Illuminate\Http\Response
     */
    public function index() {
        
        $libraries = Library::all();
        
        return $this->successResponse($libraries);
    }

    /**
     * Obtains and show one library
     * @return Illuminate\Http\Response
     */
    public function show($id) {

        $libraries = Library::findOrFail($id);

        return $this->successResponse($libraries);
    }

    public function add(Request $request) {

        $rules = [
            'user_id' => 'required|numeric|min:1|not_in:0',
            'book_id' => 'required|numeric|min:1|not_in:0',
        ];

        $this->validate($request, $rules);

        // validate if user_id exists in the User table
        $user = User::findOrFail($request->user_id);

        // validate if book_id exists in the Book table (in database2)
        $books = Book::findOrFail($request->book_id);

        $libraries = Library::create($request->all());

        return $this->successResponse($libraries, Response::HTTP_CREATED);
    }

    /**
     * Update an existing library
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $rules = [
            'user_id' => 'required|numeric|min:1|not_in:0',
            'book_id' => 'required|numeric|min:1|not_in:0',
        ];

        $this->validate($request, $rules);

        // validate if user_id exists in the User table
        $user = User::findOrFail($request->user_id);

        // validate if book_id exists in the Book table (in database2)
        $books = Book::findOrFail($request->book_id);

        $libraries = Library::findOrFail($id);
        
        $libraries->fill($request->all());

        // if no changes happen
        if ($libraries->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $libraries->save();

        return $this->successResponse($libraries);

    }

    public function delete($id) {

        $libraries = Library::findOrFail($id);
        $libraries->delete();
        return $this->successResponse($libraries);
    }
}