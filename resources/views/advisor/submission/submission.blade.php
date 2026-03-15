<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto py-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                    การอนุมัติยื่นสอบโครงงาน
                </h2>

                @if (session('success'))
                    <div
                        class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-green-800 dark:text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- ชื่อโครงงาน -->
                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">ชื่อโครงงาน</h4>
                    <p class="mt-1 text-gray-900 dark:text-white">{{ $propose->title }}</p>
                </div>

                <!-- สมาชิกกลุ่ม -->
                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">สมาชิกกลุ่มโครงงาน</h4>
                    <ul class="list-disc ml-5 mt-2">
                        @foreach ($members as $member)
                            <li class="text-gray-900 dark:text-white">
                                {{ $member->student->s_fname }} {{ $member->student->s_lname }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- ประเภทโครงงาน -->
                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">ประเภทโครงงาน</h4>
                    <p class="mt-1 text-gray-900 dark:text-white">{{ $propose->project_type->name }}</p>
                </div>

                <!-- ครั้งที่ส่งสอบ -->
                <div class="mb-4">
                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">ครั้งที่สอบ</h4>
                    <p class="mt-1 text-gray-900 dark:text-white">{{ $submission->attempt }}</p>
                </div>

                <!-- ไฟล์โครงงาน -->
                <div class="mb-6">
                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">ไฟล์โครงงาน</h4>
                    <a href="{{ route('advisor.submission.download', ['id' => $submission->first()?->id]) }}"
                        class="text-blue-600 hover:underline" download>
                        <img src="{{ asset('icons/pdf.png') }}" alt="PDF" width="48" height="48">
                    </a>
                </div>

                {{-- <div class="mb-6">
                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300">ไฟล์</h4>
                    <a href="{{ route('advisor.submission.download', ['id' => $examsubmission->first()?->id]) }}"
                        class="text-blue-600 hover:underline" download>
                        <img src="{{ asset('icons/pdf.png') }}" alt="PDF Icon" width="50" height="50">
                    </a>
                </div> --}}

                <!-- แบบฟอร์มอนุมัติ/ไม่อนุมัติ -->
                <form method="POST" action="{{ route('advisor.submission.save', ['id' => $submission->id]) }}"
                    class="mt-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            ผลการตรวจสอบ
                        </label>
                        <div class="flex items-center space-x-6 mt-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="approval" value="approved"
                                    class="text-green-500 focus:ring-green-500"
                                    {{ old('approval', $submission->status === 0 ? 'approved' : '') === 'approved' ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-900 dark:text-white">อนุมัติ</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="approval" value="rejected"
                                    class="text-red-500 focus:ring-red-500"
                                    {{ old('approval', $submission->status === 2 ? 'rejected' : '') === 'rejected' ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-900 dark:text-white">ไม่อนุมัติ</span>
                            </label>
                        </div>
                        @error('approval')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- textarea แสดงเฉพาะกรณีไม่อนุมัติ -->
                    <div id="reason-wrapper"
                        class="{{ old('approval', $submission->status === 2 ? 'rejected' : '') === 'rejected' ? '' : 'hidden' }}">
                        <label for="reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            เหตุผลการไม่อนุมัติ
                        </label>
                        <textarea name="reason" id="reason" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500
                               dark:bg-gray-700 dark:text-white dark:border-gray-600"></textarea>
                        @error('reason')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-4">
                        <button type="submit"
                            class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-md focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600">
                            บันทึก
                        </button>
                        <button type="button" onclick="window.location.href='{{ route('advisor.submission.index') }}'"
                            class="px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-md focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:bg-red-500 dark:hover:bg-red-600">
                            ยกเลิก
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle textarea เมื่อเลือก “ไม่อนุมัติ”
        document.addEventListener('DOMContentLoaded', () => {
            const approved = document.querySelector('input[value="approved"]');
            const rejected = document.querySelector('input[value="rejected"]');
            const wrapper = document.getElementById('reason-wrapper');

            approved.addEventListener('change', () => wrapper.classList.add('hidden'));
            rejected.addEventListener('change', () => wrapper.classList.remove('hidden'));
        });
    </script>

    <!-- Auto Resize Textarea Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('tools');
            // Adjust the height of the textarea based on its content
            textarea.style.height = "auto"; // Reset height
            textarea.style.height = (textarea.scrollHeight) + "px"; // Set height to fit content

            // Optional: Resize on input (if the field were editable)
            textarea.addEventListener('input', function() {
                textarea.style.height = "auto";
                textarea.style.height = (textarea.scrollHeight) + "px";
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: {!! json_encode(session('error')) !!}
                });
            @endif

            @if ($errors->any())
                const laravelErrors = {!! json_encode($errors->all()) !!};
                Swal.fire({
                    icon: 'error',
                    title: 'พบข้อผิดพลาด',
                    timer: 3000,
                    html: laravelErrors.map(e => `<div class="text-center">${e}</div>`).join('')
                });
            @endif
        });
    </script>
</x-app-layout>
