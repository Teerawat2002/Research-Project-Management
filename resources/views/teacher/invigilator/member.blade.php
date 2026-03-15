<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-black-900 dark:text-white">สมาชิกกลุ่ม: {{ $group->name }}</h3>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">ชื่ออาจารย์</th>
                                    {{-- <th scope="col" class="px-6 py-3">Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $member)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">{{ $member->advisor->a_fname }}
                                            {{ $member->advisor->a_lname }}</td>
                                        {{-- <td class="px-6 py-4">
                                            <!-- Actions เช่น แก้ไขหรือลบ -->
                                            <a href="#" class="text-blue-600 hover:text-blue-900">แก้ไข</a>
                                            <a href="#" class="text-red-600 hover:text-red-900">ลบ</a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('teacher.invigilator.group', ['id' => $group->ac_id]) }}"
                            class="text-white bg-gray-600 hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-800">
                            กลับ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
