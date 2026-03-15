<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-gray-900 rounded dark:text-gray-300">รายการสอบ</h3>


                    <div class="mt-4">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg rounded-lg mt-2">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            ลำดับ
                                        </th>
                                        {{-- <th scope="col" class="px-6 py-3">
                                        ID
                                    </th> --}}
                                        <th scope="col" class="px-6 py-3">
                                            ชื่อโครงงาน
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            รายวิชา
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            สถานะ
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($examinations as $examination)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-400">
                                                {{ $loop->iteration + ($examinations->currentPage() - 1) * $examinations->perPage() }}
                                            </th>
                                            {{-- <td class="px-6 py-4">
                                            {{ $examination->id }}
                                        </td> --}}
                                            <td class="px-6 py-4">
                                                {{ $examination->propose->title }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $examination->exam_type->name }}
                                            </td>
                                            {{-- <td class="px-6 py-4">
                                            @if ($examination->status == 1)
                                                ยังไม่ได้ยื่นสอบ
                                            @elseif ($examination->status == 2)
                                                รอการอนุมัติ
                                            @elseif ($examination->status == 3)
                                                ยื่นสอบไม่ผ่าน
                                            @elseif ($examination->status == 0)
                                                อนุมัติสอบ
                                            @else
                                                ยังไม่ได้ยื่นสอบ
                                            @endif
                                        </td> --}}
                                            <td class="px-6 py-4 text-center max-w-xs truncate">
                                                @switch($examination->status)
                                                    @case(4)
                                                        {{-- <span class="text-green-500">อนุมัติสอบ</span>
                                                        <span class="text-gray-500">/</span> --}}
                                                        {{-- <span class="text-yellow-500">กำลังดำเนินการสอบ</span> --}}
                                                        <span
                                                            class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md truncate">กำลังดำเนินการสอบ</span>
                                                    @break

                                                    @case(5)
                                                        <span
                                                            class="px-2 py-0.5 bg-green-200 text-green-800 rounded-md truncate">การสอบเสร็จสิ้น</span>
                                                    @break

                                                    @default
                                                        <span
                                                            class="px-2 py-0.5 bg-gray-200 text-gray-800 rounded-md truncate">ยังไม่ได้มีการสอบ</span>
                                                @endswitch
                                            </td>
                                            {{-- <td class="px-6 py-4">
                                            {{ $propose->academic_year->year }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $propose->project_group->id ?? ''}}
                                        </td> --}}
                                            <td class="px-6 py-4 text-center">
                                                {{-- <a href="{{ route('teacher.invigilator.group', $groups->ac_id)}}" class="text-green-600 hover:text-yellow-900">การยื่นสอบ</a> --}}
                                                @switch($examination->status)
                                                    @case(4)
                                                        <button type="button" title="รายละเอียด"
                                                            onclick="window.location.href='{{ route('invigilator.examination.view', $examination->id) }}'"
                                                            class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                            <i class="fa-solid fa-eye fa-lg"></i>
                                                        </button>
                                                        <button type="button" title="ดูตารางสอบ"
                                                            onclick="window.location.href='{{ route('invigilator.examination.schedule', $examination->id) }}'"
                                                            class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                            <i class="fa-solid fa-calendar fa-lg"></i>
                                                        </button>
                                                        <button type="button" title="ให้คะแนน"
                                                            onclick="window.location.href='{{ route('invigilator.examination.score', $examination->id) }}'"
                                                            class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                            <i class="fa-solid fa-pen-fancy fa-lg"></i>
                                                        </button>
                                                    @break

                                                    @default
                                                        <button type="button" title="รายละเอียด"
                                                            onclick="window.location.href='{{ route('invigilator.examination.view', $examination->id) }}'"
                                                            class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                            <i class="fa-solid fa-eye fa-lg"></i>
                                                        </button>
                                                        <button type="button" title="ดูตารางสอบ"
                                                            onclick="window.location.href='{{ route('invigilator.examination.schedule', $examination->id) }}'"
                                                            class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                            <i class="fa-solid fa-calendar fa-lg"></i>
                                                        </button>
                                                @endswitch

                                                {{-- <a href="{{ route('teacher.invigilator.edit', $groups->id) }}" class="text-blue-600 hover:text-blue-900">แก้ไข</a>
                                            <a href="{{ route('teacher.invigilator.delete', $groups->id) }}" class="text-blue-600 hover:text-blue-900">ลบ</a> --}}
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">ไม่พบการยื่นสอบ</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="mt-4">
                            {{ $examinations->links() }}
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
    </script>
