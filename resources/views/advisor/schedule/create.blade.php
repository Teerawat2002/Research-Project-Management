<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">

                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">
                    จัดตารางสอบ: {{ $submission->propose->title }}
                </h2>

                <form action="{{ route('advisor.schedule.save', $submission->id) }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- เลือกกลุ่มกรรมการ (เฉพาะกลุ่มที่เป็นสมาชิกเอง) --}}
                    <div>
                        <label for="invigilator_group_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            กลุ่มกรรมการ
                        </label>
                        <select id="invigilator_group_id" name="invigilator_group_id"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- เลือกกลุ่มกรรมการ --</option>
                            @foreach ($invigilatorGroups as $group)
                                <option value="{{ $group->id }}"
                                    {{ old('invigilator_group_id') == $group->id ? 'selected' : '' }}>
                                    {{ $group->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('invigilator_group_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- เลือกกรรมการรายบุคคล (เมื่อเลือกกลุ่มใด จะไล่เอาเฉพาะสมาชิกกลุ่มนั้น แต่อย่าลืมกรองไม่เอาตัวเอง) --}}
                    <div id="invigilators_container" class="hidden space-y-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            เลือกกรรมการ
                        </label>
                        <div id="invigilators_list" class="space-y-2">
                            {{-- JS จะเติม div + checkbox แสดงเฉพาะสมาชิกกลุ่ม --}}
                        </div>
                        @error('invi_member_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- <div>
                        <label for="invigilator_group_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            กลุ่มกรรมการ
                        </label>
                        <select id="invigilator_group_id" name="invigilator_group_id"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- เลือกกลุ่มกรรมการ --</option>
                            @foreach ($invigilatorGroups as $group)
                                <option value="{{ $group->id }}"
                                    {{ old('invigilator_group_id') == $group->id ? 'selected' : '' }}>
                                    {{ $group->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('invigilator_group_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="invigilators_container" class="hidden space-y-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            เลือกกรรมการ
                        </label>
                        <div id="invigilators_list" class="space-y-2">
                        </div>
                        @error('invi_member_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div> --}}

                    {{-- ห้อง / วันที่ / เวลา --}}
                    <div>
                        <label for="e_room"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">ห้องสอบ</label>
                        <input type="text" name="e_room" id="e_room"
                            value="{{ old('e_room', $submission->e_room) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="เช่น ห้อง 101">
                        @error('e_room')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- <div>
                            <label for="e_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                วันที่สอบ
                            </label>
                            <input type="date" name="e_date" id="e_date" min="{{ now()->format('Y-m-d') }}"
                                value="{{ old('e_date', optional($submission->e_date)->format('Y-m-d')) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('e_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div> --}}

                        <div>
                            <label for="e_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                วันที่สอบ
                            </label>
                            <input type="text" name="e_date" id="e_date"
                                value="{{ old('e_date', optional($submission->e_date)->format('d-m-Y')) }}"
                                placeholder="วว-ดด-ปป"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                autocomplete="off">
                            @error('e_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- <div>
                            <label for="e_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                เวลาสอบ
                            </label>

                            <input type="time" name="e_time" id="e_time"
                                value="{{ old('e_time', $submission->e_time) }}"
                                class="
                                mt-1 block w-full border-gray-300 rounded-md shadow-sm
                                focus:ring-blue-500 focus:border-blue-500">

                            @error('e_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div> --}}

                        <div>
                            <label for="e_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                เวลาสอบ
                            </label>

                            <input type="text" name="e_time" id="e_time"
                                value="{{ old('e_time', $submission->e_time) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="HH:MM" autocomplete="off">

                            @error('e_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="flex items-center justify-center pt-4 space-x-4">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-green-500 rounded-md font-semibold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            บันทึก
                        </button>
                        {{-- <a href="{{ route('advisor.submission.index') }}"
                            class="text-blue-500 hover:text-blue-900 dark:text-blue-400 dark:hover:text-white">
                            ย้อนกลับ
                        </a> --}}
                        <button type="button" onclick="window.location.href='{{ route('advisor.submission.index') }}'"
                            class="inline-flex items-center px-4 py-2 bg-gray-500 rounded-md font-semibold text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            ย้อนกลับ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ด้านบนของ Blade view --}}
    @php
        // รับ advisorId จาก Controller
        $advisorId = $advisorId;

        // เตรียมข้อมูลกลุ่ม + สมาชิก ให้เป็น plain PHP array
        $groups = $invigilatorGroups
            ->map(function ($g) use ($advisorId) {
                return [
                    'id' => $g->id,
                    'members' => $g->invi_group_members
                        ->filter(fn($m) => $m->a_id !== $advisorId) // ไม่เอาตัวเอง
                        ->map(function ($m) {
                            return [
                                'a_id' => $m->a_id,
                                'name' => $m->advisor->a_fname . ' ' . $m->advisor->a_lname,
                            ];
                        })
                        ->values()
                        ->toArray(),
                ];
            })
            ->toArray();
    @endphp

    <script>
        // เตรียมข้อมูลเหมือนเดิม
        const groups = @json($groups);

        document.getElementById('invigilator_group_id')
            .addEventListener('change', function(e) {
                const cid = +e.target.value;
                const container = document.getElementById('invigilators_container');
                const list = document.getElementById('invigilators_list');
                list.innerHTML = '';

                const group = groups.find(g => g.id === cid);
                if (group && group.members.length) {
                    group.members.forEach(m => {
                        // wrapper div
                        const wrap = document.createElement('div');
                        wrap.className =
                            'flex items-center ps-4 border border-gray-200 rounded-sm dark:border-gray-700 p-1';

                        // checkbox
                        const chk = document.createElement('input');
                        chk.type = 'checkbox';
                        chk.id = `invi_member_${m.a_id}`;
                        chk.name = 'invi_member_id[]';
                        chk.value = m.a_id;
                        chk.className =
                            'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 focus:ring-2';

                        // label
                        const lbl = document.createElement('label');
                        lbl.htmlFor = chk.id;
                        lbl.className = 'w-full py-2 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300';
                        lbl.textContent = m.name;

                        wrap.appendChild(chk);
                        wrap.appendChild(lbl);
                        list.appendChild(wrap);
                    });
                    container.classList.remove('hidden');
                } else {
                    container.classList.add('hidden');
                }
            });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                disableMobile: true // บังคับใช้ picker ตัวนี้บนมือถือด้วย
            });
        });
    </script>

</x-app-layout>
