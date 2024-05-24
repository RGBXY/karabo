<x-app-layout>
    <div class="pt-20 h-screen flex flex-col items-center justify-center">
        <div class="">
            <h1 class="text-lg font-bold mb-1">Buat Pertanyaan</h1>
            <form action="{{route('post.store')}}" method="get" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col gap-5">
                    <div>
                        <textarea id="editorCreate" maxlength="250" required name="judul_post" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg focus:shadow border-gray-300 focus:ring-0 focus:border-slate-300" placeholder="Tulis pertanyaan" oninput="countCharacters(this)"></textarea>
                        <div id="judul_post_error" style="color: red;"></div>
                        <span id="charCount">250</span> karakter tersisa.
                    </div>
                    <div class="flex flex-col md:flex-row md:items-end gap-5">
                        <div class="">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 ">Topik</label>
                            <select id="category" name="kategori_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                                @foreach ($kategoris as $kategori)
                                <option value="{{$kategori->id}}" selected>{{$kategori->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="file" class="rounded-xl border" name="image" accept="image/png, image/jpeg, image/webp, image/jpg">
                    </div>
                    <button id="submitBtn" type="submit" class="text-white inline items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-slate-800 hover:bg-slate-700">
                        Buat pertanyaan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function countCharacters() {
            let maxLength = 250;
            let currentLength = document.getElementById('editorCreate').value.length;
            let remaining = maxLength - currentLength;
            document.getElementById('charCount').textContent = remaining;
        }

    </script>
</x-app-layout>
