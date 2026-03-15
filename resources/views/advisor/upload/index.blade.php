<x-app-layout>
    <div class="mt-16 py-8" x-data="{ showPdf: false, pdfUrl: '', pdfTitle: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-blue-700">รายการไฟล์โครงงานวิจัย</h2>
                </div>

                <div class="flex justify-start mb-4">
                    <form method="GET" action="{{ route('advisor.upload.index') }}"
                        class="flex space-x-4 items-center">

                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="ค้นหาชื่อโครงงาน..."
                                class="border border-gray-300 rounded-lg px-4 py-2 pr-10 text-sm focus:ring focus:ring-blue-200 w-64">
                        </div>

                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                            <i class="fa-solid fa-magnifying-glass"></i> ค้นหา
                        </button>
                    </form>
                </div>

                <div class="overflow-x-auto rounded-lg">
                    <table
                        class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 uppercase text-md">
                            <tr>
                                <th class="px-6 py-3 truncate">ชื่อโครงงาน</th>
                                <th class="px-6 py-3 text-center truncate">อาจารย์ที่ปรึกษา</th>
                                {{-- <th class="px-6 py-3 text-center truncate">บทคัดย่อ</th>
                                <th class="px-6 py-3 text-center truncate">หน้าปก</th>
                                <th class="px-6 py-3 text-center">ไฟล์</th> --}}
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

                                    {{-- สถานะการอนุมัติ --}}
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
                                        {{-- <div class="flex justify-center space-x-3">
                                            <button type="button" title="อนุมัติ"
                                                onclick="window.location.href='{{ route('advisor.upload.approve', ['uploadId' => $upload->id]) }}'"
                                                class="text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                <i class="fa-solid fa-pen fa-lg"></i>
                                            </button>
                                            <button type="button" title="ดูรายละเอียด"
                                                onclick="window.location.href='{{ route('advisor.upload.show', ['upload' => $upload->id]) }}'"
                                                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                <i class="fa-solid fa-eye fa-lg"></i>
                                            </button>
                                        </div> --}}

                                        <div class="flex justify-center space-x-3">
                                            @if ($upload->status == 1)
                                                {{-- แสดงเฉพาะปุ่มอนุมัติ เมื่อสถานะ = 1 (รออนุมัติ) --}}
                                                <button type="button" title="อนุมัติ"
                                                    onclick="window.location.href='{{ route('advisor.upload.approve', ['uploadId' => $upload->id]) }}'"
                                                    class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                    <i class="fa-solid fa-pen fa-lg"></i>
                                                </button>
                                            @else
                                                {{-- สถานะอื่น ๆ: แสดงเฉพาะปุ่มดูรายละเอียด --}}
                                                <button type="button" title="ดูรายละเอียด"
                                                    onclick="window.location.href='{{ route('advisor.upload.show', ['upload' => $upload->id]) }}'"
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
                    <div class="mt-4">
                        {{ $uploads->links() }}
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
    </x-app-layout>
