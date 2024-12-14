@extends('space.index')

@section('middle')
    <div class="flex bg-tulip-tree-100 rounded-lg h-2/3 relative flex-col p-3">
        <h1 class="text-3xl font-bold text-cod-gray-950">
            <i class="fa-solid fa-book-open me-4"></i>Finished Courses
        </h1>
        <div style="max-width: 980px; max-height: 750px;" class="grid gap-4 overflow-y-auto p-4 grid-cols-2 lg:grid-cols-4">
            @foreach ($paths as $path)
            @if ($path->finished)
            <div class="flex justify-center items-center">
                @php
                    $body = json_decode($path->course->body, true);
                    $remaining = is_array($body)? count($body) - $path->track * $path->difficulty_status * $path->plan_status : 0;
                @endphp
                <div
                    class="w-48 h-40 overflow-hidden cursor-pointer transition-all duration-200 flex p-3 flex-col rounded-md bg-cod-gray-950">
                    <h3 class="text-lg mb-1 w-full text-tulip-tree-400 font-bold text-ellipsis">{{$path->course->name}}</h3>
                    <p class="w-full mb-1 text-tulip-tree-400">Remaining Lessons - {{$remaining}}
                    </p>
                    <p class="text-tulip-tree-400 mb-2">Status -
                        @if ($path->plan_status === 1)
                            <span>Daily</span>
                        @elseif ($path->plan_status === 7)
                            <span>Weekly</span>
                        @else
                            <span>Monthly</span>
                        @endif
                    </p>
                    <div class="flex h-12 items-center gap-2">
                        <a href="/space/lessons/{{$path->id}}" class="w-full h-10 text-center pt-1 text-gray-nurse-300 bg-gray-nurse-800 hover:bg-gray-nurse-950 rounded-sm">
                            View
                        </a>
                        <a href="/space/lessons/delete/{{$path->id}}" class="text-center h-10 text-red-500 text-xl"><i class="fa-regular pt-2 fa-trash-can"></i></a>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    
@endsection