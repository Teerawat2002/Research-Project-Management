<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                <div class="p-6">
                    {{-- หัวเรื่อง --}}
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-300">
                        รายการยื่นแก้ไข
                    </h3>

                    <div
                        class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-end pb-4 mt-2">

                        @if ($submission->status == 5)
                            {{-- ถ้าอนุมัติแล้ว ให้ลิงก์ปกติ --}}
                            <a href="{{ route('student.revision.create', $submission->id) }}"
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
                                    title: 'ไม่สามารถสร้างได้',
                                    text: 'กรุณายื่นหัวข้อหรือทำการสอบให้เสร็จสิ้น',
                                    confirmButtonText: 'ตกลง'
                                })"
                                class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300
                  font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500
                  dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                สร้าง
                            </a>
                        @endif
                    </div>

                    {{-- ตารางรายการยื่นแก้ไข --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-sm text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 min-w-max whitespace-nowrap">ชื่อโครงงาน</th>
                                    <th scope="col" class="px-6 py-3">รายวิชา</th>
                                    {{-- <th scope="col" class="px-6 py-3 text-center">สถานะ</th> --}}
                                    <th scope="col" class="px-6 py-3 text-center">สถานะ</th>
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
                                        <td class="px-6 py-4">
                                            {{ $revision->exam_submission->exam_type->name ?? '–' }}
                                        </td>

                                        {{-- สถานะ --}}
                                        @if ($revision->status === '0')
                                            <td class="px-6 py-4 text-center">
                                                <span
                                                    class="px-2 py-0.5 mb-2 bg-green-200 text-green-800 rounded-md truncate">อนุมัติ</span>
                                            </td>
                                        @else
                                            <td class="px-6 py-4 text-center">
                                                @php
                                                    $approved = $revision->approve_count;
                                                    $rejected = $revision->rejected_count;
                                                    // ถ้ายังไม่มี record ใดๆ waiting = total
                                                    $waiting = $total_invigilator - ($approved + $rejected);
                                                @endphp

                                                <span
                                                    class="px-2 py-0.5 mb-2 bg-yellow-200 text-yellow-800 rounded-md truncate">รออนุมัติ:
                                                    {{ $waiting ?? '0' }}</span> 
                                                <span
                                                    class="px-2 py-0.5 mb-2 bg-green-200 text-green-800 rounded-md truncate">อนุมัติ:
                                                    {{ $approved ?? '0' }}</span>
                                                <span
                                                    class="px-2 py-0.5 bg-red-200 text-red-800 rounded-md truncate">ไม่อนุมัติ:
                                                    {{ $rejected ?? '0' }}</span>
                                            </td>
                                        @endif

                                        {{-- ปุ่ม Action --}}
                                        <td class="px-6 py-4 text-center truncate">
                                            {{-- แก้ไขได้เฉพาะถ้ายังรออนุมัติ --}}

                                            @if ($revision->status === '0')
                                                <button type="button" title="รายละเอียด"
                                                    onclick="window.location.href='{{ route('student.revision.show', ['revisionId' => $revision->id]) }}'"
                                                    class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                    <i class="fa-solid fa-eye fa-lg"></i>
                                                </button>
                                            @else
                                                <button type="button" title="แก้ไข"
                                                    onclick="window.location.href='{{ route('student.revision.edit', ['revision' => $revision->id]) }}'"
                                                    class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                    <i class="fa-solid fa-pen fa-lg"></i>
                                                </button>
                                                <button type="button" title="รายละเอียด"
                                                    onclick="window.location.href='{{ route('student.revision.show', ['revisionId' => $revision->id]) }}'"
                                                    class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                    <i class="fa-solid fa-eye fa-lg"></i>
                                                </button>
                                            @endif
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
