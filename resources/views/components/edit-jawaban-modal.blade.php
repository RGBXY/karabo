<div id="edit-modals-{{$jawaban->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto fixed overflow-x-hidden top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full lg:w-[50rem] md:max-w-[80rem]  max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                <h3 class="text-lg font-semibold text-gray-900">
                    Edit Pertanyaan {{$jawaban->id}}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-toggle="edit-modals-{{$jawaban->id}}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{route('jawaban.update', ['jawaban' => $jawaban])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="flex flex-col gap-5 p-5">
                    <div>
                        <label for="editor-jawaban-{{$jawaban->id}}" class="block mb-2 text-sm font-medium text-gray-900">Jawaban</label>
                        <textarea id="editor-jawaban-{{$jawaban->id}}" required name="jawaban_konten" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 ">{!!$jawaban->jawaban_konten!!}</textarea>
                    </div>
                    <button type="submit" class="text-white inline items-center bg-black font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Update
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
