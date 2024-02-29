<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Google\Cloud\Core\Timestamp;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $firestoreDB;
    public function __construct()
    {
        $this->firestoreDB = app('firebase.firestore')->database();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all documents from the Firestore collection
        $documents = $this->firestoreDB->collection('users')->documents();

        // Convert Firestore documents to an array
        $users = [];
        foreach ($documents as $document) {
            $users[$document->id()] = $document->data();
        }
        // return $users;
        return view('pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {

        try {
            $this->firestoreDB->collection('users')->add($request->validated());
            Session::flash('success', 'User created successfully');
            return redirect()->route('user.create');
        } catch (\Exception $e) {
            Session::flash('error', 'Failed to store user data');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id = "")
    {
        $snapshot = $this->firestoreDB->collection('users')->document($id)->snapshot();

        if ($snapshot->exists()) {
            $user = $snapshot->data();
            $user['id'] = $id; // Add the ID to the data array
            return view('pages.user.edit', compact('user'));
        } else {
            return redirect()->route('user.index');
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            $fieldsToUpdate = $request->except('_token');
            $this->firestoreDB->collection('users')->document($id)->set($fieldsToUpdate, ['merge' => true]);
            return redirect()->route('user.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Failed to update user. Please try again later.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->firestoreDB->collection('users')->document($id)->delete();
            return redirect()->route('user.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete user. Please try again later.');
        }
    }
}
