<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <div class="flex items-start justify-between">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        รายละเอียดโครงงานวิจัย
                    </h2>
                    {{-- <a href="{{ route('teacher.propose.index') }}"
                        class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-white bg-gray-600 hover:bg-gray-700">
                        ← กลับรายการ
                    </a> --}}
                </div>

                {{-- ส่วนข้อมูล Propose --}}
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">ชื่อหัวข้อโครงงานวิจัย</div>
                            <div class="text-base font-semibold text-gray-900 dark:text-white">
                                {{ $propose->title }}
                            </div>
                        </div>

                        <div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">ประเภท</div>
                            <div class="text-sm text-gray-900 dark:text-white">
                                {{ $propose->project_type->name ?? '-' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">ที่ปรึกษา</div>
                            <div class="text-sm text-gray-900 dark:text-white">
                                {{ $propose->advisor->name ?? '-' }}
                            </div>
                        </div>

                        {{-- <div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">สถานะ</div>
                            <span
                                class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full
                                @class([
                                    'bg-yellow-100 text-yellow-800' => $propose->status === 'pending',
                                    'bg-green-100 text-green-800' => $propose->status === 'approved',
                                    'bg-red-100 text-red-800' => $propose->status === 'rejected',
                                    'bg-gray-100 text-gray-800' => !in_array($propose->status, [
                                        'pending',
                                        'approved',
                                        'rejected',
                                    ]),
                                ])">
                                {{ $propose->status }}
                            </span>
                        </div> --}}

                        <div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">ปีการศึกษา (กลุ่ม)</div>
                            <div class="text-sm text-gray-900 dark:text-white">
                                {{ $propose->project_group->academic_year->year ?? '-' }}
                            </div>
                        </div>

                        {{-- table member --}}
                        <div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">สมาชิก</div>
                            <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                                        <tr>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                                ลำดับ</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                                รหัสนักศึกษา</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                                ชื่อ - สกุล</th>
                                            <th
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                                สถานะ</th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                                        @forelse($members as $i => $m)
                                            @php $stu = $m->student; @endphp
                                            <tr>
                                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                                    {{ $i + 1 }}
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                                    {{ $stu->s_id ?? '-' }}
                                                </td>
                                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                                    {{ trim(($stu->s_fname ?? '') . ' ' . ($stu->s_lname ?? '')) ?: '-' }}
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    <span
                                                        class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                                {{ $stu->status ?? 1 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                        {{ $stu->status ?? 1 ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4"
                                                    class="px-4 py-6 text-center text-sm text-gray-500 dark:text-gray-300">
                                                    ไม่พบสมาชิกในกลุ่มนี้
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">วัตถุประสงค์</div>
                            <div class="prose prose-sm dark:prose-invert max-w-none text-white">
                                {!! nl2br(e($propose->objective ?? '-')) !!}
                            </div>
                        </div>

                        <div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">ขอบเขต</div>
                            <div class="prose prose-sm dark:prose-invert max-w-none text-white">
                                {!! nl2br(e($propose->scope ?? '-')) !!}
                            </div>
                        </div>

                        <div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">เครื่องมือที่ใช้</div>
                            <div class="prose prose-sm dark:prose-invert max-w-none text-white">
                                {!! nl2br(e($propose->tools ?? '-')) !!}
                            </div>
                        </div>

                        @if (!empty($propose->comments))
                            <div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">ความเห็นเพิ่มเติม</div>
                                <div class="prose prose-sm dark:prose-invert max-w-none text-white">
                                    {!! nl2br(e($propose->comments)) !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
