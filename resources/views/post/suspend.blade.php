<x-app-layout>
    <div class="pt-20 pb-10 mx-5 lg:mx-56 flex flex-col gap-3 ">
        <h1 class="text-3xl font-bold font-title pb-3 border-b-2 border-black w-full">Post mu di suspend?</h1>

        <p>Karabo adalah sebuah platform online yang dirancang yang untuk menambah wawasan dan prespektif kita dengan cara bertanya atau menjawab pertanyaan. Kami menyediakan berbagai fitur untuk memastikan pengalaman pengguna yang aman, nyaman, dan produktif. Untuk menjaga kualitas komunitas kami, Karabo menerapkan fitur suspend. Fitur ini dirancang untuk melindungi komunitas dari perilaku yang tidak sesuai, mencegah penyalahgunaan, memastikan pengguna mengikuti panduan komunitas kami dan interaksi di platform Karabo tetap positif dan konstruktif. Jika post mu di suspend silahkan baca kembali <a href="{{route('pedoman')}}"><span class="underline text-blue-500 ">pedoman komunitas karabo</span></a> untuk penjelasan lebih lanjut.
            Pengguna mungkin disuspensi dari platform tanya jawab karena berbagai alasan, termasuk:</p>

        <div>
            <h1 class="text-lg font-bold">1. Konten Tidak Pantas</h1>
            <ul class="pl-8">
                <li class="list-disc">Penggunaan bahasa kasar, ofensif, atau vulgar dalam pertanyaan, jawaban, atau komentar.
                </li>
                <li class="list-disc">Pengunggahan konten yang mengandung kekerasan, pornografi, atau materi yang bersifat diskriminatif terhadap ras, agama, gender, orientasi seksual, atau kelompok lain.</li>
            </ul>
        </div>

        <div>
            <h1 class="text-lg font-bold">2. Spam</h1>
            <ul class="pl-8">
                <li class="list-disc">Mengirimkan pesan berulang-ulang yang tidak relevan atau bertujuan untuk mempromosikan produk, layanan, atau situs web lain.
                </li>
                <li class="list-disc">Menggunakan tautan afiliasi atau melakukan promosi terselubung tanpa izin.</li>
            </ul>
        </div>

        <div>
            <h1 class="text-lg font-bold">3. Pelanggaran Privasi</h1>
            <ul class="pl-8">
                <li class="list-disc">Mengungkapkan informasi pribadi seseorang tanpa persetujuan mereka, termasuk alamat email, nomor telepon, alamat rumah, atau informasi identifikasi lainnya.
                </li>
                <li class="list-disc">Mengganggu atau mengintimidasi pengguna lain melalui pesan pribadi atau publik.</li>
            </ul>
        </div>

        <div>
            <h1 class="text-lg font-bold">4. Informasi Palsu dan Penipuan</h1>
            <ul class="pl-8">
                <li class="list-disc">Memberikan informasi yang sengaja menyesatkan atau tidak benar dengan tujuan menipu atau membingungkan pengguna lain.
                </li>
                <li class="list-disc">Mengklaim identitas orang lain atau memalsukan kredensial untuk mendapatkan keuntungan.</li>
            </ul>
        </div>

        <div>
            <h1 class="text-lg font-bold">5. Aktifitas Curang :</h1>
            <ul class="pl-8">
                <li class="list-disc">Memanipulasi sistem penilaian atau reputasi untuk mendapatkan keuntungan yang tidak adil.
                </li>
                <li class="list-disc">Mengklaim identitas orang lain atau memalsukan kredensial untuk mendapatkan keuntungan.</li>
            </ul>
        </div>

        <div>
            <h1 class="text-lg font-bold underline">Apakah post ku bisa kembali?</h1>
            <p>Tergantung permasalahan yang terdapat pada post pengguna, jika pengguna mau memperbaiki post mereka sesuai dengan pedoman komunitas karabo maka post mereka bisa kembali. Jika tidak maka post mereka tidak akan pernah kembali.</p>
        </div>

        <p>Suspensi adalah alat penting untuk menjaga integritas dan kesehatan komunitas di platform tanya jawab. Dengan menerapkan kebijakan suspensi yang adil dan transparan, platform dapat memastikan bahwa lingkungan tetap aman, ramah, dan produktif bagi semua anggotanya.</p>
        </p>
    </div>

    {{-- Component --}}
    @include('components.notification')
    @include('components.create-modal')
    
</x-app-layout>
