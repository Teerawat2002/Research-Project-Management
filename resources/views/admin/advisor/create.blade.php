<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">เพิ่มข้อมูลอาจารย์</h3>

                    <form id="advisorForm" method="POST" action="{{ route('admin.advisor.store') }}" class="mt-6">
                        @csrf

                        <!-- Advisor ID -->
                        <div class="mb-4">
                            <label for="a_id" class="block text-sm font-medium text-gray-900 dark:text-white">ID</label>
                            <input type="text" id="a_id" name="a_id" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">

                            @if ($errors->has('a_id'))
                                <div class="mt-2">
                                    <ul class="text-red-500 list-disc pl-5">
                                        @foreach ($errors->get('a_id') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                {{-- <script>
                                    Swal.fire({
                                        title: 'Error!',
                                        text: '{{ $errors->first('a_id') }}',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                </script> --}}
                            @endif
                        </div>


                        <!-- First Name -->
                        <div class="mb-4">
                            <label for="a_fname" class="block text-sm font-medium text-gray-900 dark:text-white">ชื่อ</label>
                            <input type="text" id="a_fname" name="a_fname" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                        </div>

                        <!-- Last Name -->
                        <div class="mb-4">
                            <label for="a_lname" class="block text-sm font-medium text-gray-900 dark:text-white">นามสกุล</label>
                            <input type="text" id="a_lname" name="a_lname" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" id="password" name="password" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-900 dark:text-white">Confirm
                                Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                        </div>

                        <!-- Advisor Type -->
                        <div class="mb-4">
                            <label for="a_type" class="block text-sm font-medium text-gray-900 dark:text-white">ประเภทอาจารย์</label>
                            <select id="a_type" name="a_type" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                                <option value="" disabled selected>เลือกประเภทอาจารย์</option>
                                <option value="advisor">Advisor</option>
                                <option value="teacher">Teacher</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <!-- Major -->
                        <div class="mb-4">
                            <label for="m_id" class="block text-sm font-medium text-gray-900 dark:text-white">สาขาวิชา</label>
                            <select id="m_id" name="m_id" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                                <option value="" disabled selected>เลือกสาขาวิชา</option>
                                @foreach ($majors as $major)
                                    <option value="{{ $major->id }}">{{ $major->m_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit and Cancel Buttons -->
                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="w-full px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:bg-blue-700 focus:outline-none">
                                เพิ่ม
                            </button>
                            <a href="{{ route('admin.advisor.index') }}"
                                class="ml-4 w-full px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700 focus:bg-red-700 focus:outline-none text-center">
                                ยกเลิก
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('advisorForm');
            form.addEventListener('submit', function(e) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;

                // Remove any previous error message if exists
                const prevError = document.getElementById('passwordError');
                if (prevError) {
                    prevError.remove();
                }

                if (password !== confirmPassword) {
                    e.preventDefault();
                    // Create error message block
                    const errorDiv = document.createElement('div');
                    errorDiv.id = 'passwordError';
                    errorDiv.className = 'mt-2';
                    errorDiv.innerHTML = `
                        <ul class="text-red-500 list-disc pl-5">
                            <li>Password and Confirm Password do not match!</li>
                        </ul>
                    `;
                    // Insert the error message below the confirm password field
                    const confirmInput = document.getElementById('password_confirmation');
                    confirmInput.parentNode.appendChild(errorDiv);
                }
            });
        });
    </script>

</x-app-layout>
