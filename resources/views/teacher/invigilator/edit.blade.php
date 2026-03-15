<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-black-900 dark:text-white">แก้ไขรายสมาชิกกลุ่มกรรมการ:
                        {{ $group->name }}
                    </h3>

                    <form action="{{ route('teacher.invigilator.update', $group->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- ใช้ PUT Method -->

                        <!-- แสดงอาจารย์ที่เป็นสมาชิกในกลุ่ม -->
                        <div class="mt-4">
                            <h3 class="block text-gray-700 dark:text-gray-300">สมาชิกในกลุ่ม</h3>
                            <ul
                                class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach ($members as $member)
                                <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                    <div class="flex items-center ps-3">
                                        <!-- ถ้าเป็นสมาชิกแล้ว ให้แสดง checkbox ที่ถูกเลือก -->
                                        <input id="advisor-{{ $member->advisor->id }}" type="checkbox"
                                            name="remove_advisors[]" value="{{ $member->advisor->id }}"
                                            class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            checked>
                                        <label for="advisor-{{ $member->advisor->id }}"
                                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            {{ $member->advisor->a_fname }} {{ $member->advisor->a_lname }}
                                        </label>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- เพิ่มอาจารย์ใหม่ -->
                        <div class="mt-4">
                            <h3 class="block text-gray-700 dark:text-gray-300">เพิ่มสมาชิก</h3>
                            <ul
                                class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach ($advisors as $advisor)
                                <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                    <div class="flex items-center ps-3">
                                        <!-- ถ้าอาจารย์ไม่ได้เป็นสมาชิกในกลุ่ม ให้แสดง checkbox ว่าไม่ได้เลือก -->
                                        <input id="advisor-{{ $advisor->id }}" type="checkbox" name="advisors[]"
                                            value="{{ $advisor->id }}"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="advisor-{{ $advisor->id }}"
                                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            {{ $advisor->a_fname }} {{ $advisor->a_lname }} (ยังไม่เลือก)
                                        </label>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- ปุ่มบันทึกการแก้ไข -->
                        <div class="mt-4 flex justify-end">
                            <button type="submit"
                                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800 mr-4">
                                บันทึก
                            </button>
                            <!-- <a href="{{ route('teacher.invigilator.group', $group->id) }}"
                                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                                ยกเลิก
                            </a> -->
                            <a href="{{ url()->previous() }}"
                                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                                ยกเลิก
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>