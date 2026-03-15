<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-2xl font-bold text-white dark:text-white">
                    <i class="fa-solid fa-folder-plus mr-2 text-blue-600"></i> เพิ่มโครงงานวิจัยใหม่
                </h2>
                <a href="{{ route('admin.alumni.project.index') }}"
                    class="text-gray-300 hover:text-gray-500 dark:text-gray-400 dark:hover:text-white">
                    <i class="fa-solid fa-arrow-left"></i> ย้อนกลับ
                </a>
            </div>

            <form action="{{ route('admin.alumni.project.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 mb-6 border-l-4 border-blue-500">
                    <h3
                        class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        1. ข้อมูลทั่วไปของโครงงาน (Project Information)
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label for="title"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อโครงงาน
                                (ภาษาไทย) <span class="text-red-500">*</span></label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @error('title')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label for="keyword"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">คำสำคัญ
                                <span class="text-red-500">*</span></label>
                            <input type="text" id="keyword" name="keyword" value="{{ old('keyword') }}" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>

                        <div>
                            <label for="project_type_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ประเภทโครงงาน <span
                                    class="text-red-500">*</span></label>
                            <select id="project_type_id" name="project_type_id" data-placeholder="เลือกประเภทโครงงาน"
                                required class="select2 w-full">
                                <option value=""></option>
                                @foreach ($project_types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('project_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="academic_year"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ปีการศึกษา <span
                                    class="text-red-500">*</span></label>
                            <select id="academic_year" name="academic_year" data-placeholder="เลือกปีการศึกษา" required
                                class="select2 w-full">
                                <option value=""></option>
                                @foreach ($academicYears as $year)
                                    <option value="{{ $year->id }}"
                                        {{ old('academic_year') == $year->id ? 'selected' : '' }}>
                                        {{ $year->year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 mb-6 border-l-4 border-purple-500">
                    <h3
                        class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        2. ไฟล์โครงงาน (Project Files)
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        {{-- ปกโครงงาน --}}
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                ปกโครงงาน (รูปภาพ) <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="cover_file" accept="image/png,image/jpeg,image/webp" required
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50
                       dark:text-white dark:bg-gray-700 dark:border-gray-600" />
                            <p class="text-xs text-gray-500 mt-1">รองรับ JPG, PNG, WEBP</p>

                            @error('cover_file')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Abstract --}}
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                ไฟล์ Abstract (PDF) <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="abstract_file" accept="application/pdf" required
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50
                       dark:text-white dark:bg-gray-700 dark:border-gray-600">
                            @error('abstract_file')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- ไฟล์โครงงาน --}}
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                ไฟล์โครงงาน (PDF) <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="project_file" accept="application/pdf" required
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50
                       dark:text-white dark:bg-gray-700 dark:border-gray-600">
                            @error('project_file')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 mb-6 border-l-4 border-green-500">
                    <h3
                        class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                        3. ข้อมูลผู้จัดทำและที่ปรึกษา (Members & Advisor)
                    </h3>

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                <i class="fa-solid fa-user-tie mr-1"></i>อาจารย์ที่ปรึกษา
                                (Advisor)<span class="text-red-500">*</span></label>
                            <select name="advisor_id" required data-placeholder="เลือกอาจารย์ที่ปรึกษา"
                                class="select2-search">
                                <option value="">-- ค้นหาอาจารย์ --</option>
                                @foreach ($advisors as $advisor)
                                    <option value="{{ $advisor->id }}"
                                        {{ old('advisor_id') == $advisor->id ? 'selected' : '' }}>
                                        {{ $advisor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- <hr class="border-gray-200 dark:border-gray-700"> --}}

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                <i class="fa-solid fa-user-plus mr-1"></i> เพิ่มนักศึกษาเข้าโครงงาน
                                (Members)<span class="text-red-500">*</span>
                            </label>

                            <div class="flex gap-2 mb-4">
                                <select name="student_ids[]" multiple data-placeholder="เลือกได้หลายคน" required
                                    class="select2-multi">
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">
                                            {{ $student->s_id }} - {{ $student->s_fname }}
                                            {{ $student->s_lname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-2">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        <i class="fa-solid fa-save mr-1"></i> บันทึกข้อมูล
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
