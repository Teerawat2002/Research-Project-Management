<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-black-900 dark:text-white">รายการกลุ่มคณะกรรมการ</h3>
                    <div class="flex flex-wrap items-center justify-end pb-4 mt-2">
                        <a href="{{ route('teacher.invigilator.create') }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-800 dark:focus:ring-blue-800">
                            เพื่มกลุ่ม
                        </a>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">ลำดับ</th>
                                    <th scope="col" class="px-6 py-3">จำนวนกลุ่มคณะกรรมการ</th>
                                    <th scope="col" class="px-6 py-3">ปีการศึกษา</th>
                                    <th scope="col" class="px-6 py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($groupWithMemberCount as $groups)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                        {{-- <td class="px-6 py-4">{{ $groups->name }}</td> --}}
                                        <td class="px-6 py-4">{{ $groups->group_count }}</td>
                                        <td class="px-6 py-4">{{ $groups->academic_year->year }}</td>
                                        <td class="px-6 py-4 text-center">
                                            {{-- <a href="{{ route('teacher.invigilator.group', $groups->ac_id) }}"
                                                class="text-blue-500 hover:text-blue-700">รายละเอียด</a> --}}
                                            <button type="button" title="ดูรายละเอียด"
                                                onclick="window.location.href='{{ route('teacher.invigilator.group', $groups->ac_id) }}'"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                <i class="fa-solid fa-eye fa-lg"></i>
                                            </button>
                                            {{-- <a href="#" class="text-blue-600 hover:text-blue-900">แก้ไข</a> --}}
                                            {{-- <a href="#" class="text-red-600 hover:text-red-900">ลบ</a> --}}
                                            {{-- <a href="{{ route('teacher.invigilator.edit', $groups->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                            <a href="{{ route('teacher.invigilator.delete', $groups->id) }}" class="text-blue-600 hover:text-blue-900">Delete</a> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-6 py-4 text-center" colspan="5">
                                            ไม่พบข้อมูลกลุ่มคณะกรรมการ
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- แสดงการแจ้งเตือนด้วย SweetAlert2 -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ!',
                text: '{{ session('success') }}',
                showConfirmButton: true,
                timer: 3000
            });
        </script>
    @endif
</x-app-layout>
