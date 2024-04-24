<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto fixed overflow-x-hidden top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full lg:max-w-[700px] max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Buat Pertanyaan
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col gap-5 p-5">
                    <div class="">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pertanyaan</label>
                        <textarea id="editor4" maxlength="250" required name="judul_post" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg focus:shadow border-gray-300 focus:ring-0 focus:border-slate-300" placeholder="Tulis pertanyaan" oninput=countCharacters(this)></textarea>
                        <span id="charCount">250</span> karakter tersisa.
                    </div>
                    <div class="flex items-end gap-5">
                        <div class="">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select id="category" name="kategori_id" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach ($kategoris as $kategori)
                                <option value="{{$kategori->id}}" selected>{{$kategori->nama_kategori}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="file" class="rounded-xl border" name="image" accept="image/png, image/jpeg, image/webp, image/jpg">
                    </div>
                    <button type="submit" class="text-white inline items-center font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-slate-800 hover:bg-slate-700">
                        Buat pertanyaan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
   function countCharacters() {
    let maxLength = 250;
    let currentLength = document.getElementById('editor4').value.length;
    let remaining = maxLength - currentLength;
    
    document.getElementById('charCount').textContent = remaining;
}

</script>