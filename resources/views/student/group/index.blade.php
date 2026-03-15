<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-500 dark:text-gray-400">รายชื่อนักศึกษาทั้งหมด</h3>
                    <div
                        class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-end pb-4 mt-2">
                        <div>
                            @if ($hasGroup)
                                <span
                                    class="text-gray-500 bg-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center cursor-not-allowed">
                                    คุณมีกลุ่มแล้ว
                                </span>
                                <a href="{{ route('student.group.edit', ['group' => $groupId]) }}"
                                    class="ml-4 text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                                    แก้ไข
                                </a>
                            @else
                                <a href="{{ route('student.group.create') }}"
                                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                    สร้าง
                                </a>
                            @endif
                        </div>
                        {{-- <div>
                                <a href="{{ route('student.group.create') }}"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800
                        {{ Auth::guard('students')->user()->group_id !== null ? 'pointer-events-none opacity-50' : '' }}">
                        Create
                        </a>
                    </div> --}}
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg rounded-lg mt-2">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    {{-- <th scope="col" class="px-6 py-3">
                                        No.
                                    </th> --}}
                                    <th scope="col" class="px-6 py-3">
                                        รหัสนักศึกษา
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ชื่อ
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        นามสกุล
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        สาขา
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        สถานะ
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($Student as $user)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                        {{-- <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $loop->iteration }}
                                </th> --}}
                                        <td class="px-6 py-4">
                                            {{ $user->s_id }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $user->s_fname }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $user->s_lname }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $user->major->m_name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($user->status === 'active')
                                                <span
                                                    class="px-2 py-1 text-xs text-green-700 bg-green-100 rounded">
                                                    ปกติ
                                                </span>
                                            @elseif ($user->status === 'graduated')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 rounded bg-gray-100 text-gray-700">
                                                    จบการศึกษา
                                                </span>
                                            @else
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 rounded bg-red-100 text-red-700">
                                                    ไม่ทราบสถานะ
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-5 py-4">
                                            ไม่พบข้อมูลนักศึกษา
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $Student->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // ตรวจสอบ success message
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'สำเร็จ',
            // timmer: 2000,
            text: "{{ session('success') }}",
            confirmButtonText: 'ตกลง'
        });
    @endif

    // ตรวจสอบ validation errors (แสดงข้อความแรก)
    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            // timmer: 2000,
            text: "{{ $errors->first() }}",
            confirmButtonText: 'ตกลง'
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'warning',
            title: 'แจ้งเตือน',
            text: "{{ session('error') }}",
            confirmButtonText: 'ตกลง'
        });
    @endif
</script>
