<div id="crud-modal" aria-hidden="true" tabindex="-1" class="hidden overflow-y-auto fixed overflow-x-hidden top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full lg:max-w-[700px] max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Buat Pertanyaan
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="crud-modal">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col gap-5 p-5">
                    <div>
                        <textarea id="editorCreate" maxlength="250" required name="judul_post" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg focus:shadow border-gray-300 focus:ring-0 focus:border-slate-300" placeholder="Tulis pertanyaan" oninput="countCharacters(this)"></textarea>
                        <div id="judul_post_error" style="color: red;"></div>
                        <span id="charCount">250</span> karakter tersisa.
                    </div>
                    <div class="flex flex-col md:flex-row md:items-end gap-5">
                        <div class="">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 ">Topik</label>
                            <select id="category" name="kategori_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                                <option value="" selected>Pilih Topik</option>
                                @foreach ($kategoris as $kategori)
                                <option value="{{$kategori->id}}">{{$kategori->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="file" class="rounded-xl border" name="image" accept="image/png, image/jpeg, image/webp, image/jpg">
                    </div>

                    @if ($errors->any() && $errors->has('judul_post'))
                    <div class="alert-danger flex gap-2 text-red-500 font-semibold bg-red-200 p-2 rounded-lg">
                        <img src="{{asset('assets/img/info.svg')}}" alt="">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <button data-modal-show="crud-modal" type="submit" class="text-white inline items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-slate-800 hover:bg-slate-700">
                        Buat pertanyaan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Temukan pesan kesalahan dalam modal
        let errorAlert = document.querySelector('#crud-modal .alert-danger');

        // Jika ada pesan kesalahan, buka modal
        if (errorAlert) {
            let modal = document.getElementById('crud-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex', 'justify-center', 'h-[1000vh]', 'items-center', 'bg-gray-900/90');
        }
    });

</script>

<script>
    function countCharacters() {
        let maxLength = 250;
        let currentLength = document.getElementById('editorCreate').value.length;
        let remaining = maxLength - currentLength;

        document.getElementById('charCount').textContent = remaining;
    }

</script>
