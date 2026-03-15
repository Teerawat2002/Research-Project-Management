<x-app-layout>
    <div class="mt-16 py-8" x-data="{ showPdf: false, pdfUrl: '', pdfTitle: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-blue-700">รายการไฟล์โครงงานวิจัย</h2>

                    @if (!$hasUpload)
                        <a href="{{ route('student.upload.create', ['proposeId' => $proposes->id]) }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition">
                            + อัปโหลดไฟล์
                        </a>
                    @else
                        <span class="text-sm text-gray-600 dark:text-gray-400">
                            ได้อัปโหลดไฟล์แล้ว หากต้องการแก้ไขให้กด “แก้ไข” ในรายการ
                        </span>
                    @endif
                </div>

                <div class="overflow-x-auto rounded-lg">
                    <table
                        class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3 truncate">ชื่อโครงงาน</th>
                                <th class="px-6 py-3 text-center truncate">อาจารย์ที่ปรึกษา</th>
                                <th class="px-6 py-3 text-center">สถานะ</th>
                                <th class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white odd:bg-gray-50">
                            @forelse ($uploads as $upload)
                                @php
                                    $propose = $upload->revision->exam_submission->propose ?? null;
                                    $advisor = $propose?->advisor ?? null;
                                    $file = $upload->file; // ถูกสั่ง latest('id') ไว้แล้ว
                                @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $propose->title ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-center text-gray-900">
                                        {{ trim(($advisor->a_fname ?? '') . ' ' . ($advisor->a_lname ?? '')) ?: '-' }}
                                    </td>

                                    <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                        @switch($upload->status)
                                            @case(0)
                                                <span
                                                    class="px-2 py-0.5 bg-green-200 text-green-800 rounded-md truncate">ได้รับการอนุมัติ</span>
                                            @break

                                            @case(1)
                                                <span
                                                    class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md truncate">รอการอนุมัติ</span>
                                            @break

                                            @case(2)
                                                <span
                                                    class="px-2 py-0.5 bg-red-200 text-red-800 rounded-md truncate">ถูกปฏิเสธ</span>
                                            @break

                                            @default
                                                <span
                                                    class="px-2 py-0.5 bg-gray-200 text-gray-800 rounded-md truncate">สถานะไม่รู้จัก</span>
                                        @endswitch
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center space-x-3">
                                            @if ($upload->status == 1)
                                                <button type="button" title="แก้ไข"
                                                    onclick="window.location.href='{{ route('student.upload.edit', ['upload' => $upload->id]) }}'"
                                                    class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                    <i class="fa-solid fa-pen fa-lg"></i>
                                                </button>
                                                <button type="button" title="ดูรายละเอียด"
                                                    onclick="window.location.href='{{ route('student.upload.show', ['upload' => $upload->id]) }}'"
                                                    class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                    <i class="fa-solid fa-eye fa-lg"></i>
                                                </button>
                                            @elseif ($upload->status == 2)
                                                <button type="button" title="แก้ไข"
                                                    onclick="window.location.href='{{ route('student.upload.edit', ['upload' => $upload->id]) }}'"
                                                    class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                    <i class="fa-solid fa-pen fa-lg"></i>
                                                </button>
                                            @else
                                                <button type="button" title="ดูรายละเอียด"
                                                    onclick="window.location.href='{{ route('student.upload.show', ['upload' => $upload->id]) }}'"
                                                    class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                    <i class="fa-solid fa-eye fa-lg"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                                            ยังไม่มีไฟล์อัปโหลด
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- MODAL PDF Preview -->
            {{-- <div :class="{ 'hidden': !showPdf }" x-transition.opacity
                class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center">
                <div class="bg-white rounded-xl overflow-hidden w-11/12 max-w-5xl h-[90%] flex flex-col shadow-lg">
                    <div class="flex justify-between items-center bg-blue-600 text-white px-6 py-3">
                        <h2 class="font-bold text-lg" x-text="pdfTitle"></h2>
                        <button @click="showPdf = false"
                            class="text-white hover:text-gray-200 text-2xl font-bold">&times;</button>
                    </div>
                    <iframe :src="pdfUrl" class="flex-1 w-full" frameborder="0"></iframe>
                </div>
            </div> --}}
        </div>

        <script>
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('.delete-form');
                    const title = this.getAttribute('data-title');

                    Swal.fire({
                        title: 'คุณแน่ใจหรือไม่?',
                        html: `<div class="text-lg">ลบรายการ<br><span class="text-red-500 font-bold">${title}</span><br><span style='font-size:14px;'>ข้อมูลที่ลบจะไม่สามารถกู้คืนได้!!!</span></div>`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'ใช่, ลบเลย!',
                        cancelButtonText: 'ยกเลิก'
                    }).then(result => {
                        if (result.isConfirmed) form.submit();
                    });
                });
            });

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'ตกลง'
                }).then(() => {
                    window.location.href = "{{ route('student.upload.index') }}";
                });
            @endif
        </script>
    </x-app-layout>
