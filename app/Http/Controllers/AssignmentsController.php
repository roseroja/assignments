<?php

namespace App\Http\Controllers;

use App\Assignment;
use Illuminate\Http\Request;
use Storage;

class AssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignments = Assignment::get();
        return response()->json([
            'assignments' => $assignments,
        ], 200);
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
    public function store(Request $request)
    {
        $assign = new Assignment();
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric|regex:/(00)[0-9]{9}/',
            'gender' => 'required',
            'biography' => 'required',
            'date_of_birth' => 'required|date|before:' . $assign->age(),
            'profile_picture' => 'required|image64:jpeg,jpg,png',
        ]);
        if ($validatedData) {
            $fileName = $assign->uploadImg($request->get('profile_picture'));
            $validatedData['profile_picture'] = $fileName;
            $assignment = Assignment::create($validatedData);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {

        $assign = new Assignment();
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'gender' => 'required',
            'biography' => 'required',
            'date_of_birth' => 'required|date|before:' . $assign->age(),
        ]);
        if (strpos($request->get('profile_picture'), ';')) {
            $fileName = $assign->uploadImg($request->get('profile_picture'));
        } else {
            $fileName = $request->get('profile_picture');
        }

        $validatedData['profile_picture'] = $fileName;

        $assignment->name = $validatedData['name'];
        $assignment->email = $validatedData['email'];
        $assignment->phone = $validatedData['phone'];
        $assignment->gender = $validatedData['gender'];
        $assignment->biography = $validatedData['biography'];
        $assignment->date_of_birth = $validatedData['date_of_birth'];
        $assignment->profile_picture = $validatedData['profile_picture'];
        $assignment->save();

        return response()->json([
            'message' => 'Assignment updated successfully!',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        $assignment->delete();
    }
}
