<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto py-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">แก้ไขข้อมูลการเสนอหัวข้อ</h2>

                @if (session('success'))
                    <div
                        class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-green-800 dark:text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('student.propose.update', $proposal->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-4">
                        <label for="title"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">ชื่อหัวข้อที่นำเสนอ</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $proposal->title) }}"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500"
                            required>
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Objective -->
                    <div class="mb-4">
                        <label for="objective"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">วัตถุประสงค์ของโครงงาน</label>
                        <textarea name="objective" id="objective"
                            class="auto-expand block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500"
                            required>{{ old('objective', $proposal->objective) }}</textarea>
                        @error('objective')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Scope -->
                    <div class="mb-4">
                        <label for="scope"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">ขอบเขตของโครงงาน</label>
                        <textarea name="scope" id="scope"
                            class="auto-expand block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500"
                            required>{{ old('scope', $proposal->scope) }}</textarea>
                        @error('scope')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tools -->
                    <div class="mb-4">
                        <label for="tools"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">ภาษาและเครื่องมือที่ใช้ในการพัฒนาโครงงาน</label>
                        <textarea name="tools" id="tools"
                            class="auto-expand block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500">{{ old('tools', $proposal->tools) }}</textarea>
                        @error('tools')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Propose Type -->
                    <div class="mb-4">
                        <label for="type_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            ประเภทหัวข้อ
                        </label>
                        <select name="type_id" id="type_id"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500"
                            required>
                            <option value="" disabled>เลือกประเภทหัวข้อ</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('type_id', $proposal->type_id) == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('type_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Advisor -->
                    <div class="mb-4">
                        <label for="a_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">อาจารย์ที่ปรึกษา</label>
                        <select name="a_id" id="a_id"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500"
                            required>
                            <option value="" disabled>เลือกอาจารย์ที่ปรึกษา</option>
                            @foreach ($advisors as $advisor)
                                <option value="{{ $advisor->id }}"
                                    {{ $advisor->id == old('a_id', $proposal->a_id) ? 'selected' : '' }}>
                                    {{ $advisor->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('a_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Advisor Comment -->
                    <div class="mb-4">
                        <label for="comment"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">ความเห็นของอาจารย์ที่ปรึกษา</label>
                        <textarea id="comment" rows="4" disabled
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500">{{ $proposal->comments ?? 'ไม่มีความคิดเห็น' }}</textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-4">
                        <button type="submit"
                            class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-md focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600">
                            บันทึก
                        </button>
                        <button type="button" onclick="window.location.href='{{ route('student.propose.index') }}'"
                            class="px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-md focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:bg-red-500 dark:hover:bg-red-600">
                            ยกเลิก
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.auto-expand').forEach(function(textarea) {
                // ปรับขนาดให้พอดีกับเนื้อหาตอนโหลดหน้า
                function adjustHeight(el) {
                    el.style.height = "auto"; // รีเซ็ตความสูงก่อน
                    el.style.height = (el.scrollHeight) + "px"; // ตั้งค่าความสูงให้พอดีกับเนื้อหา
                }

                adjustHeight(textarea); // เรียกใช้ตอนโหลดหน้า

                // ปรับความสูงเมื่อพิมพ์ข้อมูลเพิ่ม
                textarea.addEventListener("input", function() {
                    adjustHeight(textarea);
                });
            });
        });
    </script>

</x-app-layout>
