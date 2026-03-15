<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-300">การยื่นสอบ</h3>

                    <div class="mt-4">
                        <div
                            class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4 mt-2">
                            <!-- ฟอร์มค้นหา -->
                            <form method="GET" action="{{ route('advisor.submission.index') }}" class="flex space-x-4">
                                @csrf
                                <input type="text" name="search" placeholder="ค้นหาด้วยชื่อโครงงาน"
                                    class="px-4 py-2 border rounded-md w-80" value="{{ request('search') }}">

                                <button type="submit"
                                    class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                    ค้นหา
                                </button>
                            </form>
                        </div>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg rounded-lg">
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
                                        <th scope="col" class="px-6 py-3 min-w-max whitespace-nowrap">
                                            ชื่อโครงงาน
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            รายวิชา
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            สถานะ
                                        </th>
                                        {{-- <th scope="col" class="px-6 py-3 text-center relative">
                                            สถานะ
                                            <button type="button" data-popover-target="popover-status-all"
                                                data-popover-placement="bottom" data-popover-trigger="hover"
                                                class="inline-flex items-center text-gray-600 hover:text-gray-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-9-3a1 1 0 112 0v1a1 1 0 11-2 0V7zm1 8a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>

                                            <div data-popover id="popover-status-all" role="tooltip"
                                                class="absolute left-1/2 transform -translate-x-1/2 mt-2 z-10 invisible w-72 text-sm text-gray-500
                                                     transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0
                                                     dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                                <div class="p-3 space-y-2">
                                                    <h3 class="font-semibold text-gray-900 dark:text-white">รหัสสถานะ
                                                    </h3>
                                                    <ul class="list-disc list-inside space-y-1">
                                                        <li><span class="font-medium">0:</span> อนุมัติสอบ /
                                                            จัดตารางสอบแล้ว</li>
                                                        <li><span class="font-medium">1:</span> รอการอนุมัติ</li>
                                                        <li><span class="font-medium">2:</span> ยื่นสอบไม่ผ่าน</li>
                                                        <li><span class="font-medium">3:</span> อนุมัติสอบ /
                                                            รอจัดตารางสอบ</li>
                                                        <li><span class="font-medium">(อื่นๆ):</span> ยังไม่ได้ยื่นสอบ
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div data-popper-arrow></div>
                                            </div>
                                        </th> --}}

                                        {{-- <th scope="col" class="px-6 py-3">
                                        ปีการศึกษา
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        กลุ่มโครงการ
                                    </th> --}}
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($examSubmissions as $submission)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-400">
                                                {{ $loop->iteration + ($examSubmissions->currentPage() - 1) * $examSubmissions->perPage() }}
                                            </th>
                                            {{-- <td class="px-6 py-4">
                                            {{ $submission->id }}
                                        </td> --}}
                                            <td class="px-6 py-4">
                                                {{ $submission->propose->title }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $submission->exam_type->name }}
                                            </td>
                                            {{-- <td class="px-6 py-4">
                                            @if ($submission->status == 1)
                                                ยังไม่ได้ยื่นสอบ
                                            @elseif ($submission->status == 2)
                                                รอการอนุมัติ
                                            @elseif ($submission->status == 3)
                                                ยื่นสอบไม่ผ่าน
                                            @elseif ($submission->status == 0)
                                                อนุมัติสอบ
                                            @else
                                                ยังไม่ได้ยื่นสอบ
                                            @endif
                                        </td> --}}
                                            <td class="px-6 py-4 text-center max-w-xs truncate">
                                                @switch($submission->status)
                                                    @case(0)
                                                        <span
                                                            class="px-2 py-0.5 bg-green-200 text-green-800 rounded-md truncate">การสอบเสร็จสิ้น</span>
                                                    @break

                                                    @case(1)
                                                        <span
                                                            class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md truncate">รอการอนุมัติ</span>
                                                    @break

                                                    @case(2)
                                                        <span
                                                            class="px-2 py-0.5 bg-red-200 text-red-800 rounded-md truncate">ยื่นสอบไม่ผ่าน</span>
                                                    @break

                                                    @case(3)
                                                        <span
                                                            class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md truncate">รอจัดตารางสอบ</span>
                                                    @break

                                                    @case(4)
                                                        <span
                                                            class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md truncate">กำลังดำเนินการสอบ</span>
                                                    @break

                                                    @default
                                                        <span
                                                            class="px-2 py-0.5 bg-gray-200 text-gray-800 rounded-md truncate">ยังไม่ได้ยื่นสอบ</span>
                                                @endswitch
                                            </td>
                                            {{-- <td class="px-6 py-4">
                                            {{ $propose->academic_year->year }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $propose->project_group->id ?? ''}}
                                        </td> --}}
                                            <td class="px-6 py-4 text-center truncate">
                                                {{-- <a href="{{ route('teacher.invigilator.group', $groups->ac_id)}}" class="text-green-600 hover:text-yellow-900">การยื่นสอบ</a> --}}
                                                @switch($submission->status)
                                                    @case(0)
                                                        {{-- การสอบเสร็จสิ้น --}}
                                                        <button type="button" title="รายละเอียด"
                                                            onclick="window.location.href='{{ route('advisor.submission.view', $submission->id) }}'"
                                                            class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                            <i class="fa-solid fa-eye fa-lg"></i>
                                                        </button>
                                                        @if (strtolower($submission->exam_type->name ?? '') !== 'aucc')
                                                            <button type="button" title="ประวัติ"
                                                                onclick="window.location.href='{{ route('advisor.submission.history', $submission->id) }}'"
                                                                class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                                <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                                                            </button>
                                                            <button type="button" title="ดูตารางสอบ"
                                                                onclick="window.location.href='{{ route('advisor.schedule.show', $submission->id) }}'"
                                                                class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                                <i class="fa-solid fa-calendar fa-lg"></i>
                                                            </button>
                                                        @endif
                                                        <button type="button" title="ดูเกรด"
                                                            onclick="window.location.href='{{ route('advisor.score.view', $submission->id) }}'"
                                                            class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                                                            <i class="fa-solid fa-graduation-cap fa-lg"></i>
                                                        </button>
                                                    @break

                                                    @case(1)
                                                        {{-- รอการอนุมัติ --}}
                                                        @if (strtolower($submission->exam_type->name ?? '') == 'aucc')
                                                            <button type="button" title="ให้คะแนน AUCC"
                                                                onclick="window.location.href='{{ route('advisor.submission.auccForm', $submission->id) }}'"
                                                                class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                                <i class="fa-solid fa-pen-fancy fa-lg"></i>
                                                            </button>
                                                            <button type="button" title="ประวัติ"
                                                                onclick="window.location.href='{{ route('advisor.submission.history', $submission->id) }}'"
                                                                class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                                <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                                                            </button>
                                                        @else
                                                            <button type="button" title="การอนุมัติ"
                                                                onclick="window.location.href='{{ route('advisor.submission.submission', $submission->propose_id) }}'"
                                                                class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                                <i class="fa-solid fa-pen fa-lg"></i>
                                                            </button>
                                                            <button type="button" title="ประวัติ"
                                                                onclick="window.location.href='{{ route('advisor.submission.history', $submission->id) }}'"
                                                                class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                                <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                                                            </button>
                                                        @endif
                                                    @break

                                                    @case(2)
                                                        {{-- ยื่นสอบไม่ผ่าน --}}
                                                        <button type="button" title="รายละเอียด"
                                                            onclick="window.location.href='{{ route('advisor.submission.view', $submission->id) }}'"
                                                            class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                            <i class="fa-solid fa-eye fa-lg"></i>
                                                        </button>
                                                        <button type="button" title="ประวัติ"
                                                            onclick="window.location.href='{{ route('advisor.submission.history', $submission->id) }}'"
                                                            class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                            <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                                                        </button>
                                                    @break

                                                    @case(3)
                                                        {{-- อนุมัติสอบ --}}
                                                        <button type="button" title="รายละเอียด"
                                                            onclick="window.location.href='{{ route('advisor.submission.view', $submission->id) }}'"
                                                            class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                            <i class="fa-solid fa-eye fa-lg"></i>
                                                        </button>
                                                        <button type="button" title="ประวัติ"
                                                            onclick="window.location.href='{{ route('advisor.submission.history', $submission->id) }}'"
                                                            class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                            <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                                                        </button>
                                                        <button type="button" title="จัดตารางสอบ"
                                                            onclick="window.location.href='{{ route('advisor.schedule.create', $submission->id) }}'"
                                                            class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                            <i class="fa-solid fa-calendar-plus fa-lg"></i>
                                                        </button>
                                                    @break

                                                    @case(4)
                                                        {{-- ดำเนินการสอบ --}}
                                                        <button type="button" title="รายละเอียด"
                                                            onclick="window.location.href='{{ route('advisor.submission.view', $submission->id) }}'"
                                                            class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                            <i class="fa-solid fa-eye fa-lg"></i>
                                                        </button>
                                                        <button type="button" title="ประวัติ"
                                                            onclick="window.location.href='{{ route('advisor.submission.history', $submission->id) }}'"
                                                            class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                            <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                                                        </button>
                                                        <button type="button" title="ดูตารางสอบ"
                                                            onclick="window.location.href='{{ route('advisor.schedule.show', $submission->id) }}'"
                                                            class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                            <i class="fa-solid fa-calendar fa-lg"></i>
                                                        </button>
                                                        <button type="button" title="ให้คะแนน"
                                                            onclick="window.location.href='{{ route('advisor.score.score', $submission->id) }}'"
                                                            class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                            <i class="fa-solid fa-pen-fancy fa-lg"></i>
                                                        </button>
                                                    @break

                                                    @default
                                                        {{-- สถานะอื่นๆ (ยังไม่ได้ยื่น หรือ status นอกเหนือจากข้างต้น) --}}
                                                @endswitch

                                                {{-- <a href="{{ route('teacher.invigilator.edit', $groups->id) }}" class="text-blue-600 hover:text-blue-900">แก้ไข</a>
                                            <a href="{{ route('teacher.invigilator.delete', $groups->id) }}" class="text-blue-600 hover:text-blue-900">ลบ</a> --}}
                                            </td>
                                        </tr>
                                        @empty
                                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                                ไม่พบการยื่นสอบ
                                            </td>
                                        @endforelse
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mt-4">
                            {{ $examSubmissions->links() }}
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
