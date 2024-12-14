@extends('layouts.page')

@section('pages')
<div class=" h-lvh w-lvw mt-5 p-6 mx-auto">
    <div class="grid h-full pt-14 space-x-3 grid-cols-6">
        <div class="col-span-1 hidden lg:block relative">
            <div class="flex sticky top-24 left-0 shadow-sm rounded-lg text-tulip-tree-400 bg-cod-gray-950  flex-col h-auto p-4 gap-10 items-center justify-between">
                <div class="flex w-full flex-col items-center justify-center">
                    <div class="h-28 w-full mb-4 rounded-lg bg-gray-nurse-300">
                        
                    </div>
                    <div class="w-full flex">
                        <h2 class=" text-2xl pt-2 font-bold text-center mb-7">{{Auth::user()->name}}</h2>
                    </div>
                    <a href="#" class="w-full mb-4 text-start py-3 px-4 rounded-md text-cod-gray-950 bg-tulip-tree-100 hover:bg-tulip-tree-400"><i class="fa-regular fa-circle-user pe-2 me-2 border-cod-gray-950 border-r-2"></i>Profile</a>
                    <a href="#" class="w-full mb-4 text-start py-3 px-4 rounded-md text-cod-gray-950 bg-tulip-tree-100 hover:bg-tulip-tree-400"><i class="fa-solid fa-trophy pe-2 me-2 border-cod-gray-950 border-r-2"></i>Achievements</a>
                    <a href="#" class="w-full mb-4 text-start py-3 px-4 rounded-md text-cod-gray-950 bg-tulip-tree-100 hover:bg-tulip-tree-400"><i class="fa-solid fa-star pe-2 me-2 border-cod-gray-950 border-r-2"></i>Sato Land Features</a>
                </div>
                <div class="w-full">
                    <a href="#" class="px-4"><i class="fa-solid fa-gear pe-2 me-2 border-tulip-tree-100 border-r-2"></i>Setting</a>
                </div>
            </div>
        </div>
        <div class="h-full shadow-sm rounded-lg col-span-12 mx-auto lg:col-span-4">@yield('middle')</div>
        <div class="h-auto hidden lg:block rounded-lg ">@yield('right')</div>
    </div>
</div>
@endsection