<x-app-layout>
    <div class="flex items-start justify-evenly w-full lg:w-[1200px] min-h-screen pt-16 mx-auto">

        {{-- Post-Container --}}
        <div class="flex flex-col gap-3 h-full w-[700px] items-center ">
            @foreach ($posts as $post)
            @include('components.post-card')
            @endforeach
        </div>

        {{-- Side-Content-Container --}}
        <div class="w-[350px] h-screen sticky top-16 py-4 px-10 bg-white border-l border-slate-200 hidden lg:block">
            @include('components.side-content')
        </div>

    </div>


</x-app-layout>
