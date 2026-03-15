<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto py-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">{{ $proposal->title }}</h2>

                @if (session('success'))
                    <div
                        class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-green-800 dark:text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('advisor.propose.approve', $proposal->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Group Members -->
                    <div class="mb-6">
                        <label class="block text-md font-medium text-gray-700 dark:text-gray-300">สมาชิกกลุ่ม</label>
                        <ul class="list-disc ml-5 mt-2">
                            @forelse ($groupMembers as $member)
                                <li class="text-gray-900 dark:text-white">
                                    {{ $member->student->name ?? 'Unknown Student' }}</li>
                            @empty
                                <li class="text-gray-500">ไม่มีสมาชิกในกลุ่มนี้</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Title -->
                    <div class="mb-4">
                        <label for="title"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">ชื่อโครงงาน</label>
                        <input type="text" id="title" value="{{ $proposal->title }}"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            disabled>
                    </div>

                    <!-- Objective -->
                    <div class="mb-4">
                        <label for="objective"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">วัตถุประสงค์ของโครงงาน</label>
                        <textarea id="objective"
                            class="auto-expand block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            disabled>{{ $proposal->objective }}</textarea>
                    </div>

                    <!-- Scope -->
                    <div class="mb-4">
                        <label for="scope"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">ขอบเขตของโครงงาน</label>
                        <textarea id="scope"
                            class="auto-expand block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            disabled>{{ $proposal->scope }}</textarea>
                    </div>

                    <!-- Tools -->
                    <div class="mb-4">
                        <label for="tools"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">ภาษาและเครื่องมือที่ใช้ในการพัฒนาโครงงาน</label>
                        <textarea id="tools"
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
                        {{-- <ul class="mt-2">
                            <li class="text-gray-900 dark:text-white">
                                {{ $proposal->project_type->name }}</li>

                        </ul> --}}
                    </div>

                    <!-- Approval Checkbox -->
                    <div class="mb-4">
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">สถานะการอนุมัติ</label>
                        <div class="flex items-center space-x-4 mt-2">
                            <!-- Approve Radio Button -->
                            <label class="flex items-center">
                                <input type="radio" name="approval" value="approved" id="approved"
                                    class="text-blue-500 focus:ring-blue-500"
                                    {{ $proposal->status == 0 ? 'checked' : '' }} disabled>
                                <span class="ml-2 text-gray-900 dark:text-white">อนุมัติ</span>
                            </label>

                            <!-- Reject Radio Button -->
                            <label class="flex items-center">
                                <input type="radio" name="approval" value="rejected" id="rejected"
                                    class="text-red-500 focus:ring-red-500"
                                    {{ $proposal->status == 2 ? 'checked' : '' }} disabled>
                                <span class="ml-2 text-gray-900 dark:text-white">ไม่อนุมัติ</span>
                            </label>
                        </div>
                        @error('approval')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rejection Reason -->
                    <div class="mb-4" id="rejection-reason"
                        style="display: {{ $proposal->status == 2 ? 'block' : 'none' }};">
                        <label for="reason"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">ความคิดเห็น</label>
                        <textarea name="reason" id="reason" rows="4"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            disabled>{{ $proposal->comments }}</textarea>
                        @error('reason')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Back Button -->
                    <div class="mt-4 flex justify-end">
                        <button type="button" onclick="window.location.href='{{ route('advisor.propose.index') }}'"
                            class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                            กลับ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toggle Textarea Visibility -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rejectedRadio = document.getElementById('rejected');
            const approvedRadio = document.getElementById('approved');
            const rejectionReason = document.getElementById('rejection-reason');

            // Initially set the visibility based on the current status
            if (rejectedRadio.checked) {
                rejectionReason.style.display = 'block';
            } else {
                rejectionReason.style.display = 'none';
            }

            // Toggle visibility based on the selected radio button
            rejectedRadio.addEventListener('change', function() {
                rejectionReason.style.display = 'block';
            });

            approvedRadio.addEventListener('change', function() {
                rejectionReason.style.display = 'none';
            });
        });
    </script>


    {{-- <script>
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
    </script> --}}

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

</x-app-layout>
