<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-xl overflow-hidden">
                <div class="p-8 text-gray-900">
                    <h2 class="text-3xl font-bold mb-6 text-blue-700">อัปโหลดไฟล์ PDF</h2>
                    <form id="uploadForm" action="{{ route('student.upload.store', ['proposeId' => $proposes->id]) }}"
                        method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="title" :value="__('ชื่อโครงงานวิจัย')" />
                            {{-- <label class="block text-gray-700 font-medium mb-1">ชื่อเรื่อง</label> --}}
                            <h3>{{ $proposes->title }}</h3>
                        </div>

                        <div>
                            <x-input-label for="cover_file" :value="__('หน้าปก')" />
                            {{-- <label class="block text-gray-700 font-medium mb-1">ปก</label> --}}
                            <input id="cover_file" name="cover_file" type="file" accept="image/*"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>
                        <div class="mt-2 hidden" id="cover_preview_wrap">
                            <img id="cover_preview" class="max-h-64 rounded-lg border" alt="ตัวอย่างรูปหน้าปก">
                            <div class="mt-2 text-sm text-gray-600" id="cover_meta"></div>
                            <button type="button" id="cover_remove_btn"
                                class="mt-2 px-3 py-1 rounded-md border text-gray-700 hover:bg-gray-50">
                                ลบรูปหน้าปก
                            </button>
                        </div>

                        <div>
                            <x-input-label for="file_input" :value="__('บทคัดย่อ')" />
                            {{-- <label for="file_input" class="block text-gray-700 font-medium mb-1">บทคัดย่อ</label> --}}
                            <input name="abstract" type="file" accept=".pdf"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                        <div>
                            <x-input-label for="project_file" :value="__('ไฟล์โครงงาน (บทที่ 1–5 รวมคำนำ สารบัญ ฯลฯ)')" />
                            {{-- <label class="block text-gray-700 font-medium mb-1">ไฟล์บท <span
                                    class="text-sm text-gray-500">(บทที่ 1–5 รวมคำนำ สารบัญ ฯลฯ)</span></label> --}}
                            <input name="project_file" type="file" accept=".pdf"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        </div>

                        <div>
                            <x-input-label for="keyword" :value="__('คำสำคัญ')" />
                            <x-text-input id="keyword" name="keyword" type="text" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <p class="text-sm text-red-500">* กรุณาอัปโหลดไฟล์ Abstract/Project ที่มีนามสกุล .pdf เท่านั้น</p>
                        </div>

                        <div class="flex items-center space-x-4">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">อัปโหลด</button>
                            <a href="{{ route('student.upload.index') }}"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition">ยกเลิก</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Upload Script --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('uploadForm');
            const keywordsInput = document.querySelector('input[name="keyword"]');
            const abstractInput = document.querySelector('input[name="abstract"]');
            const coverInput = document.querySelector('input[name="cover_file"]');
            const pdfInput = document.querySelector('input[name="project_file"]');

            if (!form) return;

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!keywordsInput.value.trim()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'กรุณากรอกคำสำคัญ',
                        confirmButtonText: 'ตกลง'
                    });
                    return;
                }

                const missing = [];
                if (!abstractInput.files.length) missing.push('บทคัดย่อ');
                if (!coverInput.files.length) missing.push('หน้าปก');
                if (!pdfInput.files.length) missing.push('ไฟล์โครงงาน');
                // if (!keywordsInput.files.length) missing.push('คำสำคัญ');

                if (missing.length) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'กรุณาอัปโหลดไฟล์',
                        text: `ขาด: ${missing.join(', ')}`
                    });
                    return;
                }

                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(async (res) => {
                        const data = await res.json().catch(() => ({}));
                        if (!res.ok || data.success === false) {
                            throw new Error(data.message || 'อัปโหลดไม่สำเร็จ');
                        }
                        return data;
                    })
                    .then(() => {
                        Swal.fire({
                                icon: 'success',
                                title: 'อัปโหลดสำเร็จ',
                                timer: 2000,
                                showConfirmButton: false
                            })
                            .then(() => window.location.href = "{{ route('student.upload.index') }}");
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
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('uploadForm');
            const keywordsInput = document.querySelector('input[name="keyword"]');
            const abstractInput = document.querySelector('input[name="abstract"]');
            const coverInput = document.getElementById('cover_file') || document.querySelector(
                'input[name="cover_file"]');
            const pdfInput = document.querySelector('input[name="project_file"]');

            // ====== พรีวิวรูปหน้าปก ======
            const previewWrap = document.getElementById('cover_preview_wrap');
            const previewImg = document.getElementById('cover_preview');
            const previewMeta = document.getElementById('cover_meta');
            const removeBtn = document.getElementById('cover_remove_btn');
            let currentObjectUrl = null;

            function bytesToSize(bytes) {
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                if (bytes === 0) return '0 Byte';
                const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)), 10);
                return Math.round(bytes / Math.pow(1024, i)) + ' ' + sizes[i];
            }

            function clearPreview() {
                if (currentObjectUrl) {
                    URL.revokeObjectURL(currentObjectUrl);
                    currentObjectUrl = null;
                }
                previewImg.removeAttribute('src');
                previewMeta.textContent = '';
                previewWrap.classList.add('hidden');
                coverInput.value = ''; // ล้างไฟล์ใน input
            }

            function showPreview(file) {
                // ตรวจชนิดไฟล์ซ้ำอีกชั้น (กันเผื่อ)
                if (!file.type.startsWith('image/')) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'ไฟล์ไม่ใช่รูปภาพ',
                        text: 'กรุณาเลือกไฟล์รูปภาพเท่านั้น'
                    });
                    clearPreview();
                    return;
                }

                // จำกัดขนาดไฟล์ (10MB)
                const maxSize = 10 * 1024 * 1024;
                if (file.size > maxSize) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'ไฟล์ใหญ่เกินไป',
                        text: 'ขนาดสูงสุด 10MB'
                    });
                    clearPreview();
                    return;
                }

                if (currentObjectUrl) URL.revokeObjectURL(currentObjectUrl);
                currentObjectUrl = URL.createObjectURL(file);

                previewImg.src = currentObjectUrl;
                previewMeta.textContent = `${file.name} • ${bytesToSize(file.size)}`;
                previewWrap.classList.remove('hidden');
            }

            if (coverInput) {
                coverInput.addEventListener('change', (e) => {
                    const file = e.target.files?.[0];
                    if (!file) {
                        clearPreview();
                        return;
                    }
                    showPreview(file);
                });
            }

            if (removeBtn) {
                removeBtn.addEventListener('click', clearPreview);
            }

            if (!form) return;

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!keywordsInput.value.trim()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'กรุณากรอกคำสำคัญ',
                        confirmButtonText: 'ตกลง'
                    });
                    return;
                }

                const missing = [];
                if (!abstractInput.files.length) missing.push('บทคัดย่อ');
                if (!coverInput.files.length) missing.push('หน้าปก');
                if (!pdfInput.files.length) missing.push('ไฟล์โครงงาน');

                if (missing.length) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'กรุณาอัปโหลดไฟล์',
                        text: `ขาด: ${missing.join(', ')}`
                    });
                    return;
                }

                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(async (res) => {
                        const data = await res.json().catch(() => ({}));
                        if (!res.ok || data.success === false) {
                            throw new Error(data.message || 'อัปโหลดไม่สำเร็จ');
                        }
                        return data;
                    })
                    .then(() => {
                        Swal.fire({
                                icon: 'success',
                                title: 'อัปโหลดสำเร็จ',
                                timer: 2000,
                                showConfirmButton: false
                            })
                            .then(() => window.location.href = "{{ route('student.upload.index') }}");
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
