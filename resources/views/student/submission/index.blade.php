<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-gray-500 dark:text-gray-400">การยื่นสอบโครงงาน</h3>

                    <div
                        class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-end pb-4 mt-2">

                        @if ($proposes->status == 0)
                            {{-- ถ้าอนุมัติแล้ว ให้ลิงก์ปกติ --}}
                            <a href="{{ route('student.submission.create', $proposes->id) }}"
                                class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300
                  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500
                  dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                สร้าง
                            </a>
                        @else
                            {{-- ถ้ายังไม่ผ่าน ให้ลิงก์เรียก SweetAlert --}}
                            <a href="javascript:void(0)"
                                onclick="Swal.fire({
                                    icon: 'warning',
                                    title: 'ยังไม่ผ่านการอนุมัติ',
                                    text: 'กรุณายื่นหัวข้อและรอการอนุมัติก่อนทำการยื่นสอบ',
                                    confirmButtonText: 'ตกลง'
                                })"
                                class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300
                  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500
                  dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                สร้าง
                            </a>
                        @endif

                    </div>


                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ลำดับ.
                                    </th>
                                    {{-- <th scope="col" class="px-6 py-3">
                                        ID
                                    </th> --}}
                                    <th scope="col" class="px-6 py-3 min-w-max whitespace-nowrap">
                                        ชื่อโครงงาน
                                    </th>
                                    <th scope="col" class="px-6 py-3 min-w-max whitespace-nowrap">
                                        อาจารย์ที่ปรึกษา
                                    </th>
                                    <th scope="col" class="px-6 py-3 min-w-max whitespace-nowrap">
                                        ประเภทรายวิชา
                                    </th>
                                    <th scope="col" class="px-6 py-3 min-w-max whitespace-nowrap text-center">
                                        สถานะ
                                    </th>
                                    {{-- <th scope="col" class="px-6 py-3">
                                        Project Group
                                    </th> --}}
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($examsubmissions as $submission)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-500">
                                            {{ $loop->iteration }}
                                        </th>
                                        {{-- <td class="px-6 py-4">
                                            {{ $submission->propose->id }}
                                        </td> --}}
                                        <td class="px-6 py-4">
                                            {{ $submission->propose->title }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $submission->propose->advisor->a_fname }}
                                            {{ $submission->propose->advisor->a_lname }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $submission->exam_type->name }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @switch($submission->status)
                                                @case(0)
                                                    {{-- <span class="text-green-500">การสอบเสร็จสิ้น</span> --}}
                                                    <span
                                                        class="px-2 py-0.5 bg-green-200 text-green-800 rounded-md truncate">การสอบเสร็จสิ้น</span>
                                                @break

                                                @case(1)
                                                    {{-- <span class="text-yellow-500">รอการอนุมัติ</span> --}}
                                                    <span
                                                        class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md truncate">รอการอนุมัติ</span>
                                                @break

                                                @case(2)
                                                    {{-- <span class="text-red-500">ยื่นสอบไม่ผ่าน</span> --}}
                                                    <span
                                                        class="px-2 py-0.5 bg-red-200 text-red-800 rounded-md truncate">ยื่นสอบไม่ผ่าน</span>
                                                @break

                                                @case(3)
                                                    {{-- <span class="text-green-500">อนุมัติสอบ</span>
                                                        <span class="text-gray-500">/</span> --}}
                                                    {{-- <span class="text-yellow-500">รอจัดตารางสอบ</span> --}}
                                                    <span
                                                        class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md truncate">รอจัดตารางสอบ</span>
                                                @break

                                                @case(4)
                                                    <span
                                                        class="px-2 py-0.5 bg-green-200 text-green-800 rounded-md truncate">กำลังดำเนินการสอบ</span>
                                                @break

                                                @default
                                                    {{-- <span class="text-gray-500">ยังไม่ได้ยื่นสอบ</span> --}}
                                                    <span
                                                        class="px-2 py-0.5 bg-gray-200 text-gray-800 rounded-md truncate">ยังไม่ได้ยื่นสอบ</span>
                                            @endswitch
                                        </td>
                                        {{-- <td class="px-6 py-4">
                                            {{ $propose->project_group->id ?? ''}}
                                        </td> --}}

                                        <td class="px-6 py-4 text-center truncate">
                                            @switch($submission->status)
                                                @case(0)
                                                    {{-- รายละเอียด, ประวัติ, ดูตารางสอบ --}}
                                                    <button type="button" title="รายละเอียด"
                                                        onclick="window.location.href='{{ route('student.submission.view', ['submissionId' => $submission->id, 'proposeId' => $submission->propose->id]) }}'"
                                                        class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                        <i class="fa-solid fa-eye fa-lg"></i>
                                                    </button>
                                                    <button type="button" title="ประวัติ"
                                                        onclick="window.location.href='{{ route('student.submission.history', $submission->id) }}'"
                                                        class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                        <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                                                    </button>
                                                    <button type="button" title="ดูข้อมูลการสอบ"
                                                        onclick="window.location.href='{{ route('student.submission.schedule', $submission->id) }}'"
                                                        class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                                                        <i class="fa-solid fa-calendar-days fa-lg"></i>
                                                    </button>
                                                @break

                                                @case(1)
                                                    {{-- แก้ไข, รายละเอียด, ประวัติ --}}

                                                    {{-- แสดงปุ่มแก้ไขเฉพาะกรณีที่ไม่ใช่ AUCC --}}
                                                    @if (strtolower($submission->exam_type->name ?? '') !== 'aucc')
                                                        <button type="button" title="แก้ไข"
                                                            onclick="window.location.href='{{ route('student.submission.edit', ['submissionId' => $submission->id, 'proposeId' => $submission->propose->id]) }}'"
                                                            class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                            <i class="fa-solid fa-pen fa-lg"></i>
                                                        </button>
                                                    @endif
                                                    <button type="button" title="รายละเอียด"
                                                        onclick="window.location.href='{{ route('student.submission.view', ['submissionId' => $submission->id, 'proposeId' => $submission->propose->id]) }}'"
                                                        class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                        <i class="fa-solid fa-eye fa-lg"></i>
                                                    </button>
                                                    <button type="button" title="ประวัติ"
                                                        onclick="window.location.href='{{ route('student.submission.history', $submission->id) }}'"
                                                        class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                        <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                                                    </button>
                                                @break

                                                @case(2)
                                                    {{-- แก้ไข, ประวัติ --}}
                                                    <button type="button" title="แก้ไข"
                                                        onclick="window.location.href='{{ route('student.submission.edit', ['submissionId' => $submission->id, 'proposeId' => $submission->propose->id]) }}'"
                                                        class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                        <i class="fa-solid fa-pen fa-lg"></i>
                                                    </button>
                                                    <button type="button" title="ประวัติ"
                                                        onclick="window.location.href='{{ route('student.submission.history', $submission->id) }}'"
                                                        class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                        <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                                                    </button>
                                                @break

                                                @case(3)
                                                    {{-- แก้ไข, ประวัติ --}}
                                                    <button type="button" title="รายละเอียด"
                                                        onclick="window.location.href='{{ route('student.submission.view', ['submissionId' => $submission->id, 'proposeId' => $submission->propose->id]) }}'"
                                                        class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                        <i class="fa-solid fa-eye fa-lg"></i>
                                                    </button>
                                                    <button type="button" title="ประวัติ"
                                                        onclick="window.location.href='{{ route('student.submission.history', $submission->id) }}'"
                                                        class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                        <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                                                    </button>
                                                @break

                                                @case(4)
                                                    {{-- แก้ไข, ประวัติ --}}
                                                    <button type="button" title="รายละเอียด"
                                                        onclick="window.location.href='{{ route('student.submission.view', ['submissionId' => $submission->id, 'proposeId' => $submission->propose->id]) }}'"
                                                        class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                        <i class="fa-solid fa-eye fa-lg"></i>
                                                    </button>
                                                    <button type="button" title="ประวัติ"
                                                        onclick="window.location.href='{{ route('student.submission.history', $submission->id) }}'"
                                                        class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                        <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                                                    </button>
                                                    <button type="button" title="ดูข้อมูลการสอบ"
                                                        onclick="window.location.href='{{ route('student.submission.schedule', $submission->id) }}'"
                                                        class="text-white bg-green-500 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
                                                        <i class="fa-solid fa-calendar-days fa-lg"></i>
                                                    </button>
                                                @break

                                                @default
                                                    {{-- กรณีสถานะอื่น ๆ (ถ้ามี) --}}
                                                    <span class="text-gray-500">ไม่มีการกระทำ</span>
                                            @endswitch
                                        </td>

                                    </tr>
                                    @empty
                                        <tr>
                                            <td class="px-6 py-4 text-center " colspan="6">
                                                ไม่พบข้อมูลการยื่นขอสอบโครงงาน
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

        {{-- SweetAlert --}}
        <script>
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'แจ้งเตือน',
                    text: "{{ session('error') }}",
                    confirmButtonText: 'ตกลง'
                });
            @endif

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ',
                    text: "{{ session('success') }}",
                    confirmButtonText: 'ตกลง'
                });
            @endif
        </script>
    </x-app-layout>
