@extends('space.index')


@section('middle')
    <div class="flex bg-tulip-tree-100 rounded-lg h-2/3 relative flex-col p-3">
        <h1 class="text-3xl font-bold text-cod-gray-950">
            <i class="fa-solid fa-book-open me-4"></i>Library
        </h1>
        <div style="max-width: 980px; max-height: 750px;" class="grid gap-4 overflow-y-auto p-4 grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <div class="flex justify-center items-center">
                <div id="add-new-form"
                    class="lg:w-48 lg:h-40 w-40 h-36 cursor-pointer transition-all duration-200 active:scale-90 flex p-2 flex-col rounded-md bg-cod-gray-950">
                    <div class="w-full mb-4 bg-gray-nurse-300 rounded-sm flex justify-center items-center h-24">
                        <i class="fa-solid fa-file-circle-plus text-3xl"></i>
                    </div>
                    <p class="text-center text-gray-nurse-300">Add new path</p>
                </div>
            </div>
            @foreach ($paths as $path)
            @if (!$path->finished)
            <div class="flex justify-center items-center">
                @php
                    $body = json_decode($path->course->body, true);
                    $remaining = is_array($body)? count($body) - $path->track * $path->difficulty_status * $path->plan_status : 0;
                @endphp
                <div
                    class="lg:w-48 lg:h-40 w-40 h-36 overflow-hidden cursor-pointer transition-all duration-200 flex p-3 flex-col rounded-md bg-cod-gray-950">
                    <h3 class="text-lg mb-1 w-full text-tulip-tree-400 font-bold text-ellipsis">{{$path->course->name}}</h3>
                    <p class="w-full mb-1 text-tulip-tree-400">Remaining Lessons - {{$remaining}}
                    </p>
                    <p class="text-tulip-tree-400 hidden lg:block mb-2">Status -
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
        <div id="new-form" style="height: 380px" class="absolute hidden w-1/2 top-1/6 left-56 mt-12 bg-cod-gray-950 rounded-md p-4 border border-gray-nurse-100">
            <form action="/space" method="POST" class=" text-tulip-tree-100">
                @csrf
                <div class="flex flex-col gap-2 mb-3">
                    <label class="text-lg font-bold" for="course">Select Course</label>
                    <div class="flex flex-col gap-2">
                        <select id="course"
                            name = 'title'
                            class="col-start-1 text-cod-gray-950 row-start-1 w-full appearance-none rounded-md bg-tulip-tree-100 py-1.5 pl-3 pr-8 text-base outline outline-1 -outline-offset-1 outline-gray-300 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            @foreach ($courses as $course)
                                <option value="{{$course->id}}">{{$course->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <h1 class="text-lg font-bold ">Plan</h1>
                    <div class="flex justify-between bg-tulip-tree-100 rounded-lg text-cod-gray-950">
                        <div class="p-3 w-32">
                            <label class="me-2 border-r-2 pe-3 border-r-cod-gray-950" for="daily">Daily</label>
                            <input checked value="1" type="radio" id="daily" name="plan">
                        </div>
                        <div class="p-3 w-32">
                            <label class="me-2 border-r-2 pe-3 border-r-cod-gray-950" for="weekly">Weekly</label>
                            <input value="7" type="radio" id="weekly" name="plan">
                        </div>
                        <div class="p-3 w-32">
                            <label class="me-2 border-r-2 pe-3 border-r-cod-gray-950" for="monthly">Monthly</label>
                            <input value="30" type="radio" id="monthly" name="plan">
                        </div>
                    </div>
                </div>
                <div class="mb-12">
                    <h1 class="text-lg font-bold">Level</h1>
                    <div class="flex justify-between bg-tulip-tree-100 rounded-lg text-cod-gray-950">
                        <div class="p-3 w-32">
                            <label class="me-2 border-r-2 pe-3 border-r-cod-gray-950" for="easy">Easy</label>
                            <input type="radio" value="1" id="easy" name="level">
                        </div>
                        <div class="p-3 w-32">
                            <label class="me-2 border-r-2 pe-3 border-r-cod-gray-950" for="medium">Medium</label>
                            <input type="radio" value="2" id="medium" name="level">
                        </div>
                        <div class="p-3 w-32">
                            <label class="me-2 border-r-2 pe-3 border-r-cod-gray-950" for="difficult">Hard</label>
                            <input checked type="radio" value="3" id="difficult" name="level">
                        </div>
                    </div>
                </div>
                <div class="flex justify-between">
                    <div id="close-new-form" class="px-4 hover:bg-gray-nurse-800 cursor-pointer py-3 w-32 bg-gray-nurse-500 rounded-lg text-center">Cancel</div>
                    <button class="px-4 py-3 w-32 hover:bg-tulip-tree-800 bg-tulip-tree-400 rounded-lg text-center">Start</button>
                </div>
            </form>
        </div>
    </div>
    
@endsection
@section('right')
    <div class="p-3 w-full items-center flex flex-col bg-cod-gray-950 text-tulip-tree-100 rounded-lg gap-2">
        <label for="title" class="text-xl w-full text-start mb-2 font-bold">Generate Prompt</label>
        <div class="flex gap-2 mb-4">
            <input id="title" type="text" class="w-full text-cod-gray-950 px-3 py-2 rounded-md" placeholder="Enter title">
            <div class="px-3 py-2 rounded-md cursor-pointer shadow-md bg-tulip-tree-400 font-bold text-center text-cod-gray-100 text-xs">Copy</div>
        </div>
        <a href="/space/finished" class="w-full px-4 py-3 rounded-md bg-tulip-tree-100 hover:bg-tulip-tree-400 text-cod-gray-950"><i class="fa-solid fa-check-double me-2"></i>Finished Courses</a>
        {{-- <div class="w-full">
            <label for="promp-file" class="text-xl text-start mb-5 font-bold">Add Custom Course</label>
            <input type="file" id="promp-file">
        </div> --}}
    </div>  
    <script src="{{asset('js/pages/library.js')}}"></script>
@endsection
