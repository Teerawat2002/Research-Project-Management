<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">

                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">
                    เกรดการสอบ: {{ $submission->propose->title }} ({{ $submission->exam_type->name }})
                </h2>

                @php
                    // จัดกลุ่มเกรดตาม invigilator
                    $gradesByInvigilator = $grades->groupBy('exam_invi_id');
                @endphp

                @forelse($gradesByInvigilator as $examInviId => $groupedGrades)
                    @php
                        // ดึง record ของกรรมการ
                        $invRecord = $groupedGrades->first()->exam_invi_member;
                        $invMember = $invRecord->invi_group_member->advisor;
                    @endphp
                    <div class="mb-6">
                        @if ($invRecord->role == 1)
                            <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200">
                                อาจารย์ที่ปรึกษา: {{ $invMember->a_fname }} {{ $invMember->a_lname }}
                            </h3>
                        @else
                            <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200">
                                กรรมการ: {{ $invMember->a_fname }} {{ $invMember->a_lname }}
                            </h3>
                        @endif
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        {{-- <th scope="col" class="px-6 py-3">#</th> --}}
                                        <th scope="col" class="px-6 py-3">รหัสนักศึกษา</th>
                                        <th scope="col" class="px-6 py-3">ชื่อ-สกุล</th>
                                        <th scope="col" class="px-6 py-3">เกรด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groupedGrades as $i => $grade)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            {{-- <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $i + 1 }}</td> --}}
                                            <td class="px-6 py-4">{{ $grade->group_member->student->s_id }}</td>
                                            <td class="px-6 py-4">{{ $grade->group_member->student->s_fname }}
                                                {{ $grade->group_member->student->s_lname }}</td>
                                            <td class="px-6 py-4 font-semibold">{{ $grade->grade }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600 dark:text-gray-400">ยังไม่มีการบันทึกเกรดโดยกรรมการใด</p>
                @endforelse

                <div class="mt-8 flex justify-end">
                    <a href="{{ route('advisor.submission.index') }}"
                        class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400 text-gray-800">
                        <i class="fa-solid fa-angles-left"></i> กลับหน้ารายการ
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
