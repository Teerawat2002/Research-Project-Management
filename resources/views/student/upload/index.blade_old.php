<x-app-layout>
    <div class="mt-16 py-8" x-data="{ showPdf: false, pdfUrl: '', pdfTitle: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-blue-700">รายการไฟล์วิจัย</h2>

                    @if (!$hasUpload)
                    <a href="{{ route('student.upload.create', ['proposeId' => $proposes->id]) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow-md transition">
                        + อัปโหลดไฟล์
                    </a>
                    @else
                    <span class="text-sm text-gray-500">
                        ได้อัปโหลดไฟล์แล้ว หากต้องการแก้ไขให้กด “แก้ไข” ในรายการ
                    </span>
                    @endif
                </div>

                <div class="overflow-x-auto rounded-lg">
                    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3">ชื่อเรื่อง</th>
                                <th class="px-6 py-3 text-center">อาจารย์ที่ปรึกษา</th>
                                <th class="px-6 py-3 text-center">บทคัดย่อ</th>
                                <th class="px-6 py-3 text-center">ปกโครรงงาน</th>
                                <th class="px-6 py-3 text-center">ไฟล์โครงงาน</th>
                                <th class="px-6 py-3 text-center">การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white odd:bg-gray-50">
                            @foreach ($upload as $uploads)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $uploads->revision->exam_submission->propose->title }}</td>

                                @foreach ($proposes as $propose)
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $propose->advisor->a_fname . " " . $propose->advisor->a_lname ?? '-' }}
                                </td>
                                @endforeach

                                <td class="px-6 py-4 text-center">
                                    <button @click="pdfUrl='{{ url('/preview-pdf/' . urlencode($uploadpdf->abstract)) }}'; pdfTitle='บทคัดย่อ'; showPdf=true"
                                        class="text-blue-600 hover:text-blue-800 font-semibold">
                                        <i class="fa-solid fa-eye"></i> ดู
                                    </button>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <button @click="pdfUrl='{{ url('/preview-pdf/' . urlencode($uploadpdf->cover_image)) }}'; pdfTitle='ปกเอกสาร'; showPdf=true"
                                        class="text-blue-600 hover:text-blue-800 font-semibold">
                                        <i class="fa-solid fa-eye"></i> ดู
                                    </button>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <button @click="pdfUrl='{{ url('/preview-pdf/' . urlencode($uploadpdf->pdf_file)) }}'; pdfTitle='ไฟล์วิจัย'; showPdf=true"
                                        class="text-blue-600 hover:text-blue-800 font-semibold">
                                        <i class="fa-solid fa-eye"></i> ดู
                                    </button>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center space-x-4">
                                        <!-- <a href="{{ route('student.uploadpdf.edit', ['id' => $uploadpdf->id]) }}"
                                               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold shadow">
                                                แก้ไข
                                            </a> -->
                                        <form action="{{ route('student.upload.edit', ['id' => $uploadpdf->id]) }}" method="GET" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT') <!-- ใช้ @method('PUT') เพื่อส่งคำขอเป็น PUT -->
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold shadow">
                                                แก้ไข
                                            </button>
                                        </form>
                                        <form action="{{ route('student.upload.delete') }}" method="POST" class="delete-form inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $uploadpdf->id }}">
                                            <button type="button" class="delete-btn bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold shadow" data-title="{{ $uploadpdf->title }}">
                                                ลบ
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- MODAL PDF Preview -->
        <div x-show="showPdf" x-cloak class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white rounded-xl overflow-hidden w-11/12 max-w-5xl h-[90%] flex flex-col shadow-lg">
                <div class="flex justify-between items-center bg-blue-600 text-white px-6 py-3">
                    <h2 class="font-bold text-lg" x-text="pdfTitle"></h2>
                    <button @click="showPdf = false" class="text-white hover:text-gray-200 text-2xl font-bold">&times;</button>
                </div>
                <iframe :src="pdfUrl" class="flex-1 w-full" frameborder="0"></iframe>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 & Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>
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

        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'ลบข้อมูลสำเร็จ',
            text: '{{ session('
            success ') }}',
            confirmButtonText: 'ตกลง'
        }).then(() => {
            window.location.href = "{{ route('student.uploadpdf.index') }}";
        });
        @endif
    </script>
</x-app-layout>