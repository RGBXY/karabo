<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="my-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-3">
            <input class="rounded-sm" type="checkbox" id="agree" required>
            <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block underline text-sm text-slate-600" type="button">
                Setuju dengan pedoman komunitas?
            </button>
        </div>

        <div class="flex items-center justify-center mt-4 mb-3">
            <button class=" w-full text-center bg-slate-900 hover:bg-slate-800 text-white py-2 rounded-lg">
                {{ __('Register') }}
            </button>
        </div>

        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>
    </form>



    <!-- Modal toggle -->


    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Pedoman Komunitas
                    </h3>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500">
                        Selamat datang di Karabo! Kami bangga memiliki Anda sebagai bagian dari komunitas kami. Untuk memastikan bahwa Karabo tetap menjadi tempat yang aman, ramah, dan bermanfaat bagi semua pengguna, kami telah menetapkan pedoman komunitas yang harus diikuti oleh semua anggota. Dengan mengikuti pedoman ini, Anda membantu menciptakan lingkungan yang positif dan menyenangkan bagi semua orang.
                    </p>
                    <p class="text-base leading-relaxed text-gray-500">
                        <span class="text-black font-bold">1. Hormati Sesama Anggota</span><br>
                        Bersikap Sopan dan Ramah: Selalu berinteraksi dengan hormat dan sopan terhadap sesama anggota. Hindari kata-kata kasar, penghinaan, atau perilaku yang dapat dianggap ofensif.
                        Perbedaan Pendapat: Hormati perbedaan pendapat dan pandangan. Diskusi sehat dan debat yang konstruktif sangat dianjurkan, tetapi serangan pribadi tidak akan ditoleransi.
                        <br><br>

                        <span class="text-black font-bold">2. Konten yang Sesuai</span><br>
                        Konten yang Layak: Pastikan semua konten yang Anda bagikan, termasuk posting, komentar, dan pesan, sesuai dengan nilai-nilai dan tujuan komunitas. Hindari konten yang mengandung kekerasan, pornografi, diskriminasi, atau ilegal.
                        Sumber Terpercaya: Saat berbagi informasi atau berita, pastikan bahwa informasi tersebut berasal dari sumber yang dapat dipercaya. Hindari penyebaran hoaks atau informasi yang menyesatkan.
                        <br><br>

                        <span class="text-black font-bold">3. Privasi dan Keamanan</span><br>
                        Hormati Privasi Orang Lain: Jangan pernah membagikan informasi pribadi orang lain tanpa izin mereka. Ini termasuk alamat, nomor telepon, alamat email, dan informasi pribadi lainnya.
                        Keamanan Akun: Lindungi informasi login dan jangan berbagi kata sandi Anda dengan orang lain. Jika Anda menemukan aktivitas mencurigakan, segera laporkan kepada tim kami.
                        <br><br>

                        <span class="text-black font-bold"> 4. Hindari Spam dan Iklan </span><br>
                        Konten Spam: Hindari mengirimkan pesan berulang atau tidak relevan yang dapat dianggap sebagai spam.
                        Iklan Tanpa Izin: Jangan memposting iklan atau promosi produk/jasa tanpa izin dari administrator komunitas. Promosi hanya diperbolehkan di area yang telah ditentukan.
                        <br><br>

                        <span class="text-black font-bold">5. Penggunaan Fitur Suspend </span><br>
                        Kepatuhan terhadap Pedoman: Pengguna yang melanggar pedoman ini dapat dikenakan tindakan suspend sementara atau permanen.
                        Proses Banding: Jika Anda merasa penangguhan akun Anda tidak adil, Anda dapat mengajukan banding melalui mekanisme yang disediakan. Tim kami akan meninjau banding dan memberikan keputusan akhir berdasarkan bukti yang ada.
                        <br><br>

                        <span class="text-black font-bold"> 6. Perubahan Pedoman</span><br>
                        Pembaharuan Pedoman: Pedoman ini dapat diperbarui dari waktu ke waktu. Tetaplah memeriksa pedoman ini secara berkala.
                        <br><br>

                        Terima kasih telah menjadi bagian dari komunitas Karabo. Dengan mengikuti pedoman ini, Anda membantu menjaga Karabo sebagai tempat yang aman, ramah, dan bermanfaat bagi semua anggota. Jika Anda memiliki pertanyaan atau umpan balik mengenai pedoman ini, jangan ragu untuk menghubungi kami.
                        Selamat berpartisipasi dan semoga Anda menikmati pengalaman di Karabo!
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                    <button id="checkButton" data-modal-hide="default-modal" type="button" class="text-white bg-slate-900 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Setuju</button>
                    <a href="/">
                        <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Tidak setuju</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('checkButton').addEventListener('click', function() {
            document.getElementById('agree').checked = true;
        });

    </script>

</x-guest-layout>
