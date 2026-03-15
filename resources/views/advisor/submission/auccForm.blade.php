<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-8 pt-12 sm:pt-20 pb-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <section
                    class="bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden">
                    <div
                        class="bg-slate-50 dark:bg-slate-700/50 px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                        <h2 class="text-lg font-semibold text-slate-800 dark:text-white flex items-center">
                            <i class="fa-solid fa-circle-info mr-2 text-blue-500"></i> รายละเอียดโครงงาน
                        </h2>
                    </div>

                    <div class="p-6 space-y-6">
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">ชื่อโครงงาน</label>
                            <p class="text-lg font-medium text-slate-900 dark:text-white leading-relaxed">
                                {{ optional($submission)->propose->title ?: 'ไม่ระบุชื่อโครงงาน' }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-700">
                            <label
                                class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">สมาชิกในกลุ่ม</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @forelse ($groupMembers as $member)
                                    <div
                                        class="flex items-center p-3 bg-slate-50 dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800">
                                        <div
                                            class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-xs mr-3">
                                            {{ mb_substr($member->student->name ?? 'U', 0, 1, 'UTF-8') }}
                                        </div>
                                        <span class="text-slate-700 dark:text-slate-300 font-medium">
                                            {{ $member->student->name ?? 'Unknown Student' }}
                                        </span>
                                    </div>
                                @empty
                                    <p class="text-slate-500 italic text-sm">ไม่มีสมาชิกในกลุ่มนี้</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="lg:col-span-1">
                <form method="POST" action="{{ route('advisor.submission.saveAucc', $submission->id) }}"
                    class="sticky top-8">
                    @csrf
                    <div
                        class="bg-white dark:bg-slate-800 shadow-xl border border-blue-100 dark:border-slate-700 rounded-2xl p-6">
                        <h2 class="text-xl font-bold text-slate-800 dark:text-white mb-6 flex items-center">
                            <i class="fa-solid fa-star mr-2 text-yellow-400"></i> ให้เกรดประเมิน
                        </h2>

                        @foreach ($groupMembers as $member)
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                    {{ $member->student->name }}
                                </label>

                                <select name="advisor_score[{{ $member->id }}]" required
                                    class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 text-slate-800 dark:text-white py-2">

                                    <option value="" disabled selected>-- เลือกเกรด --</option>

                                    @foreach (['A', 'B+', 'B', 'C+', 'C', 'D+', 'D'] as $g)
                                        <option value="{{ $g }}">
                                            {{ $g }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        @endforeach

                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl mb-6">
                            <p class="text-xs text-blue-600 dark:text-blue-400 leading-relaxed">
                                <i class="fa-solid fa-circle-exclamation mr-1"></i>
                                <strong>หมายเหตุ:</strong> คะแนนนี้จะถูกส่งไปยังระบบส่วนกลาง
                                ไม่สามารถแก้ไขได้หลังจากยืนยัน (ขึ้นอยู่กับนโยบาย)
                            </p>
                        </div>

                        <button type="button" onclick="confirmSubmit(this.form)"
                            class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold shadow-l transition-all transform active:scale-[0.98] flex items-center justify-center">
                            <i class="fa-solid fa-floppy-disk mr-2"></i> บันทึกคะแนน
                        </button>

                        {{-- <a href="{{ route('advisor.submission.index') }}"
                            class="block text-center mt-4 text-sm text-slate-500 hover:text-slate-800 dark:hover:text-slate-300 transition-colors">
                            ยกเลิกและย้อนกลับ
                        </a> --}}
                        <button type="button" onclick="window.location.href='{{ route('advisor.submission.index') }}'"
                            class="w-full py-4 bg-gray-600 hover:bg-gray-700 text-white rounded-xl font-bold shadow-l transition-all transform active:scale-[0.98] flex items-center justify-center mt-4">
                            <i class="fa-solid fa-angles-left mr-2"></i> ยกเลิกและย้อนกลับ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmSubmit(form) {

            let selects = document.querySelectorAll("select[name^='advisor_score']");
            let incomplete = false;

            selects.forEach(function(select) {
                if (!select.value) {
                    incomplete = true;
                }
            });

            if (incomplete) {
                Swal.fire({
                    icon: 'error',
                    title: 'ข้อมูลไม่ครบ',
                    text: 'กรุณาเลือกเกรดให้ครบทุกคนก่อนบันทึก',
                });
                return;
            }

            Swal.fire({
                title: 'ยืนยันการบันทึก?',
                text: "คุณต้องการบันทึกเกรดของนักศึกษาทั้งหมดใช่หรือไม่",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    html: `
                    <ul style="text-align:left;">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                    confirmButtonText: 'ตกลง'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'ผิดพลาด',
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

        });
    </script>
</x-app-layout>
