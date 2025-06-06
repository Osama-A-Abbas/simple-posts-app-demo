<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::with('posts')
        //     ->select(['id', 'name', 'email', 'role'])
        //     ->get();

        // $users = User::all()->withRelationshipAutoloading();

        $users = User::all();
        // $users = User::with('posts')->select(['id', 'name', 'email', 'role'])->get();
        return $users;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
       Gate::authorize('update', $user);
        $user->update($request->validated());
        return response()->json([
            'message' => 'Updated Successfully',
            'data' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //$user->forceDelete();   // deletes the record from db
        $user->delete();         // flags the record and fills the deleted_at attribute in table

        return response()->json([
            'message' => 'User Deleted Successfully'
        ]);
    }
}
