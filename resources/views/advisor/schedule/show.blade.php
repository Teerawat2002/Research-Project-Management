<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">

                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">
                    ตารางสอบ: {{ $submission->propose->title }}
                </h2>

                <dl class="grid grid-cols-1 gap-4 text-gray-800 dark:text-gray-200">
                    <div class="flex">
                        <dt class="w-1/3 font-medium">ห้องสอบ:</dt>
                        <dd class="w-2/3">{{ $submission->e_room ?? '-' }}</dd>
                    </div>

                    <div class="flex">
                        <dt class="w-1/3 font-medium">วันที่สอบ:</dt>
                        <dd class="w-2/3">
                            {{ optional($submission->e_date)->format('d-m-Y') ?? '-' }}
                        </dd>
                    </div>

                    <div class="flex">
                        <dt class="w-1/3 font-medium">เวลาสอบ:</dt>
                        <dd class="w-2/3">
                            {{ $submission->e_time->format('H:i') ?? '-' }}
                        </dd>
                    </div>

                    <div class="flex">
                        <dt class="w-1/3 font-medium">กรรมการ:</dt>
                        <dd class="w-2/3">
                            @if ($submission->exam_invi_members->isEmpty())
                                <span class="text-gray-500">ยังไม่ได้กำหนด</span>
                            @else
                                <ul class="list-disc list-inside">
                                    @foreach ($submission->exam_invi_members as $member)
                                        @php $adv = $member->invi_group_member->advisor; @endphp
                                        <li>{{ $adv->a_fname }} {{ $adv->a_lname }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </dd>
                    </div>
                </dl>

                <div class="mt-6 flex justify-end space-x-4">
                    <a href="{{ route('advisor.submission.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-500 rounded-md font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        กลับหน้ารายการ
                    </a>
                    @if ($submission->status != 5)
                        <a href="{{ route('advisor.schedule.edit', $submission->id) }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-500 rounded-md font-semibold text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            แก้ไขตารางสอบ
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
