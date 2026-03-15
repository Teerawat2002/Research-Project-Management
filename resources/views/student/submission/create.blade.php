<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto py-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                    ยื่นสอบโครงงาน
                </h2>

                @if (session('success'))
                    <div
                        class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-green-800 dark:text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- ชื่อโครงงาน -->
                <div class="mb-6">
                    <label class="block text-md font-medium text-gray-700 dark:text-gray-300">
                        ชื่อโครงงาน
                    </label>
                    <p class="mt-1 text-gray-900 dark:text-white">{{ $propose->title }}</p>
                </div>

                <!-- สมาชิกกลุ่มโครงงาน -->
                <div class="mb-6">
                    <label class="block text-md font-medium text-gray-700 dark:text-gray-300">
                        สมาชิกกลุ่มโครงงาน
                    </label>
                    <ul class="list-disc ml-5 mt-2">
                        @forelse ($members as $member)
                            <li class="text-gray-900 dark:text-white">
                                {{ $member->student->s_fname }} {{ $member->student->s_lname }}
                            </li>
                        @empty
                            <li class="text-gray-500">ไม่พบสมาชิกในกลุ่มนี้</li>
                        @endforelse
                    </ul>
                </div>

                <!-- ฟอร์มยื่นสอบ -->
                <form method="POST" action="{{ route('student.submission.store', ['proposeId' => $propose->id]) }}"
                    enctype="multipart/form-data" class="mt-8">
                    @csrf

                    <!-- 1) ประเภทรายวิชา (ย้ายเข้าไปในฟอร์มแล้ว) -->
                    {{-- <div class="mb-6">
                        <label for="exam_type_id" class="block text-md font-medium text-gray-700 dark:text-gray-300">
                            ประเภทรายวิชา
                        </label>
                        <select name="exam_type_id" id="exam_type_id" required
                            class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50
                                       dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                            <option value="" disabled selected>-- เลือกประเภทรายวิชา --</option>
                            @foreach ($examTypes as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('exam_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('exam_type_id')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div> --}}

                    <div class="mb-6">
                        <label for="exam_type_id" class="block text-md font-medium text-gray-700 dark:text-gray-300">
                            ประเภทรายวิชา
                        </label>
                        <select name="exam_type_id" id="exam_type_id" required
                            class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50
                                    dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                            <option value="" disabled selected>-- เลือกประเภทรายวิชา --</option>
                            @foreach ($examTypes as $type)
                                <option value="{{ $type->id }}" data-name="{{ $type->name }}"
                                    {{ old('exam_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- 2) ครั้งที่สอบ -->
                    <div id="attemptSection" class="mb-6">
                        <label for="attempt" class="block text-md font-medium text-gray-700 dark:text-gray-300">
                            ครั้งที่สอบ
                        </label>
                        <input type="number" name="attempt" id="attempt" min="1" value="{{ old('attempt') }}"
                            class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50
                  dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                        @error('attempt')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- 3) อัพโหลดไฟล์ -->
                    <div id="fileSection" class="mb-6">
                        <label for="file" class="block text-md font-medium text-gray-700 dark:text-gray-300">
                            อัพโหลดไฟล์โครงงาน (PDF)
                        </label>
                        <input type="file" name="file" id="file" accept=".pdf"
                            class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer
                                      bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent
                                      dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                        <p class="mt-2 text-sm text-red-500 dark:text-red-400">
                            *** อัพโหลดไฟล์เป็น PDF เท่านั้น (ไม่เกิน 50MB) ***
                        </p>
                        @error('file')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ปุ่มบันทึก / ยกเลิก -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700
                                       focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            บันทึก
                        </button>
                        <button type="button" onclick="window.location.href='{{ route('student.submission.index') }}'"
                            class="ml-2 px-4 py-2 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700
                                       focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            ยกเลิก
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const examTypeSelect = document.getElementById("exam_type_id");
            const attemptSection = document.getElementById("attemptSection");
            const fileSection = document.getElementById("fileSection");

            function toggleFields() {
                const selectedOption = examTypeSelect.options[examTypeSelect.selectedIndex];
                const typeName = selectedOption.getAttribute("data-name");

                if (typeName === "Aucc") {
                    attemptSection.style.display = "none";
                    fileSection.style.display = "none";

                    document.getElementById("attempt").required = false;
                    document.getElementById("file").required = false;
                } else {
                    attemptSection.style.display = "block";
                    fileSection.style.display = "block";

                    document.getElementById("attempt").required = true;
                    document.getElementById("file").required = true;
                }
            }

            examTypeSelect.addEventListener("change", toggleFields);

            // run ครั้งแรกเผื่อมีค่า old
            toggleFields();
        });
    </script>

</x-app-layout>
