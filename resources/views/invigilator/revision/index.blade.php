<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                <div class="p-6">
                    {{-- หัวเรื่อง --}}
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-300">
                        รายการยื่นแก้ไข
                    </h3>

                    <div class="mt-4">

                        <div
                            class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4 mt-2">
                            <!-- ฟอร์มค้นหา -->
                            <form method="GET" action="{{ route('invigilator.revision.index') }}" class="flex space-x-4">
                                @csrf
                                <input type="text" name="search" placeholder="ค้นหาชื่อโครงงาน..."
                                    class="px-4 py-2 border rounded-md w-80 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    value="{{ $search }}">

                                <button type="submit"
                                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                    ค้นหา
                                </button>
                            </form>
                        </div>

                        {{-- ตารางรายการยื่นแก้ไข --}}
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg rounded-lg mt-2">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-sm text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">ชื่อโครงงาน</th>
                                        <th scope="col" class="px-6 py-3">รายวิชา</th>
                                        <th scope="col" class="px-6 py-3 text-center">สถานะ</th>
                                        {{-- <th scope="col" class="px-6 py-3 text-center">สถานะ</th> --}}
                                        <th scope="col" class="px-6 py-3 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($revisions as $revision)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            {{-- ชื่อโครงงาน --}}
                                            <td class="px-6 py-4">
                                                {{ $revision->exam_submission->propose->title ?? '–' }}
                                            </td>
                                            {{-- รายวิชา --}}
                                            <td class="px-6 py-4 truncate">
                                                {{ $revision->exam_submission->exam_type->name ?? '–' }}
                                            </td>
                                            <td class="px-6 py-4 text-center truncate">
                                                @php
                                                    $app = $revision->myApproval;
                                                    $status = $app ? (int) $app->status : null;
                                                @endphp

                                                @if ($app)
                                                    @switch($status)
                                                        @case(1)
                                                            <span
                                                                class="px-2 py-0.5 bg-green-200 text-green-800 rounded-md truncate">อนุมัติ</span>
                                                        @break

                                                        @case(2)
                                                            <span
                                                                class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md truncate">รออนุมัติ</span>
                                                        @break

                                                        @case(3)
                                                            <span
                                                                class="px-2 py-0.5 bg-red-200 text-red-800 rounded-md truncate">ไม่อนุมัติ</span>
                                                        @break

                                                        @default
                                                            <span
                                                                class="bg-gray-200 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-gray-300">ไม่ทราบสถานะ</span>
                                                    @endswitch
                                                @else
                                                    {{-- ยังไม่เคยมี approval ของอาจารย์คนนี้สำหรับ revision นี้ --}}
                                                    <span
                                                        class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md truncate">รออนุมัติ</span>
                                                @endif
                                            </td>

                                            {{-- ปุ่ม Action --}}
                                            <td class="px-6 py-4 text-center truncate">
                                                @php
                                                    // ดึง status ของอาจารย์คนนี้ (ถ้ายังไม่มี record จะได้ null)
                                                    $myStatus = optional($revision->myApproval)->status;
                                                @endphp

                                                @if (is_null($myStatus))
                                                    <button type="button" title="อนุมัติ"
                                                        onclick="window.location.href='{{ route('invigilator.revision.approve', ['revision' => $revision->id]) }}'"
                                                        class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                        <i class="fa-solid fa-pen fa-lg"></i>
                                                    </button>
                                                    <button type="button" title="รายละเอียด"
                                                        onclick="window.location.href='{{ route('invigilator.revision.show', ['revisionId' => $revision->id]) }}'"
                                                        class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                        <i class="fa-solid fa-eye fa-lg"></i>
                                                    </button>
                                                @else
                                                    @switch($myStatus)
                                                        @case('1')
                                                            <button type="button" title="รายละเอียด"
                                                                onclick="window.location.href='{{ route('invigilator.revision.show', ['revisionId' => $revision->id]) }}'"
                                                                class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                                <i class="fa-solid fa-eye fa-lg"></i>
                                                            </button>
                                                        @break

                                                        @case('2')
                                                            <button type="button" title="อนุมัติ"
                                                                onclick="window.location.href='{{ route('invigilator.revision.approve', ['revision' => $revision->id]) }}'"
                                                                class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                                <i class="fa-solid fa-pen fa-lg"></i>
                                                            </button>
                                                            <button type="button" title="รายละเอียด"
                                                                onclick="window.location.href='{{ route('invigilator.revision.show', ['revisionId' => $revision->id]) }}'"
                                                                class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                                <i class="fa-solid fa-eye fa-lg"></i>
                                                            </button>
                                                        @break

                                                        @case('3')
                                                            {{-- <span
                                                            class="px-2 py-0.5 bg-red-200 text-red-800 rounded-md">ไม่อนุมัติ</span> --}}
                                                            {{-- <span
                                                            class="bg-red-200 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-md dark:bg-red-900 dark:text-red-300">ไม่อนุมัติ</span> --}}
                                                            <button type="button" title="รายละเอียด"
                                                                onclick="window.location.href='{{ route('invigilator.revision.show', ['revisionId' => $revision->id]) }}'"
                                                                class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                                <i class="fa-solid fa-eye fa-lg"></i>
                                                            </button>
                                                        @break

                                                        @default
                                                    @endswitch
                                                @endif
                                                {{-- แก้ไขได้เฉพาะถ้ายังรออนุมัติ --}}
                                                {{-- @if ($revision->status === '1')
                                                <button type="button" title="อนุมัติ"
                                                    onclick="window.location.href='{{ route('invigilator.revision.approve', ['revision' => $revision->id]) }}'"
                                                    class="text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                    <i class="fa-solid fa-pen fa-lg"></i>
                                                </button>
                                            @endif --}}
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                                    ยังไม่มีรายการยื่นแก้ไข
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{-- จบตาราง --}}
                        </div>
                        <div class="mt-4">
                            {{ $revisions->links() }}
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
