<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-xl font-bold text-gray-900 dark:text-whitetext-gray-900 dark:text-white">แก้ไขข้อมูลอาจารย์</h3>

                <form method="POST" action="{{ route('admin.advisor.update', $advisorDetail->id) }}" class="mt-6"
                    enctype="multipart/form-data" id="advisorForm">
                    @csrf
                    @method('PUT')

                    <!-- Advisor ID -->
                    <div class="mb-4">
                        <label for="a_id" class="block text-sm font-medium text-gray-900 dark:text-whitetext-gray-900 dark:text-white">ID</label>
                        <input type="text" id="a_id" name="a_id" required
                            value="{{ old('a_id', $advisorDetail->a_id) }}"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md">

                        @error('a_id')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- First Name -->
                    <div class="mb-4">
                        <label for="a_fname" class="block text-sm font-medium text-gray-900 dark:text-whitetext-gray-900 dark:text-white">ชื่อ</label>
                        <input type="text" id="a_fname" name="a_fname" required
                            value="{{ old('a_fname', $advisorDetail->a_fname) }}"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md">
                    </div>

                    <!-- Last Name -->
                    <div class="mb-4">
                        <label for="a_lname" class="block text-sm font-medium text-gray-900 dark:text-whitetext-gray-900 dark:text-white">นามสกุล</label>
                        <input type="text" id="a_lname" name="a_lname" required
                            value="{{ old('a_lname', $advisorDetail->a_lname) }}"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md">
                    </div>

                    <!-- Password (Optional) -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-900 dark:text-whitetext-gray-900 dark:text-white">
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
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-900 dark:text-whitetext-gray-900 dark:text-white">Confirm
                            Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md">
                    </div>

                    <!-- Advisor Type -->
                    <div class="mb-4">
                        <label for="a_type" class="block text-sm font-medium text-gray-900 dark:text-whitetext-gray-900 dark:text-white">เลือกประเภทอาจารย์</label>
                        <select id="a_type" name="a_type" required
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md">
                            <option value="advisor"
                                {{ old('a_type', $advisorDetail->a_type) == 'advisor' ? 'selected' : '' }}>Advisor
                            </option>
                            <option value="teacher"
                                {{ old('a_type', $advisorDetail->a_type) == 'teacher' ? 'selected' : '' }}>Teacher
                            </option>
                            <option value="admin"
                                {{ old('a_type', $advisorDetail->a_type) == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <!-- Major -->
                    <div class="mb-4">
                        <label for="m_id" class="block text-sm font-medium text-gray-900 dark:text-whitetext-gray-900 dark:text-white">สาขาวิชา</label>
                        <select id="m_id" name="m_id" required
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md">
                            <option value="" disabled>เลือกสาขาวิชา</option>
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}"
                                    {{ old('m_id', $advisorDetail->m_id) == $major->id ? 'selected' : '' }}>
                                    {{ $major->m_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit and Cancel Buttons -->
                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="w-full px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            บันทึก
                        </button>
                        <a href="{{ route('admin.advisor.index') }}"
                            class="ml-4 w-full px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700 text-center">
                            ยกเลิก
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
