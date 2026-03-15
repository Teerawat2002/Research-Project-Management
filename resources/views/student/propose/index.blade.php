<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-gray-500 dark:text-gray-400">เสนอหัวข้อโครงงาน</h3>
                    <div
                        class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-end pb-4 mt-2">
                        <div>
                            @if ($userGroupId === null)
                                <span
                                    class="text-gray-500 bg-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center cursor-not-allowed">
                                    คุณยังไม่ได้สร้างกลุ่มโครงงาน
                                </span>
                            @elseif (!$hasActiveProposal)
                                <a href="{{ route('student.propose.create') }}"
                                    class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                    สร้าง
                                </a>
                            @else
                                <span
                                    class="text-gray-500 bg-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center cursor-not-allowed">
                                    คุณได้สร้างหัวข้อโครงงานแล้ว
                                </span>
                            @endif

                            {{-- <span
                                class="text-gray-500 bg-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center cursor-not-allowed">
                                คุณยังไม่ได้สร้างกลุ่มโครงงาน
                            </span> --}}
                        </div>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg rounded-lg mt-2">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    {{-- <th scope="col" class="px-6 py-3">ลำดับ.</th> --}}
                                    <th scope="col" class="px-6 py-3 min-w-max whitespace-nowrap">ชื่อโครงงาน</th>
                                    {{-- <th scope="col" class="px-6 py-3">กลุ่มโครงงาน</th> --}}
                                    <th scope="col" class="px-6 py-3 min-w-max whitespace-nowrap">อาจารย์ที่ปรึกษา
                                    </th>
                                    <th scope="col" class="px-6 py-3">สถานะ</th>
                                    <th scope="col" class="px-6 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($proposals as $proposal)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        {{-- <td class="px-6 py-4">
                                            {{ $loop->iteration }}
                                        </td> --}}
                                        <td class="px-6 py-4">
                                            {{ $proposal->title }}
                                        </td>
                                        {{-- <td class="px-6 py-4">
                                            {{ $proposal->group_id }}
                                        </td> --}}
                                        <td class="px-6 py-4">
                                            {{ $proposal->advisor->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @switch($proposal->status)
                                                @case(0)
                                                    <span
                                                        class="px-2 py-0.5 bg-green-200 text-green-800 rounded-md truncate">อนุมัติ</span>
                                                @break

                                                @case(1)
                                                    <span
                                                        class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md truncate">กำลังดำเนินการ</span>
                                                @break

                                                @case(2)
                                                    <span
                                                        class="px-2 py-0.5 bg-red-200 text-red-800 rounded-md truncate">ไม่อนุมัติ</span>
                                                @break

                                                @default
                                                    <span
                                                        class="px-2 py-0.5 bg-gray-200 text-gray-800 rounded-md truncate">ไม่ทราบสถานะ</span>
                                            @endswitch
                                        </td>
                                        {{-- <td class="px-6 py-4">
                                            <a href="{{route ('student.propose.edit',$proposal->id) }}"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        </td> --}}
                                        <td class="px-6 py-4 text-center max-w-xs">
                                            @if ($proposal->status == 2 || $proposal->status == 1)
                                                {{-- <a href="{{ route('student.propose.edit', $proposal->id) }}"
                                                    class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">
                                                    <i class="fa-solid fa-pen fa-lg"></i>
                                                </a> --}}
                                                <button type="button" title="แก้ไข"
                                                    onclick="window.location.href='{{ route('student.propose.edit', $proposal->id) }}'"
                                                    class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                    <i class="fa-solid fa-pen fa-lg"></i>
                                                </button>
                                                {{-- <a href="{{ route('student.propose.history', $proposal->id) }}"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                    ประวัติ
                                                </a> --}}
                                                <button type="button" title="ประวัติ"
                                                    onclick="window.location.href='{{ route('student.propose.history', $proposal->id) }}'"
                                                    class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                    <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                                                </button>
                                            @elseif ($proposal->status == 0)
                                                {{-- <a href="{{ route('student.propose.history', $proposal->id) }}"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                    ประวัติ
                                                </a> --}}
                                                <button type="button" title="ประวัติ"
                                                    onclick="window.location.href='{{ route('student.propose.history', $proposal->id) }}'"
                                                    class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                    <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td class="px-6 py-4 text-center" colspan="4">
                                                ไม่พบข้อมูลการเสนอหัวข้อ
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
