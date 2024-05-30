<div id="dropdownNotification" class="z-50 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700" aria-labelledby="dropdownNotificationButton">
    <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
        Notifications
    </div>
    <div class="divide-y h-[500px] overflow-y-auto divide-gray-100 dark:divide-gray-700">
        @foreach ($posts->reverse() as $post)
        @if($post->user_id == auth()->user()->id)
        @if($post->status == 1)
        <a href="/suspend" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
            <div class="flex-shrink-0">
                @if($post->user->profile_image)
                <img class="w-8 h-8 lg:w-10 lg:h-10 rounded-full object-cover border-[1px] border-slate-200" src="{{ asset('storage/' . $post->user->profile_image) }}" alt="Profil">
                @else
                <img class="w-8 h-8 lg:w-10 lg:h-10 rounded-full object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="Profile">
                @endif
            </div>
            <div class="w-full ps-3">
                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">
                    <strong>Admin</strong> <span class="text-red-500">mensuspend</span> postingan Anda: <em>{{ $post->judul_post }}</em>
                </div>
                <div class="text-xs text-blue-600 dark:text-blue-500">{{ \Carbon\Carbon::parse($post->updated_at)->translatedFormat('H:i, d F Y') }}</div>
            </div>
        </a>
        @endif
        @endif
        @endforeach

        @foreach ($jawabans as $jawaban)
        @if($jawaban->post->user_id == auth()->user()->id)
        <a href="/post/{{$jawaban->post->slug}}" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
            <div class="flex-shrink-0">
                @if($jawaban->user->profile_image)
                <img class="w-8 h-8 lg:w-10 lg:h-10 rounded-full object-cover border-[1px] border-slate-200" src="{{ asset('storage/' . $jawaban->user->profile_image) }}" alt="Profil">
                @else
                <img class="w-8 h-8 lg:w-10 lg:h-10 rounded-full object-cover" src="{{ asset('assets/img/default-profile.png') }}" alt="Profile">
                @endif
            </div>
            <div class="w-full ps-3">
                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">
                    <strong>{{$jawaban->user->name}}</strong> telah menjawab postingan Anda: <em>{{ $jawaban->post->judul_post }}</em>
                </div>
                <div class="text-xs text-blue-600 dark:text-blue-500">{{ \Carbon\Carbon::parse($jawaban->created_at)->translatedFormat('H:i, d F Y') }}</div>
            </div>
        </a>
        @endif
        @endforeach
    </div>

</div>
