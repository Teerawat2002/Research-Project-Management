<x-app-layout>
    <div class="mt-16 py-8" x-data="{ showPdf: false, pdfUrl: '', pdfTitle: '', showImg: false, imgUrl: '' }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden">
                <div class="p-8 text-gray-900">
                    <h2 class="text-3xl font-bold mb-6 text-blue-700">อนุมัติไฟล์โครงงานวิจัย</h2>

                    <div class="mb-6">
                        <div class="text-sm text-gray-600 dark:text-gray-300">ชื่อโครงงานวิจัย</div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            {{ $propose->title ?? '-' }}
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
                        <div class="md:pl-4 md:sticky md:top-6">
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
                        </div>

                        <div class="flex flex-row space-x-10">
                            <div>
                                <div class="text-sm text-gray-600 dark:text-gray-300">บทคัดย่อ (PDF)</div>
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
                                <div class="text-sm text-gray-600 dark:text-gray-300">ไฟล์โครงงาน (PDF)</div>
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
                    </div>

                    <div class="mb-8">
                        <x-input-default-label for="keyword" :value="__('คำสำคัญ')" />
                        <div
                            class="mt-1 w-full rounded-md border border-gray-300 bg-gray-100 text-gray-800 px-3 py-2">
                            {{ $upload->keyword ?? '-' }}
                        </div>
                    </div>

                    <form id="approvalForm" action="{{ route('advisor.upload.update', $upload->id) }}" method="POST"
                        class="space-y-6">
                        @csrf
                        {{-- method spoofing จะใส่ผ่าน JS --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">การอนุมัติ</label>
                            <div class="flex items-center space-x-6 mt-2">
                                <label class="flex items-center">
                                    <input type="radio" name="approval" value="approved"
                                        class="text-blue-500 focus:ring-blue-500">
                                    <span class="ml-2 text-gray-900 dark:text-white">อนุมัติ</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="approval" value="rejected"
                                        class="text-red-500 focus:ring-red-500">
                                    <span class="ml-2 text-gray-900 dark:text-white">ปฏิเสธ</span>
                                </label>
                            </div>
                            <p id="approvalError" class="text-red-600 text-sm mt-1 hidden"></p>
                        </div>

                        <div>
                            <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                ข้อเสนอแนะ/เหตุผล (ถ้าปฏิเสธควรระบุ)
                            </label>
                            <textarea id="comment" name="comment" rows="4"
                                class="mt-1 block w-full rounded-md border border-gray-300 bg-white text-gray-800"></textarea>
                            <p id="commentError" class="text-red-600 text-sm mt-1 hidden"></p>
                        </div>

                        <div class="flex justify-end items-center space-x-4">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                                บันทึก
                            </button>
                            <a href="{{ route('advisor.upload.index') }}"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                                ย้อนกลับ
                            </a>
                        </div>
                    </form>
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
                    <button @click="showPdf = false"
                        class="text-white hover:text-gray-200 text-2xl font-bold">&times;</button>
                </div>
                <iframe :src="pdfUrl" class="flex-1 w-full" frameborder="0"></iframe>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('approvalForm');
            const approvalError = document.getElementById('approvalError');
            const commentError = document.getElementById('commentError');

            form.addEventListener('submit', (e) => {
                e.preventDefault();
                approvalError.classList.add('hidden');
                commentError.classList.add('hidden');

                const fd = new FormData(form);
                fd.append('_method', 'PUT');

                const approval = fd.get('approval');
                const comment = fd.get('comment')?.trim();

                if (!approval) {
                    approvalError.textContent = 'กรุณาเลือกผลการอนุมัติ';
                    approvalError.classList.remove('hidden');
                    return;
                }
                if (approval === 'rejected' && !comment) {
                    commentError.textContent = 'กรุณาระบุเหตุผลเมื่อปฏิเสธ';
                    commentError.classList.remove('hidden');
                    return;
                }

                fetch(form.action, {
                        method: 'POST',
                        body: fd,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(async (res) => {
                        const data = await res.json().catch(() => ({}));
                        if (!res.ok || data.success === false) {
                            const msg = data.errors ? Object.values(data.errors)[0][0] : (data
                                .message || 'บันทึกไม่สำเร็จ');
                            throw new Error(msg);
                        }
                        return data;
                    })
                    .then((data) => {
                        Swal.fire({
                                icon: 'success',
                                title: data.message || 'บันทึกสำเร็จ',
                                timer: 1800,
                                showConfirmButton: false
                            })
                            .then(() => window.location.href = "{{ route('advisor.upload.index') }}");
                    })
                    .catch(err => {
                        Swal.fire({
                            icon: 'error',
                            title: 'ผิดพลาด',
                            text: err.message || 'โปรดลองอีกครั้ง'
                        });
                    });
            });
        });
    </script>
</x-app-layout>
