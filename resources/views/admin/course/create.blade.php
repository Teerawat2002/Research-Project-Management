<x-app-layout>
    <div class="mt-16 py-8">
        <div class="p-6 text-gray-900">
            <div class="max-w-md mx-auto bg-gray-50 dark:bg-gray-800 p-6 shadow-lg rounded-lg">
                <h1 class="text-2xl text-gray-900 dark:text-white font-bold mb-4">เพิ่มรายวิชา</h1>
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="text-red-500 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- @if ($errors->has('year'))
                    <script>
                        Swal.fire({
                            title: 'Error!',
                            text: '{{ $errors->first('year') }}',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif --}}


                <form action="{{ route('admin.course.store') }}" method="POST" class="max-w-sm mx-auto">
                    @csrf
                    {{-- ชื่อรายวิชา --}}
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        ชื่อรายวิชา
                    </label>

                    <div class="flex">
                        <input type="text" id="name" name="name" required
                            placeholder="เช่น โครงงานคอมพิวเตอร์ 1" value="{{ old('name') }}"
                            class="rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" />
                    </div>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div class="mt-6 flex justify-start">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mr-4">
                            บันทึก
                        </button>
                        <a class="button px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                            href="{{ route('admin.course.index') }}"
                            class="text-gray-600 hover:text-gray-800 mr-4">ยกเลิก</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
