<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
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
        return view('pages.task.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all documents from the Firestore collection
        $documents = $this->firestoreDB->collection('users')->documents();

        // Convert Firestore documents to an array
        $users = [];
        foreach ($documents as $document) {
            $users[$document->id()] = $document->data();
        }
        return view('pages.task.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $this->firestoreDB->collection('tasks')->add($request->validated());
            Session::flash('success', 'Task created successfully');
            return redirect()->route('task.create');
        } catch (\Exception $e) {
            Session::flash('error', 'Failed to store task data');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
