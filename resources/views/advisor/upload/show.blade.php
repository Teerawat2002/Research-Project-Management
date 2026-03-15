<x-app-layout>
    <div class="mt-16 py-8" x-data="{ showPdf: false, pdfUrl: '', pdfTitle: '', showImg: false, imgUrl: '' }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden">
                <div class="p-8">
                    <h2 class="text-3xl font-bold mb-6 text-blue-700">ข้อมูลการอนุมัติไฟล์โครงงานวิจัย</h2>

                    {{-- ชื่อโครงงาน --}}
                    <div class="mb-6">
                        <div class="text-sm text-gray-600 dark:text-gray-300">ชื่อโครงงานวิจัย</div>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white">
                            {{ $propose->title ?? '-' }}
                        </h3>
                    </div>

                    {{-- ปุ่มพรีวิวไฟล์ --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <div>
                            <div class="text-sm text-gray-600 dark:text-gray-300 mb-2">หน้าปก (รูปภาพ)</div>
                            @if ($coverPreviewUrl)
                                <img src="{{ $coverPreviewUrl }}" alt="หน้าปกโครงงาน"
                                    class="max-h-[420px] object-cover rounded-lg border shadow cursor-zoom-in"
                                    @click="imgUrl='{{ $coverPreviewUrl }}'; showImg=true">
                                <div class="text-xs text-gray-400 mt-1">คลิกที่รูปเพื่อขยาย</div>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </div>

                        <div>
                            <div class="text-sm text-gray-600 dark:text-gray-300 mb-2">บทคัดย่อ (PDF)</div>
                            @if ($file?->abstract_file)
                                <button type="button"
                                    @click="pdfUrl='{{ route('advisor.upload.preview', ['upload' => $upload->id, 'type' => 'abstract']) }}';
                                            pdfTitle='บทคัดย่อ'; showPdf=true"
                                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5">
                                    <i class="fa-solid fa-eye"></i> เปิดดู
                                </button>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </div>

                        <div>
                            <div class="text-sm text-gray-600 dark:text-gray-300 mb-2">ไฟล์โครงงาน (PDF)</div>
                            @if ($file?->project_file)
                                <button type="button"
                                    @click="pdfUrl='{{ route('advisor.upload.preview', ['upload' => $upload->id, 'type' => 'project']) }}';
                                            pdfTitle='ไฟล์โครงงาน'; showPdf=true"
                                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5">
                                    <i class="fa-solid fa-eye"></i> เปิดดู
                                </button>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-8">
                        <x-input-default-label for="keyword" :value="__('คำสำคัญ')" />
                        <div class="mt-1 w-full rounded-md border border-gray-300 bg-gray-100 text-gray-800 px-3 py-2">
                            {{ $upload->keyword ?? '-' }}
                        </div>
                    </div>

                    {{-- สถานะการอนุมัติ --}}
                    @php $status = (int) ($upload->status ?? 1); @endphp
                    <div class="mb-2 text-sm text-gray-600 dark:text-gray-300">สถานะการอนุมัติ</div>
                    <div class="mb-6">
                        @switch($status)
                            @case(0)
                                <span class="px-3 py-1 text-sm rounded-md bg-green-100 text-green-800">อนุมัติแล้ว</span>
                            @break

                            @case(1)
                                <span class="px-3 py-1 text-sm rounded-md bg-yellow-100 text-yellow-800">รออนุมัติ</span>
                            @break

                            @case(2)
                                <span class="px-3 py-1 text-sm rounded-md bg-red-100 text-red-800">ปฏิเสธ</span>
                            @break

                            @default
                                <span class="px-3 py-1 text-sm rounded-md bg-gray-100 text-gray-800">ไม่ทราบสถานะ</span>
                        @endswitch
                    </div>

                    <div class="mb-2">
                        <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            ข้อเสนอแนะ/เหตุผล
                        </label>
                        <textarea id="comment" name="comment" rows="4"
                            class="mt-1 block w-full rounded-md border border-gray-300 bg-white text-gray-800" readonly>{{ $upload->comment ?? '-' }}</textarea>
                    </div>

                    {{-- เวลาอัปเดตล่าสุด --}}
                    <div class="text-sm text-gray-600 dark:text-gray-300">
                        อัปเดตล่าสุด:
                        <span class="font-medium text-gray-400">
                            {{ optional($upload->updated_at)->format('d/m/Y') ?? '-' }}
                        </span>
                    </div>

                    {{-- ปุ่มย้อนกลับ --}}
                    <div class="flex justify-end mt-8">
                        <a href="{{ route('advisor.upload.index') }}"
                            class="inline-flex items-center bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                            ย้อนกลับ
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL Image Preview (รูปปก) -->
        <div :class="{ 'hidden': !showImg }" x-transition.opacity
            class="hidden fixed inset-0 z-50 bg-black/70 flex items-center justify-center p-4">
            <div class="bg-white rounded-xl overflow-hidden w-full max-w-4xl shadow-lg">
                <div class="flex justify-between items-center bg-gray-800 text-white px-6 py-3">
                    <h2 class="font-bold text-lg">หน้าปกโครงงาน</h2>
                    <button @click="showImg = false"
                        class="text-white hover:text-gray-200 text-2xl font-bold">&times;</button>
                </div>
                <div class="p-4">
                    <img :src="imgUrl" alt="preview" class="max-h-[75vh] mx-auto object-contain">
                </div>
            </div>
        </div>

        <!-- MODAL PDF Preview -->
        <div :class="{ 'hidden': !showPdf }" x-transition.opacity
            class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center">
            <div class="bg-white rounded-xl overflow-hidden w-11/12 max-w-5xl h-[90%] flex flex-col shadow-lg">
                <div class="flex justify-between items-center bg-blue-600 text-white px-6 py-3">
                    <h2 class="font-bold text-lg" x-text="pdfTitle"></h2>
                    <button @click="showPdf = false; pdfUrl=''"
                        class="text-white hover:text-gray-200 text-2xl font-bold">&times;</button>
                </div>
                <iframe :src="pdfUrl" class="flex-1 w-full" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</x-app-layout>
