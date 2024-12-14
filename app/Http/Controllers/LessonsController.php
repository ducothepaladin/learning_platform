<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Path;
use App\Models\Lessons;

class LessonsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function done ($id)
    {
        $validator = validator(request()->all(), [
            'track' => 'required'
        ]);

        if($validator->failed()) {
            return back()->withErrors($validator);
        }

        $path = Path::find($id);

        $lessonLength = count(json_decode($path->course->body, true));
        $lessonCount = $path->plan_status * $path->difficulty_status;
        $lessonTrack = intdiv($lessonLength, $lessonCount);

        if($lessonTrack > $path->track) {

            $path->lesson[$path->track]->status = 1;
            $path->lesson[$path->track]->save();
            $path->track = request()->track + 1;
            $path->punishment = null;
            $path->save();

        } else {
            $path->finished = 1;
            $path->save();

            return redirect()->route('library');
        }

        return redirect()->route('lessons', ['id' => $id]);
    }

    function lessons ($id)
    {
        $path = Path::find($id);

        if(!$path) {
            return back();
        }

        $sliceCount = $path->plan_status * $path->difficulty_status;
        $sliceIndex = $sliceCount * $path->track;
       

        $data = array_slice(json_decode($path->course->body, true),$sliceIndex, $sliceCount);

        if(!$path->punishment) {

            $lesson = new Lessons;
            $lesson->body = json_encode($data);
            $lesson->path_id = $id;
            $lesson->save();

        }

        return view('space.lessons', ['path' => $path]);
    }

    function punishment ($id)
    {
        $validator = validator(request()->all(), [
            'punishment' => 'required'
        ]);

        if($validator->failed()) {
            return back()->withErrors($validator);
        }

        $path = Path::find($id);
        $path->punishment = request()->punishment;
        $path->save();

        return back();
    }
}
