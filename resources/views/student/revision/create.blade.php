<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                <div class="p-6">
                    {{-- หัวเรื่อง --}}
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-300">
                        สร้างรายการยื่นแก้ไข
                    </h3>

                    {{-- ฟอร์มสร้าง --}}
                    <form action="{{ route('student.revision.store', ['submission' => $submission->id]) }}" method="POST"
                        enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf

                        {{-- ไฟล์แนบ --}}
                        <div>
                            <label for="file_path" class="block font-medium text-gray-700 dark:text-gray-300 mb-1">
                                แนบไฟล์เอกสาร
                            </label>
                            <input type="file" name="file_path" id="file_path"
                                class="block w-full text-md text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                            @error('file_path')
                                <p class="mt-1 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- รายละเอียดการแก้ไข --}}
                        <div>
                            <label for="edit_detail" class="block font-medium text-gray-700 dark:text-gray-300">
                                รายละเอียดการแก้ไข
                            </label>
                            <textarea name="edit_detail" id="edit_detail" rows="5"
                                class="mt-1 block w-full p-2.5 border-gray-300 rounded-md shadow-sm text-gray-900
                                             focus:ring-blue-500 focus:border-blue-500 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                                placeholder="อธิบายสิ่งที่แก้ไขตามที่คณะกรรมการเสนอ...">{{ old('edit_detail') }}</textarea>
                            @error('edit_detail')
                                <p class="mt-1 text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- ปุ่มบันทึก --}}
                        <div class="flex items-center space-x-4">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2 bg-blue-600 text-white font-medium
                                           rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                บันทึก
                            </button>
                            <a href="{{ route('student.revision.index', $submission->id) }}"
                                class="inline-flex items-center px-6 py-2 bg-gray-300 text-gray-700 font-medium
                                      rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                ยกเลิก
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- SweetAlert แจ้งผล --}}
    {{-- <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: "{{ session('success') }}",
                confirmButtonText: 'ตกลง'
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: "{{ $errors->first() }}",
                confirmButtonText: 'ตกลง'
            });
        @endif
    </script> --}}
</x-app-layout>
