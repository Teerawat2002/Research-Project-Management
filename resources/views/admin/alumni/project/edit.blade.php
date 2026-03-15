<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-2xl font-bold text-white dark:text-white">
                    <i class="fa-solid fa-pen-to-square mr-2 text-yellow-500"></i>
                    แก้ไขโครงงานวิจัยศิษย์เก่า
                </h2>
                <a href="{{ route('admin.alumni.project.index') }}"
                    class="text-gray-300 hover:text-gray-500 dark:text-gray-400 dark:hover:text-white">
                    <i class="fa-solid fa-arrow-left"></i> ย้อนกลับ
                </a>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.alumni.project.update', $alumniProject->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- =========================
                    1. ข้อมูลทั่วไป
                ========================= --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 mb-6 border-l-4 border-blue-500">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b">
                        1. ข้อมูลทั่วไปของโครงงาน
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="block mb-2 text-sm text-gray-900 dark:text-white font-medium">
                                ชื่อโครงงาน <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" value="{{ old('title', $alumniProject->title) }}"
                                required class="w-full rounded-lg border p-2.5">
                            @error('title')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label class="block mb-2 text-sm text-gray-900 dark:text-white font-medium">
                                คำสำคัญ <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="keyword" value="{{ old('keyword', $alumniProject->keyword) }}"
                                required class="w-full rounded-lg border p-2.5">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-gray-900 dark:text-white font-medium">
                                ประเภทโครงงาน <span class="text-red-500">*</span>
                            </label>
                            <select name="project_type_id" class="select2 w-full" required>
                                @foreach ($project_types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('project_type_id', $alumniProject->project_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-gray-900 dark:text-white font-medium">
                                ปีการศึกษา <span class="text-red-500">*</span>
                            </label>
                            <select name="academic_year" class="select2 w-full" required>
                                @foreach ($academicYears as $year)
                                    <option value="{{ $year->id }}"
                                        {{ old('academic_year', $alumniProject->projectGroup->ac_id ?? '') == $year->id ? 'selected' : '' }}>
                                        {{ $year->year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- =========================
                    2. ไฟล์โครงงาน
                ========================= --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 mb-6 border-l-4 border-purple-500">
                    <h3 class="text-lg text-gray-900 dark:text-white font-semibold mb-4 pb-2 border-b">
                        2. ไฟล์โครงงาน
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        {{-- Cover --}}
                        <div>
                            <label
                                class="block mb-2 text-sm text-gray-900 dark:text-white font-medium">ปกโครงงาน</label>
                            <input type="file" name="cover_file" accept="image/*"
                                class="block w-full text-sm border rounded-lg">

                            @if ($uploadFile?->cover_file)
                                <p class="text-xs mt-1">
                                    <a href="{{ asset('storage/' . $uploadFile->cover_file) }}" target="_blank"
                                        class="text-blue-600 underline">
                                        ดูไฟล์ปัจจุบัน
                                    </a>
                                </p>
                            @endif
                        </div>

                        {{-- Abstract --}}
                        <div>
                            <label class="block mb-2 text-sm text-gray-900 dark:text-white font-medium">Abstract
                                (PDF)</label>
                            <input type="file" name="abstract_file" accept="application/pdf"
                                class="block w-full text-sm border rounded-lg">

                            @if ($uploadFile?->abstract_file)
                                <p class="text-xs mt-1">
                                    <a href="{{ asset('storage/' . $uploadFile->abstract_file) }}" target="_blank"
                                        class="text-blue-600 underline">
                                        ดูไฟล์ปัจจุบัน
                                    </a>
                                </p>
                            @endif
                        </div>

                        {{-- Project --}}
                        <div>
                            <label class="block mb-2 text-sm text-gray-900 dark:text-white font-medium">ไฟล์โครงงาน
                                (PDF)</label>
                            <input type="file" name="project_file" accept="application/pdf"
                                class="block w-full text-sm border rounded-lg">

                            @if ($uploadFile?->project_file)
                                <p class="text-xs mt-1">
                                    <a href="{{ asset('storage/' . $uploadFile->project_file) }}" target="_blank"
                                        class="text-blue-600 underline">
                                        ดูไฟล์ปัจจุบัน
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- =========================
                    3. สมาชิก & ที่ปรึกษา
                ========================= --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 mb-6 border-l-4 border-green-500">
                    <h3 class="text-lg text-gray-900 dark:text-white font-semibold mb-4 pb-2 border-b">
                        3. ผู้จัดทำและอาจารย์ที่ปรึกษา
                    </h3>

                    <div class="space-y-6">
                        <div>
                            <label class="block mb-2 text-sm text-gray-900 dark:text-white font-medium">
                                อาจารย์ที่ปรึกษา <span class="text-red-500">*</span>
                            </label>
                            <select name="advisor_id" class="select2-search w-full" required>
                                @foreach ($advisors as $advisor)
                                    <option value="{{ $advisor->id }}"
                                        {{ old('advisor_id', $alumniProject->advisor_id) == $advisor->id ? 'selected' : '' }}>
                                        {{ $advisor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm text-gray-900 dark:text-white font-medium">
                                นักศึกษาในโครงงาน <span class="text-red-500">*</span>
                            </label>
                            <select name="student_ids[]" multiple class="select2-multi w-full" required>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}"
                                        {{ in_array($student->id, $selectedStudents) ? 'selected' : '' }}>
                                        {{ $student->s_id }} - {{ $student->s_fname }} {{ $student->s_lname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end gap-2">
                    <button type="submit" class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 focus:outline-none dark:focus:ring-yellow-800">
                        <i class="fa-solid fa-save mr-1"></i> บันทึกการแก้ไข
                    </button>
                    <a href="{{ route('admin.alumni.project.index') }}"
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-300 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        ยกเลิก
                    </a>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
