<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-300">
                        แก้ไขรายการยื่นแก้ไข
                    </h3>

                    <div>
                        <label for="file_path" class="block font-medium text-gray-700 dark:text-gray-300 mt-4">
                            ไฟล์เอกสารที่แก้ไข
                        </label>

                        <a href="{{ route('invigilator.revision.download', ['id' => $revisions->first()?->id]) }}"
                            target="_blank" class="text-blue-600 hover:underline" download>
                            <img src="{{ asset('icons/pdf.png') }}" alt="PDF Icon" class="w-8 h-8 mr-2">
                        </a>

                    </div>

                    {{-- รายละเอียดการแก้ไข --}}
                    <div class="mt-2">
                        <label for="edit_detail" class="block font-medium text-gray-700 dark:text-gray-300">
                            รายละเอียดการแก้ไข
                        </label>
                        <textarea name="edit_detail" id="edit_detail" rows="2"
                            class="auto-expand mt-1 block w-full p-2.5 border-gray-300 rounded-md shadow-sm text-gray-900
                                             focus:ring-blue-500 focus:border-blue-500 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                            placeholder="อธิบายสิ่งที่แก้ไขตามที่คณะกรรมการเสนอ..." disabled>{{ old('edit_detail', $revisions->edit_detail) }}</textarea>
                    </div>

                    <form action="{{ route('invigilator.revision.update', $revisions->id) }}" method="POST"
                        enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block font-medium text-gray-700 dark:text-gray-300">
                                ผลการตรวจสอบ
                            </label>
                            <div class="flex items-center space-x-6 mt-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="approval" value="approved"
                                        class="text-green-500 focus:ring-green-500"
                                        {{ old('approval', $revisions->status === 3 ? 'approved' : '') === 'approved' ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-900 dark:text-white">อนุมัติ</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="approval" value="rejected"
                                        class="text-red-500 focus:ring-red-500"
                                        {{ old('approval', $revisions->status === 2 ? 'rejected' : '') === 'rejected' ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-900 dark:text-white">ไม่อนุมัติ</span>
                                </label>
                            </div>
                            @error('approval')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- <!-- textarea แสดงเฉพาะกรณีไม่อนุมัติ -->
                        <div id="reason-wrapper"
                            class="{{ old('approval', $revisions->status === 2 ? 'rejected' : '') === 'rejected' ? '' : 'hidden' }}">
                            <label for="reason" class="block font-medium text-gray-700 dark:text-gray-300">
                                เหตุผลการไม่อนุมัติ
                            </label>
                            <textarea name="reason" id="reason" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500
                               dark:bg-gray-700 dark:text-white dark:border-gray-600"></textarea>
                            @error('reason')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div> --}}

                        {{-- ปุ่มบันทึก / ยกเลิก --}}
                        <div class="flex items-center space-x-4">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2 bg-blue-600 text-white font-medium
                                           rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                บันทึก
                            </button>
                            <a href="{{ route('invigilator.revision.index') }}"
                                class="inline-flex items-center px-6 py-2 bg-white text-gray-700 font-medium
                                      rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                ยกเลิก
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        // Toggle textarea เมื่อเลือก “ไม่อนุมัติ”
        document.addEventListener('DOMContentLoaded', () => {
            const approved = document.querySelector('input[value="approved"]');
            const rejected = document.querySelector('input[value="rejected"]');
            const wrapper = document.getElementById('reason-wrapper');

            approved.addEventListener('change', () => wrapper.classList.add('hidden'));
            rejected.addEventListener('change', () => wrapper.classList.remove('hidden'));
        });
    </script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.auto-expand').forEach(function(textarea) {
                function adjustHeight(el) {
                    el.style.height = "auto"; // รีเซ็ตก่อน
                    el.style.height = (el.scrollHeight) + "px"; // ตั้งค่าความสูงให้พอดีกับเนื้อหา
                }

                adjustHeight(textarea); // ปรับขนาดเมื่อโหลดหน้า

                textarea.addEventListener("input", function() {
                    adjustHeight(textarea);
                });
            });
        });
    </script>
</x-app-layout>
