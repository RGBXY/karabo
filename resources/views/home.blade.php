<x-app-layout>
    <div class="flex items-start justify-evenly w-full lg:w-[1200px] min-h-screen pt-16 mx-auto">

        {{-- Post-Container --}}
        <div class="flex flex-col gap-3 h-full w-[700px] ">

            @if(session()->has('error'))
            <div id="alert-3" class="flex mt-5 items-center p-4 text-red-800 rounded-lg bg-red-50" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{session('error')}}
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 " data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            @endif

            @if($title)
            <h1 class="text-3xl font-extrabold text-title py-5 pl-3 border-b">{{$title}}</h1>
            @endif

            @if($posts->count())

            @foreach ($posts as $post)
            @include('components.post-card')
            @endforeach

            @else
            <div class="flex justify-center items-center">
                <p class="text-3xl font-bold pt-5">No Post Found</p>
            </div>
            @endif

            @include('components.create-modal')

            {{ $posts->links() }}
        </div>

        {{-- Side-Content-Container --}}
        <div class="w-[350px] h-screen sticky top-16 py-4 px-10 bg-white border-l border-slate-200 hidden lg:block">
            @include('components.side-content')
        </div>

    </div>


</x-app-layout>
