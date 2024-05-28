<x-app-layout>
    <div class="flex items-start justify-center w-full min-h-screen pt-20">
        <div class="h-full lg:w-[50%]">
            <h1 class="p-3 text-2xl md:text-2xl font-extrabold font-title border-b mb-4">Bantu mereka dengan jawaban mu😉</h1>
            @foreach ($jawab as $post)
            @include('components.post-card')
            @endforeach
            {{ $jawab->links() }}
        </div>
    </div>

    {{-- Component --}}
    @include('components.notification')
    @include('components.create-modal')
</x-app-layout>
