<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-black-300 dark:text-white">เพิ่มกลุ่มคณะกรรมการ</h3>

                    @if (session('success'))
                        <div class="mb-4 text-green-500">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('teacher.invigilator.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 dark:text-gray-300">ชื่อกลุ่ม</label>
                            <input type="text" id="name" name="name"
                                class="w-full px-4 py-2 border rounded-lg" required>
                        </div>

                        <div class="mt-4">
                            <label for="ac_id" class="block text-gray-700 dark:text-gray-300">ปีการศึกษา</label>
                            <select name="ac_id" id="ac_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                required>
                                <option value="" disabled selected>เลือกปีการศึกษา</option>
                                @foreach ($academic_years as $year)
                                    <option value="{{ $year->id }}">{{ $year->year }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- <div class="mt-4">
                            <label for="advisors" class="block text-gray-700 dark:text-gray-300">Select advisors</label>
                            <select name="advisors[]" id="advisors" class="w-full" multiple="multiple" required>
                                @foreach ($advisors as $advisor)
                                    <option value="{{ $advisor->id }}">{{ $advisor->a_fname }} {{ $advisor->a_lname }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}

                        <div class="mt-4">
                            <h3 class="block text-gray-700 dark:text-gray-300">เลือกอาจารย์</h3>
                            <ul
                                class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach ($advisors as $advisor)
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center ps-3">
                                            <input id="advisor-{{ $advisor->id }}" type="checkbox" name="advisors[]"
                                                value="{{ $advisor->id }}"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="advisor-{{ $advisor->id }}"
                                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                {{ $advisor->a_fname }} {{ $advisor->a_lname }}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mt-4 flex justify-end">
                            <button type="submit"
                                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800 mr-4">
                                บันทึก
                            </button>
                            <a href="{{ route('teacher.invigilator.home') }}"
                                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                                ยกเลิก
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Initialize Select2 for the teachers selection -->
    <script>
        $(document).ready(function() {
            $('#advisors').select2({
                placeholder: "Select Advisors",
                allowClear: true
            });
        });
    </script>
</x-app-layout>
