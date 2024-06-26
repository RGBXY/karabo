<div id="edit-modal-{{$post->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto fixed overflow-x-hidden top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 max-w-[700px] max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Edit
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="edit-modal-{{$post->id}}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{route('post.update', ['post' => $post])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="flex flex-col gap-5 p-5">
                    <div>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Pertanyaan</label>
                        <textarea id="editor4" required name="judul_post" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg focus:shadow border-gray-300 focus:ring-0 focus:border-slate-300" placeholder="Tulis pertanyaan">{!!$post->judul_post!!}</textarea>
                    </div>
                    <div class="flex flex-col md:flex-row md:items-end gap-5">
                        <div class="">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Topik</label>
                            <select id="category" name="kategori_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                                @foreach ($kategoris as $kategori)
                                <option value="{{$kategori->id}}" @if($kategori->id == $post->kategori_id) selected @endif>
                                    {{$kategori->nama_kategori}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <input class="rounded-xl border" type="file" name="image" onchange="previewImage(event)">
                        @if($post->image)
                        <img id="profileImagePreview" width="50px" src="{{asset('storage/' . $post->image)}}" alt="{{$post->kategori->nama_kategori}}">
                        @endif
                    </div>
                    <button type="submit" class="text-white inline items-center bg-slate-800 hover:bg-slate-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Update
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('profileImagePreview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

</script>
