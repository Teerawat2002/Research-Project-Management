<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">แก้ไขข้อมูลนักศึกษา</h3>

                    <form method="POST" action="{{ route('admin.student.update', $student->id) }}" class="mt-6">
                        @csrf
                        @method('PUT')

                        <!-- Student ID -->
                        <div class="mb-4">
                            <label for="s_id"
                                class="block text-sm font-medium text-gray-900 dark:text-white">รหัสนักศึกษา</label>
                            <input type="text" id="s_id" name="s_id" required
                                value="{{ old('s_id', $student->s_id) }}"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md">
                            @error('s_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- First Name -->
                        <div class="mb-4">
                            <label for="s_fname"
                                class="block text-sm font-medium text-gray-900 dark:text-white">ชื่อ</label>
                            <input type="text" id="s_fname" name="s_fname" required
                                value="{{ old('s_fname', $student->s_fname) }}"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md">
                            @error('s_fname')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div class="mb-4">
                            <label for="s_lname"
                                class="block text-sm font-medium text-gray-900 dark:text-white">นามสกุล</label>
                            <input type="text" id="s_lname" name="s_lname" required
                                value="{{ old('s_lname', $student->s_lname) }}"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md">
                            @error('s_lname')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password (Optional) -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-900 dark:text-white">
                                Password (เว้นว่างไว้ถ้าใช้รหัสผ่านเดิม)
                            </label>
                            <input type="password" id="password" name="password"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md">
                            @error('password')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md">
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status"
                                class="block text-sm font-medium text-gray-900 dark:text-white">สถานะ</label>
                            <select id="status" name="status" required aria-placeholder="เลือกสถานะ"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                                {{-- <option value="" disabled>-- เลือกสถานะ --</option> --}}

                                <option value="active"
                                    {{ old('status', $student->status) === 'active' ? 'selected' : '' }}>
                                    ปกติ
                                </option>

                                <option value="graduated"
                                    {{ old('status', $student->status) === 'graduated' ? 'selected' : '' }}>
                                    จบการศึกษา
                                </option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Major -->
                        <div class="mb-8">
                            <label for="m_id"
                                class="block text-sm font-medium text-gray-900 dark:text-white">สาขาวิชา</label>
                            <select id="m_id" name="m_id" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md">
                                {{-- <option value="" disabled>เลือกสาขาวิชา</option> --}}
                                @foreach ($majors as $major)
                                    <option value="{{ $major->id }}"
                                        {{ old('m_id', $student->m_id) == $major->id ? 'selected' : '' }}>
                                        {{ $major->m_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('m_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Academic Year -->
                        {{-- <div class="mb-4">
                            <label for="ac_id" class="block text-sm font-medium text-gray-900 dark:text-white">ปีการศึกษา</label>
                            <select id="ac_id" name="ac_id" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md">
                                <option value="" disabled>เลือกปีการศึกษา</option>
                                @foreach ($academicYears as $year)
                                    <option value="{{ $year->id }}" {{ old('ac_id', $student->ac_id) == $year->id ? 'selected' : '' }}>
                                        {{ $year->year }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ac_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div> --}}

                        <!-- Submit Button -->
                        <div class="mb-4 flex items-center justify-between">
                            <button type="submit"
                                class="w-full px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                                บันทึก
                            </button>
                            <a href="{{ route('admin.student.index') }}"
                                class="ml-4 w-full px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700 text-center">
                                ยกเลิก
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
