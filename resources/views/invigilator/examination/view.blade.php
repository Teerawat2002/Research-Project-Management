<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">

                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                    รายละเอียดการยื่นขอสอบ
                </h2>

                @if (session('success'))
                    <div
                        class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-green-800 dark:text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <dl class="grid grid-cols-1 gap-4 text-gray-800 dark:text-gray-200">
                    {{-- ชื่อโครงงาน --}}
                    <div class="flex">
                        <dt class="w-1/3 font-medium">ชื่อโครงงาน:</dt>
                        <dd class="w-2/3">{{ $examsubmission->propose->title ?? '-' }}</dd>
                    </div>

                    {{-- สมาชิกกลุ่ม --}}
                    <div class="flex">
                        <dt class="w-1/3 font-medium">สมาชิกกลุ่มโครงงาน:</dt>
                        <dd class="w-2/3">
                            @if ($members->isEmpty())
                                <span class="text-gray-500">ไม่พบสมาชิกในกลุ่มนี้</span>
                            @else
                                <ul class="list-disc list-inside">
                                    @foreach ($members as $member)
                                        {{-- @php $adv = $member->invi_group_member->advisor; @endphp --}}
                                        <li>{{ $member->student->s_fname }} {{ $member->student->s_lname }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </dd>
                    </div>

                    {{-- รายวิชา --}}
                    <div class="flex">
                        <dt class="w-1/3 font-medium">รายวิชา:</dt>
                        <dd class="w-2/3">{{ $examsubmission->exam_type->name ?? '-' }}</dd>
                    </div>

                    {{-- ประเภทโครงงาน --}}
                    <div class="flex">
                        <dt class="w-1/3 font-medium">ประเภทโครงงาน:</dt>
                        <dd class="w-2/3">{{ $examsubmission->propose->project_type->name ?? '-' }}</dd>
                    </div>

                    {{-- ครั้งที่สอบ --}}
                    <div class="flex">
                        <dt class="w-1/3 font-medium">ครั้งที่สอบ:</dt>
                        <dd class="w-2/3">{{ $examsubmission->attempt ?? '-' }}</dd>
                    </div>

                    {{-- ไฟล์โครงงาน --}}
                    <div class="flex">
                        <dt class="w-1/3 font-medium">ไฟล์โครงงาน:</dt>
                        <dd class="w-2/3"><a
                                href="{{ route('invigilator.examination.subDownload', ['id' => $examsubmission->id]) }}"
                                class="text-blue-600 hover:underline flex items-center">
                                <img src="{{ asset('icons/pdf.png') }}" alt="PDF Icon" class="w-8 h-8 mr-2">
                                ดาวน์โหลด PDF
                            </a></dd>
                    </div>
                </dl>

                {{-- ปุ่มกลับ --}}
                <div class="mt-6 flex justify-end">
                    <button type="button" onclick="location.href='{{ route('invigilator.examination.index') }}'"
                        class="px-5 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        กลับ
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
