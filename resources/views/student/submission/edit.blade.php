<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto py-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                    แก้ไขการยื่นสอบโครงงาน
                </h2>

                @if (session('success'))
                    <div
                        class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-green-800 dark:text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- ข้อมูลโครงงาน -->
                <div class="mb-6">
                    <label class="block text-md font-medium text-gray-700 dark:text-gray-300">ชื่อโครงงาน</label>
                    <p class="mt-1 text-gray-900 dark:text-white">{{ $propose->title }}</p>
                </div>

                <!-- สมาชิกกลุ่ม -->
                <div class="mb-6">
                    <label class="block text-md font-medium text-gray-700 dark:text-gray-300">สมาชิกกลุ่มโครงงาน</label>
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

                <!-- ประเภทโครงงาน -->
                <div class="mb-6">
                    <label class="block text-md font-medium text-gray-700 dark:text-gray-300">ประเภทโครงงาน</label>
                    <p class="mt-1 text-gray-900 dark:text-white">{{ $propose->project_type->name }}</p>
                </div>

                <!-- ฟอร์มแก้ไข -->
                <form method="POST"
                    action="{{ route('student.submission.update', ['submissionId' => $submission->id, 'proposeId' => $submission->propose->id]) }}"
                    enctype="multipart/form-data" class="mt-8">
                    @csrf
                    @method('PUT')

                    <!-- เลือกประเภทรายวิชา -->
                    <div class="mb-6">
                        <label for="exam_type_id" class="block text-md font-medium text-gray-700 dark:text-gray-300">
                            ประเภทรายวิชา
                        </label>
                        <select name="exam_type_id" id="exam_type_id" required
                            class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50
                             dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                            <option value="" disabled>-- เลือกประเภทรายวิชา --</option>
                            @foreach ($examTypes as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('exam_type_id', $submission->exam_type_id) == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('exam_type_id')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ครั้งที่สอบ -->
                    <div class="mb-6">
                        <label for="attempt" class="block text-md font-medium text-gray-700 dark:text-gray-300">
                            ครั้งที่สอบ
                        </label>
                        <input type="number" name="attempt" id="attempt" min="1"
                            value="{{ old('attempt', $submission->attempt) }}" required
                            class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50
                            dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                        @error('attempt')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ไฟล์เดิมและอัพโหลดใหม่ -->
                    <div class="mb-6">
                        <label class="block text-md font-medium text-gray-700 dark:text-gray-300">
                            ไฟล์โครงงานปัจจุบัน
                        </label>
                        <p class="mt-1">
                            <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank"
                                class="text-blue-600 hover:underline">
                                ดูไฟล์ PDF ที่อัปโหลดแล้ว
                            </a>
                        </p>
                    </div>
                    <div class="mb-6">
                        <label for="file" class="block text-md font-medium text-gray-700 dark:text-gray-300">
                            อัพโหลดไฟล์โครงงานใหม่ (PDF)
                        </label>
                        <input type="file" name="file" id="file" accept=".pdf"
                            class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer
                            bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent
                            dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">
                        <p class="mt-2 text-sm text-red-500 dark:text-red-500">
                            *** ถ้าไม่เลือก ไฟล์เดิมจะยังไม่ถูกเปลี่ยน ***
                        </p>
                        @error('file')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ความคิดเห็น -->
                    <div class="mb-6">
                        <label for="comments" class="block text-md font-medium text-gray-700 dark:text-gray-300">
                            ความคิดเห็น
                        </label>
                        <textarea name="comments" id="comments" rows="4" readonly
                            class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50
                            dark:bg-gray-700 dark:border-gray-600 dark:text-gray-400">{{ old('comments', $submission->comments) }}</textarea>
                        @error('comments')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ปุ่มบันทึก / ยกเลิก -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700
                             focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            บันทึกการแก้ไข
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
</x-app-layout>
