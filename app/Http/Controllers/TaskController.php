<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
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
        // Fetch all documents from the Firestore collection
        $documents = $this->firestoreDB->collection('tasks')->documents();

        // Convert Firestore documents to an array
        $tasks = [];
        foreach ($documents as $document) {
            $tasks[$document->id()] = $document->data();
        }
        // return $tasks;
        return view('pages.task.index', compact('tasks'));
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
    public function show(string $id = '')
    {
        $snapshot = $this->firestoreDB->collection('tasks')->document($id)->snapshot();

        if ($snapshot->exists()) {
            $task = $snapshot->data();
            $task['id'] = $id; // Add the ID to the data array
            $snapshot = $this->firestoreDB->collection('users')->document($task['assignee_id'])->snapshot();
            if ($snapshot->exists()) {
                $task['assignee'] = $snapshot->data()['name'];
            }
            // return $task;
            return view('pages.task.show', compact('task'));
        } else {
            return redirect()->route('task.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        // Fetch all documents from the Firestore collection
        $documents = $this->firestoreDB->collection('users')->documents();

        // Convert Firestore documents to an array
        $users = [];
        foreach ($documents as $document) {
            $users[$document->id()] = $document->data();
        }

        $snapshot = $this->firestoreDB->collection('tasks')->document($id)->snapshot();

        if ($snapshot->exists()) {
            $task = $snapshot->data();
            $task['id'] = $id; // Add the ID to the data array
            return view('pages.task.edit', compact('task', 'users'));
        } else {
            return redirect()->route('user.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        // return $request;
        try {
            $fieldsToUpdate = $request->except(['_token', '_method']);
            $this->firestoreDB->collection('tasks')->document($id)->set($fieldsToUpdate, ['merge' => true]);
            return redirect()->route('task.index')->with('success', 'Task updated successfully.');
        } catch (\Exception $e) {
            return $e;
            return redirect()->back()->with('error', 'Failed to update task. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->firestoreDB->collection('tasks')->document($id)->delete();
            return redirect()->route('task.index')->with('success', 'Task deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete task. Please try again later.');
        }
    }
}