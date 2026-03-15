<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">

                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">
                    แก้ไขตารางสอบ: {{ $submission->propose->title }}
                </h2>

                <form action="{{ route('advisor.schedule.update', $submission->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- กลุ่มกรรมการ --}}
                    <div>
                        <label for="invigilator_group_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            กลุ่มกรรมการ
                        </label>
                        <select id="invigilator_group_id" name="invigilator_group_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">-- เลือกกลุ่มกรรมการ --</option>
                            @foreach ($invigilatorGroups as $group)
                                <option value="{{ $group->id }}"
                                    {{ old('invigilator_group_id', $submission->e_invi_group_id) == $group->id ? 'selected' : '' }}>
                                    {{ $group->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('invigilator_group_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- กรรมการ (checkbox) --}}
                    <div id="invigilators_container"
                        class="space-y-2 {{ old('invi_member_id', $submission->exam_invi_members->pluck('invi_member_id')->isEmpty() ? 'hidden' : '') }}">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            เลือกกรรมการ
                        </label>
                        <div id="invigilators_list" class="space-y-2">
                            {{-- JS เติม แต่ให้ pre-check ตัวที่เลือกแล้ว --}}
                        </div>
                        @error('invi_member_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ห้องสอบ --}}
                    <div>
                        <label for="e_room" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            ห้องสอบ
                        </label>
                        <input type="text" name="e_room" id="e_room"
                            value="{{ old('e_room', $submission->e_room) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="เช่น ห้อง 101">
                        @error('e_room')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- วันที่สอบ --}}
                        <div>
                            <label for="e_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                วันที่สอบ
                            </label>
                            <input type="text" name="e_date" id="e_date"
                                value="{{ old('e_date', optional($submission->e_date)->format('d-m-Y')) }}"
                                placeholder="วว-ดด-ปป" autocomplete="off"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('e_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- เวลาสอบ --}}
                        <div>
                            <label for="e_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                เวลาสอบ
                            </label>
                            <input type="text" name="e_time" id="e_time"
                                value="{{ old('e_time', $submission->e_time->format('H:i')) }}" placeholder="HH:MM"
                                autocomplete="off"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('e_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-center pt-4 space-x-4">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-green-600 rounded-md font-semibold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                            บันทึก
                        </button>
                        <button type="button" onclick="window.location.href='{{ route('advisor.submission.index') }}'"
                            class="inline-flex items-center px-4 py-2 bg-gray-500 rounded-md font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            ย้อนกลับ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @php
        $selected = old('invi_member_id', $submission->exam_invi_members->pluck('invi_member_id')->toArray());
        $advisorId = $advisorId;
        $groups = collect($invigilatorGroups)
            ->map(
                fn($g) => [
                    'id' => $g->id,
                    'members' => $g->invi_group_members
                        ->filter(fn($m) => $m->a_id !== $advisorId)
                        ->map(
                            fn($m) => [
                                'a_id' => $m->id, // ใช้ invi_group_member.id
                                'name' => $m->advisor->a_fname . ' ' . $m->advisor->a_lname,
                                'checked' => in_array($m->id, $selected),
                            ],
                        )
                        ->values()
                        ->toArray(),
                ],
            )
            ->toArray();
    @endphp

    <script>
        const groups = @json($groups);
        const list = document.getElementById('invigilators_list');
        const container = document.getElementById('invigilators_container');

        document.getElementById('invigilator_group_id').addEventListener('change', e => {
            const cid = +e.target.value;
            list.innerHTML = '';
            const grp = groups.find(g => g.id === cid);

            if (grp && grp.members.length) {
                grp.members.forEach(m => {
                    const wrap = document.createElement('div');
                    wrap.className =
                        'flex items-center ps-4 border border-gray-200 rounded-sm dark:border-gray-700 p-1';

                    const chk = document.createElement('input');
                    chk.type = 'checkbox';
                    chk.id = `invi_member_${m.a_id}`;
                    chk.name = 'invi_member_id[]';
                    chk.value = m.a_id;
                    if (m.checked) chk.checked = true;
                    chk.className =
                        'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 focus:ring-2';

                    const lbl = document.createElement('label');
                    lbl.htmlFor = chk.id;
                    lbl.className = 'w-full py-2 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300';
                    lbl.textContent = m.name;

                    wrap.append(chk, lbl);
                    list.appendChild(wrap);
                });
                container.classList.remove('hidden');
            } else {
                container.classList.add('hidden');
            }
        });

        // prefill เมื่อโหลดหน้า
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('invigilator_group_id').dispatchEvent(new Event('change'));
            flatpickr("#e_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                minuteIncrement: 1
            });
            flatpickr("#e_date", {
                dateFormat: "d-m-Y",
                minDate: "today",
                disableMobile: true
            });
        });
    </script>
</x-app-layout>
