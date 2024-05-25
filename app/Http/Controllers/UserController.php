<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Models\User;

class UserController extends Controller {

    use ApiResponser;

    private $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function getUsers() {
        $users = User::all();
        return response()->json($users, 200); 
    }

    /**
     * Return the list of users
     * @return Illuminate\Http\Response
     */
    public function index() {
        $users = User::all();
        return $this->successResponse($users);
    }

    public function add(Request $request) {
        
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $user = User::create($request->all());

        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    /**
     * Obtains and show one user
     * @return Illuminate\Http\Response
     */
    public function show($id) {
        
        $user = User::findOrFail($id);

        return $this->successResponse($user);
    }

    /**
     * Update an existing author
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
        $rules = [
            'name' => 'max:255',
            'email' => 'max:255',
            'password' => 'max:255',
        ];

        $this->validate($request, $rules);

        $user = User::findOrFail($id);

        $user->fill($request->all());

        // if no changes happen
        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();

        return $this->successResponse($user);
    }

    /**
     * Remove an existing user
     * @return Illuminate\Http\Response
     */
    public function delete($id) {

        $user = User::findOrFail($id);

        $user->delete();

        return $this->successResponse($user);
    }
}