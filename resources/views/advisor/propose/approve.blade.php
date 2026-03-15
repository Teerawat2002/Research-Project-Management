<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto py-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">การอนุมัติเสนอหัวข้อ</h2>

                @if (session('success'))
                    <div
                        class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-green-800 dark:text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('advisor.propose.approve', $proposal->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- สมาชิกกลุ่ม -->
                    <div class="mb-6">
                        <label class="block text-md font-medium text-gray-700 dark:text-gray-300">สมาชิกกลุ่ม</label>
                        <ul class="list-disc ml-5 mt-2">
                            @forelse ($groupMembers as $member)
                                <li class="text-gray-900 dark:text-white">
                                    {{ $member->student->name ?? 'นักศึกษาที่ไม่รู้จัก' }}</li>
                            @empty
                                <li class="text-gray-500">ไม่มีสมาชิกในกลุ่มนี้</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- ชื่อโครงงาน -->
                    <div class="mb-4">
                        <label for="title"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">ชื่อโครงงาน</label>
                        <input type="text" id="title" value="{{ $proposal->title }}"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            disabled>
                    </div>

                    <!-- วัตถุประสงค์ -->
                    <div class="mb-4">
                        <label for="objective"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">วัตถุประสงค์</label>
                        <textarea id="objective" rows="1"
                            class="auto-expand block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            disabled>{{ $proposal->objective }}</textarea>
                    </div>

                    <!-- ขอบเขต -->
                    <div class="mb-4">
                        <label for="scope"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">ขอบเขต</label>
                        <textarea id="scope" rows="1"
                            class="auto-expand block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            disabled>{{ $proposal->scope }}</textarea>
                    </div>

                    <!-- เครื่องมือ -->
                    <div class="mb-4">
                        <label for="tools"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">เครื่องมือ</label>
                        <textarea id="tools" rows="1"
                            class="auto-expand block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            disabled>{{ $proposal->tools }}</textarea>
                    </div>

                    <!-- ประเภทโครงงาน -->
                    <div class="mb-6">
                        <label for="type_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            ประเภทโครงงาน
                        </label>

                        {{-- กรณีแสดงเท่านั้น --}}
                        {{-- <input type="text" id="type_id" value="{{ $proposal->exam_type->name }}" disabled
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600"> --}}
                        <ul class="mt-2">
                            <li class="text-gray-900 dark:text-white">
                                {{ $proposal->project_type->name }}</li>

                        </ul>
                    </div>

                    <!-- ตัวเลือกการอนุมัติ -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">การอนุมัติ</label>
                        <div class="flex items-center space-x-4 mt-2">
                            <label class="flex items-center">
                                <input type="radio" name="approval" value="approved" id="approved"
                                    class="text-blue-500 focus:ring-blue-500">
                                <span class="ml-2 text-gray-900 dark:text-white">อนุมัติ</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="approval" value="rejected" id="rejected"
                                    class="text-red-500 focus:ring-red-500">
                                <span class="ml-2 text-gray-900 dark:text-white">ปฏิเสธ</span>
                            </label>
                        </div>
                        @error('approval')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- เหตุผลในการปฏิเสธ -->
                    <div class="mb-4 hidden" id="rejection-reason">
                        <label for="reason"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">เหตุผลในการปฏิเสธ</label>
                        <textarea name="reason" id="reason" rows="4"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"></textarea>
                        @error('reason')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- <!-- ปุ่มต่างๆ -->
                    <div class="flex justify-end space-x-4">
                        <button type="submit"
                            class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:bg-blue-700 focus:outline-none">
                            ส่ง
                        </button>
                        <a href="{{ route('advisor.propose.index') }}"
                            class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:bg-gray-700 focus:outline-none">
                            ย้อนกลับ
                        </a>
                    </div> --}}

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-4">
                        <button type="submit"
                            class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-md focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600">
                            บันทึก
                        </button>
                        <button type="button" onclick="window.location.href='{{ route('advisor.propose.index') }}'"
                            class="px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-md focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:bg-red-500 dark:hover:bg-red-600">
                            ยกเลิก
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.auto-expand').forEach(function(textarea) {
                textarea.style.height = "auto";
                textarea.style.height = textarea.scrollHeight + "px";
            });
        });
    </script> --}}

    <!-- แสดง/ซ่อนเหตุผลในการปฏิเสธ -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const rejectedRadio = document.getElementById('rejected');
            const approvedRadio = document.getElementById('approved');
            const rejectionReason = document.getElementById('rejection-reason');

            rejectedRadio.addEventListener('change', () => {
                rejectionReason.classList.remove('hidden');
            });

            approvedRadio.addEventListener('change', () => {
                rejectionReason.classList.add('hidden');
            });
        });
    </script>

    <!-- สคริปต์ปรับขนาด textarea -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.auto-expand').forEach(textarea => {
                const adjust = el => {
                    // รีเซ็ตความสูงเดิม
                    el.style.height = 'auto';
                    // ดึงความสูงบรรทัดจาก CSS
                    const lineHeight = parseInt(window.getComputedStyle(el).lineHeight);
                    // ปรับความสูง = ความสูงเนื้อหา + 1 row เพิ่มเติม
                    el.style.height = (el.scrollHeight + lineHeight) + 'px';
                };
                // เรียกปรับขนาดตอนโหลดครั้งแรก
                adjust(textarea);
                // เรียกปรับขนาดทุกครั้งที่มีการพิมพ์
                textarea.addEventListener('input', () => adjust(textarea));
            });
        });
    </script>

    <!-- SweetAlert2 for error notifications -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: {!! json_encode(session('error')) !!}
                });
            @endif

            @if($errors->any())
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
