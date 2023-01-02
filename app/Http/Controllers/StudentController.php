<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('profile\index' , compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile\create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|max:255',
            'phone'=>'required|max:10',
            'section'=>'required',
            'image'=>'required|image|mimes:jpg,jpeg,png,gif,svg',
        ]);
        $image = $request->file('image');
        $path = 'image/';
        $profileImage = date('YmdHis').".".$image->getClientOriginalExtension();
        $image -> move($path,$profileImage); 
        $validateData['image']= $profileImage;   


        $students = Student::create($validateData);
        session()->flash('success', 'Vos informations a été bien enregistré!!');
        return redirect('/students');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('profile.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findorfail($id);
        return view('profile.edit', [ 'student' => $student]);
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
        $validateData = $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|max:255',
            'phone'=>'required|max:10',
            'section'=>'required',
            'image'=>'required|image|mimes:jpg,jpeg,png,gif,svg',
        ]);
        $student = Student::findorfail($id);
        
        if($request->file != ''){        
            $path = 'image/';
  
            //code for remove old file
            if($student->file != ''  && $student->file != null){
                 $file_old = $path.$student->file;
                 unlink($file_old);
            }
  
            //upload new file
            $file = $request->file;
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
  
            //for update in table
            $student->update(['file' => $filename]);
       }
  
        $student->name =$request->input('name');
        $student->email =$request->input('email');
        $student->phone =$request->input('phone');
        $student->section =$request->input('section');
        $student->image =$request->input('image');

        $student->save();
        session()->flash('success', 'Vos informations a été  modifié!!');
        return redirect('/students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $student = Student::findorfail($id);
        $student->delete();
        session()->flash('success', 'Votre profile a été  supprimé!!');
        return redirect('/students');
    }
}
