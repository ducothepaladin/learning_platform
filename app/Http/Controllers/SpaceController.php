<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses;
use App\Models\Path;
use Illuminate\Support\Facades\Auth;
use App\Models\Lessons;
use App\Models\User;

class SpaceController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    function library ()
    {
        $data = Courses::all();
        $user = User::find(Auth::id());
        $paths = $user->paths;

        if(count($paths) > 0) {

            return view('space.library', ['courses' => $data, 'paths' => $paths]);
        }

        return view('space.library', ['courses' => $data, 'paths' => []]);
    }

    function createPath () 
    {

        $validator = validator(request()->all(), [
            'title' => 'required',
            'plan' => 'required',
            'level' => 'required'
        ]);

        if($validator->failed()) {
            return back()->withErrors($validator);
        }

        $path = new Path;

        $path->course_id = request()->title;
        $path->plan_status = request()->plan;
        $path->difficulty_status = request()->level;
        $path->duration = request()->plan;
        $path->user_id = Auth::id();
        $path->save();

        return redirect()->route('library');
    }

    function delete ($id) 
    {
        $path = Path::find($id);
        
        if($path) {
            foreach($path->lesson as $lesson) {
                $lesson->delete();
            }
            $path->delete();
        }

        return back();
    }

    function finished ()
    {
        $user = User::find(Auth::id());
        $paths = $user->paths;

        return view('space.finished', ['paths' => $paths]);
    }
}
