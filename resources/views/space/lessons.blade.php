@extends('space.index')


@section('middle')
    <div id="disable-canvas" class="absolute w-lvw h-lvh top-0 left-0 z-20 opacity-50 bg-cod-gray-950"></div>
    <div class="p-5 bg-tulip-tree-100 rounded-lg overflow-auto relative w-full">
        <div class=" mb-8 flex justify-between px-6 py-4 bg-cod-gray-950 text-tulip-tree-200 rounded-full">
            <h1 class="text-4xl font-bold font-serif"><i class="fa-solid fa-book me-4 text-4xl"></i>{{ $path->course->name }}
                Course</h1>
            <div>
                <p>Started at - {{$path->lesson[$path->track]->created_at->addDays(1)->diffForHumans()}}</p>
            </div>
        </div>
        @if (!$path->punishment)
            <form action="/space/lessons/add-punishment/{{ $path->id }}" method="POST"
                class="fixed shadow-md shadow-slate-700 h-auto left-1/3 z-50 top-1/4 p-5 border w-2/5 rounded-lg bg-cod-gray-950">
                @csrf
                <label for="punishment" class="font-bold w-full text-tulip-tree-200 mb-4 block text-2xl">Add
                    Punishment</label>
                <textarea name="punishment" placeholder="Enter punishment for this lessons" id="punishment"
                    class="w-full rounded-lg h-2/4 mb-4 focus:outline-none p-3 resize-none"></textarea>
                <div class="lg:flex gap-3 justify-between px-3">
                    <p class="px-4 py-3 text-tulip-tree-200"><i class="fa-solid fa-circle-info me-3 text-lg"></i>If you
                        can't pass the lesson in giving timing, you will be punished.</p>
                    <button id="punishment-set"
                        class="px-4 py-3 bg-tulip-tree-400 rounded-full sm:w-full lg:w-1/6 text-lg text-cod-gray-950">Set</button>
                </div>
            </form>
        @endif
        @php
            $lessons = json_decode($path->lesson[$path->track]->body, true);
        @endphp
        @foreach ($lessons as $lesson)
            <div class="mb-8">
                <div class="w-full h-full p-3">
                    <h1 class="font-bold mb-4 text-3xl"><i
                            class="fa-solid fa-bookmark text-4xl me-3"></i>{{ $lesson['Title'] }}</h1>
                    <div class="p-5 rounded-md text-tulip-tree-200 bg-cod-gray-950">
                        <h1 class="font-bold mb-4 text-xl"><i class="fa-solid fa-meteor me-3 text-2xl"></i>Introduction</h1>
                        <p class="mb-8">{{ $lesson['Detail']['Introduction'] }}
                        </p>
                        <h1 class="font-bold mb-4 text-xl"><i class="fa-solid fa-circle-check text-2xl me-3"></i>Usage</h1>
                        <p class="mb-8">{{ $lesson['Detail']['Usage'] }}
                        </p>
                        <h1 class="font-bold mb-4 text-xl"><i class="fa-solid fa-vial text-2xl me-3"></i>Sample</h1>
                        <div class="w-full overflow-x-scroll h-auto mb-8 p-5 text-cod-gray-950 bg-white">
                            <pre><code class=" text-red-600">{{ $lesson['Detail']['Sample'] }}</code></pre>
                        </div>
                        <h1 class="font-bold mb-4 text-xl"><i class="fa-solid fa-code text-2xl me-3"></i>Example</h1>
                        <p class="mb-2">{{ $lesson['Example']['Description'] }}</p>
                        <div class="w-full overflow-x-scroll h-auto mb-2 p-5 text-cod-gray-950 bg-white">
                            <pre><code class=" text-red-600">{{ $lesson['Example']['Code'] }}</code></pre>
                        </div>
                        <p class="p-3 mb-8">Explaination - {{ $lesson['Example']['Explanation'] }}</p>
                        <h1 class="font-bold mb-4 text-xl"><i class="fa-solid fa-font-awesome text-2xl me-3"></i>Common
                            Methods</h1>
                        @foreach ($lesson['CommonMethods'] as $item)
                            <p class="mb-2">{{ $item['Description'] }}</p>
                            <div class="w-full overflow-x-scroll h-auto mb-8 p-5 text-cod-gray-950 bg-white">
                                <pre><code class=" text-red-600">{{ $item['Method'] }}</code></pre>
                            </div>
                        @endforeach
                        <h1 class="font-bold mb-4 text-xl"><i class="fa-solid fa-shoe-prints text-2xl me-3"></i>Guild lines
                        </h1>
                        <div class="mb-8">
                            @foreach ($lesson['Guidelines'] as $item)
                                <p class="mb-2"> - {{ $item }}</p>
                            @endforeach
                        </div>
                        <h1 class="font-bold mb-4 text-2xl"><i class="fa-solid fa-list-check text-2xl me-3"></i>Project</h1>
                        <div class="p-3">
                            <p class="mb-4">{{ $lesson['Project']['Description'] }}</p>
                            @foreach ($lesson['Project']['Tasks'] as $item)
                                <p class="mb-2"> - {{ $item }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <form action="/space/lessons/done/{{ $path->id }}" method="POST">
            @csrf
            <input type="hidden" name="track" value="{{ $path->track }}">
            <button class="px-10 py-3 rounded-full text-xl hover:text-cod-gray-500 float-end me-8 ">Next <i
                    class="fa-solid fa-arrow-right"></i></button>
        </form>
    </div>
    <script>
        window.puni = @json($path->punishment)
    </script>
    <script src="{{ asset('js/pages/lessons.js') }}"></script>
@endsection

@section('right')
    <div class="p-5 bg-cod-gray-950 rounded-lg overflow-auto relative w-full">
        @php
            $result = collect($path->lesson)->filter(function ($item) {
                return $item->status === 1;
            });
        @endphp
        @if ($result->isNotEmpty())
            <h1 class="font-bold text-2xl mb-4 text-tulip-tree-400">Finished Lessons</h1>
            @foreach ($path->lesson as $index => $lesson)
                @if ($lesson->status)
                    <a href="/space/lessons/lesson/{{ $lesson->id }}"
                        class="w-full block mb-4 cursor-pointer px-4 py-3 rounded-lg bg-tulip-tree-100 hover:bg-tulip-tree-400">Lesson
                        {{ $index + 1 }}<i class="fa-solid ms-3 text-green-700 text-2xl fa-check float-end"></i></a>
                @endif
            @endforeach
        @endif
    </div>
@endsection
