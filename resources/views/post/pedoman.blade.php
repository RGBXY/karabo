<x-app-layout>
    <div class="pt-20 pb-10 mx-5 lg:mx-56 flex flex-col gap-3">
        <h1 class="text-3xl font-bold font-title pb-3 border-b-2 border-black w-full">Pedoman Komunitas</h1>
        <p class="text-base leading-relaxed text-black">
            Selamat datang di Karabo! Kami bangga memiliki Anda sebagai bagian dari komunitas kami. Untuk memastikan bahwa Karabo tetap menjadi tempat yang aman, ramah, dan bermanfaat bagi semua pengguna, kami telah menetapkan pedoman komunitas yang harus diikuti oleh semua anggota. Dengan mengikuti pedoman ini, Anda membantu menciptakan lingkungan yang positif dan menyenangkan bagi semua orang.
            <br><br>

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

    {{-- Component --}}
    @if(auth()->check())
    @include('components.notification')
    @endif
    @include('components.create-modal')

</x-app-layout>
