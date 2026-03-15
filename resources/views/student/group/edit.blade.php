<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-gray-500 dark:text-gray-400">แก้ไขกลุ่มโครงงาน</h3>

                    <!-- Student Search Form -->
                    <div class="mt-4">
                        <form method="GET" action="{{ route('student.group.edit', $group->id) }}"
                            class="mt-4 flex justify-between space-x-4">
                            @csrf

                            <input type="text" name="search" id="search" value="{{ $search }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="ค้นหาชื่อนักศึกษา...">

                            <button type="submit"
                                class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:bg-blue-700 focus:outline-none">
                                ค้นหา
                            </button>
                        </form>
                    </div>

                    <form method="POST" action="{{ route('student.group.update', $group->id) }}" class="mt-6">
                        @csrf
                        @method('PUT')

                        <!-- Student Selection Checkbox List -->
                        {{-- <div class="mb-4">
                            <label for="students" class="block text-sm font-medium text-white mb-2">
                                เลือกนักศึกษา
                            </label>

                            <div class="space-y-2">
                                @foreach ($students as $student)
                                    <div
                                        class="flex items-center ps-4 border border-gray-200 rounded-sm dark:border-gray-700 p-2">
                                        <input type="checkbox" id="student-{{ $student->id }}" name="students[]"
                                            value="{{ $student->id }}"
                                            @if (in_array($student->id, $currentMembers)) checked disabled @endif
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="student-{{ $student->id }}"
                                            class="w-full py-2 ms-4 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            {{ $student->s_fname }} {{ $student->s_lname }} {{ $student->s_id }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div> --}}

                        <!-- Assigned Students -->
                        <div class="mb-6">
                            <h4 class="text-lg font-semibold text-gray-500 dark:text-gray-400 mb-2">นักศึกษาในกลุ่ม</h4>
                            <div class="space-y-2">
                                @forelse ($assignedStudents as $student)
                                    <div
                                        class="flex items-center ps-4 border border-gray-200 rounded-sm dark:border-gray-700 p-2">
                                        <input type="checkbox" name="students[]" value="{{ $student->id }}"
                                            id="assigned-{{ $student->id }}" checked
                                            @if ($student->id === $stdLogin->id) disabled @endif
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 focus:ring-2" />
                                        <label for="assigned-{{ $student->id }}"
                                            class="w-full ms-4 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            {{ $student->s_fname }} {{ $student->s_lname }} ({{ $student->s_id }})
                                        </label>
                                    </div>
                                @empty
                                    <p class="text-gray-300">ยังไม่มีนักศึกษาในกลุ่มนี้</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Available Students -->
                        <div class="mb-4">
                            <h4 class="text-lg font-semibold text-gray-500 dark:text-gray-400 mb-2">นักศึกษาที่ยังไม่มีกลุ่ม</h4>
                            <div class="space-y-2">
                                @forelse ($availableStudents as $student)
                                    <div
                                        class="flex items-center ps-4 border border-gray-200 rounded-sm dark:border-gray-700 p-2">
                                        <input type="checkbox" name="students[]" value="{{ $student->id }}"
                                            id="available-{{ $student->id }}"
                                            class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                                        <label for="available-{{ $student->id }}"
                                            class="w-full ms-4 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            {{ $student->s_fname }} {{ $student->s_lname }} ({{ $student->s_id }})
                                        </label>
                                    </div>
                                @empty
                                    <p class="text-gray-300">ไม่มีนักศึกษาว่างให้เพิ่ม</p>
                                @endforelse
                            </div>

                            <!-- pagination -->
                            <div class="mt-4">
                                {{ $availableStudents->links() }}
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end space-x-4">
                            <button type="submit"
                                class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:bg-blue-700 focus:outline-none">
                                บันทึก
                            </button>
                            <a href="{{ route('student.group.index') }}"
                                class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:bg-gray-700 focus:outline-none">
                                ยกเลิก
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
