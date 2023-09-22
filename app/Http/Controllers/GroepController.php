<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Groep;
use Illuminate\Http\Request;

class GroepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Groups = Groep::with('users')->get();
            return $Groups;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all users who are not part of any archived group
        $availableUsers = User::whereNotIn('id', function ($query) {
            $query->select('users.id')
                  ->from('users')
                  ->join('groep_user_koppel', 'users.id', '=', 'groep_user_koppel.userId')
                  ->join('groep', 'groep_user_koppel.groepId', '=', 'groep.id')
                  ->whereColumn('groep_user_koppel.userId', 'users.id')
                  ->where('groep.status', 0);
        })
        ->where('role', '!=', 'admin')// Exclude users with 'admin' role
        ->whereNull('password_code') 
        ->get();
        
        return view('createGroup', compact('availableUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'naam' => 'required|string|max:255',
            'user_ids' => 'array', // Make sure user_ids is an array
        ]);
    
        // Create a new group with a status of 0
        $groep = new Groep;
        $groep->naam = $validatedData['naam'];
        $groep->status = 0; // Set the status to 0
        $groep->save();
        // Attach selected users to the group
        if (isset($validatedData['user_ids'])) {
            $groep->users()->attach($validatedData['user_ids']);
        }
    
        // Redirect to a success page or return a response as needed
        return redirect()->route('home')->with('success', 'Group created successfully');
    
    }

    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        // Retrieve the user by their ID
    $user = User::findOrFail($userId);

    // Retrieve the groups associated with the user
    $userGroups = $user->groups;

    // You can further process and display the user's groups as needed
    return $userGroups;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Groep $groep)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $id, Groep $groep)
    {
        
        $groep = Groep::findOrFail($id);
        $groep->fill(['status' => '1']);

        return redirect()->route('home')->with('success', 'Group gearchiveerd');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Groep $groep)
    {
        //
    }
}
