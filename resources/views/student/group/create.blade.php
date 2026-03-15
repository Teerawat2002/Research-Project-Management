<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded-md">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">สร้างกลุ่มโครงงาน</h3>

                    {{-- ฟอร์มค้นหา --}}
                    <form method="GET" action="{{ route('student.group.create') }}" class="mb-6 mt-4">
                        <div class="relative max-w-lg shadow-sm">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>

                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="ค้นหาชื่อ, นามสกุล หรือรหัสนักศึกษา..."
                                class="block w-full pl-10 pr-24 py-3 border-gray-200 rounded-xl border focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" />

                            <div class="absolute inset-y-0 right-0 flex items-center pr-1.5">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition duration-150">
                                    ค้นหา
                                </button>
                            </div>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('student.group.store') }}" class="mt-6">
                        @csrf

                        {{-- เลือกปีการศึกษา --}}
                        <div class="mb-4">
                            <label for="ac_id" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                                ปีการศึกษาของกลุ่ม
                            </label>
                            <select name="ac_id" id="ac_id"
                                class="w-full px-3 py-2 bg-white border border-gray-300 rounded-md focus:outline-none">
                                <option value="" disabled selected hidden>เลือกปีการศึกษา</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year->id }}"
                                        {{ old('ac_id') == $year->id ? 'selected' : '' }}>
                                        {{ $year->year }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ac_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- รายการเลือกนักศึกษา -->
                        <div class="mb-4">
                            <label for="students" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                                เลือกนักศึกษา
                            </label>

                            <div class="space-y-2">
                                @forelse ($students as $student)
                                    <div
                                        class="flex items-center ps-4 border border-gray-200 rounded-sm dark:border-gray-700 p-1">
                                        <input type="checkbox" id="student-{{ $student->id }}" name="students[]"
                                            value="{{ $student->id }}"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="student-{{ $student->id }}"
                                            class="w-full py-2 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            {{ $student->s_fname }} {{ $student->s_lname }} ({{ $student->s_id }})
                                        </label>
                                    </div>
                                @empty
                                    <p class="text-red-500 text-sm mt-4">
                                        ไม่พบข้อมูลนักศึกษา/ไม่พบข้อมูลนักศึกษาที่ยังไม่มีกลุ่ม</p>
                                @endforelse
                            </div>

                            <!-- pagination -->
                            <div class="mt-4">
                                {{ $students->links() }}
                            </div>
                        </div>

                        <!-- ปุ่มต่างๆ -->
                        <div class="flex justify-end space-x-4">
                            <button type="submit"
                                class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-700 focus:bg-blue-700 focus:outline-none">
                                สร้างกลุ่ม
                            </button>
                            <a href="{{ route('student.group.index') }}"
                                class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:bg-gray-700 focus:outline-none">
                                กลับ
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
