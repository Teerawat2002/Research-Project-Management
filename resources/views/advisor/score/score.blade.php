<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">การให้คะแนน: {{ $examsubmission->propose->title}}</h3>

                    <form action="{{ route('advisor.score.save', ['id' => $examsubmission->id]) }}" method="POST">
                        @csrf
                        <!-- ==================== เริ่มตารางการให้คะแนน ==================== -->
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">หัวข้อ</th>
                                        <th scope="col" class="px-6 py-3">คะแนน</th>
                                        <!-- แสดงชื่อสมาชิกในกลุ่ม -->
                                        @foreach ($groupMembers as $member)
                                            <th scope="col" class="px-6 py-3 truncate">
                                                {{ $member->student->s_fname }} {{ $member->student->s_lname }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mainTopics as $main)
                                        @php
                                            // ดูว่ามี SubTopic หรือไม่
                                            $subs = $subTopics->where('mtopic_id', $main->id);
                                            $hasSubs = $subs->isNotEmpty();
                                        @endphp

                                        {{-- Main topic row --}}
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                            <th class="px-6 py-4 font-bold text-gray-500 dark:text-white text-lg">{{ $main->name }}</th>
                                            <td class="px-6 py-4 text-center font-bold">{{ $main->score }}</td>

                                            @if (!$hasSubs)
                                                {{-- ถ้าไม่มี SubTopic ให้แสดง input ที่นี่ --}}
                                                @foreach ($groupMembers as $gm)
                                                    <td class="px-6 py-4 text-center">
                                                        <input type="number"
                                                            name="scores[main][{{ $main->id }}][{{ $gm->id }}]"
                                                            class="w-full text-center border rounded" min="0"
                                                            max="{{ $main->score }}"
                                                            oninput="if(this.value > this.max) this.value = this.max;"
                                                            required>
                                                    </td>
                                                @endforeach
                                          @else
                                                {{-- ถ้ามี SubTopic ให้เว้นคอลัมน์นี้หมด --}}
                                                <td colspan="{{ $groupMembers->count() }}" class="px-6 py-4"></td>
                                            @endif
                                        </tr>

                                        {{-- ถ้ามี SubTopic ให้ลงคะแนนที่ SubTopic แทน --}}
                                        @if ($hasSubs)
                                            @foreach ($subs as $sub)
                                                @php
                                                    $subsubs = $subSubTopics->where('stopic_id', $sub->id);
                                                    $hasSubSubs = $subsubs->isNotEmpty();
                                                @endphp

                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                                    <td class="px-6 py-4 pl-10 font-bold text-gray-500 dark:text-white text-md">{{ $sub->name }}</td>
                                                    <td class="px-6 py-4 text-center">{{ $sub->score }}</td>

                                                    @if (!$hasSubSubs)
                                                        @foreach ($groupMembers as $gm)
                                                            <td class="px-6 py-4 text-center">
                                                                <input type="number"
                                                                    name="scores[sub][{{ $sub->id }}][{{ $gm->id }}]"
                                                                    class="w-full text-center border rounded"
                                                                    min="0" max="{{ $sub->score }}"
                                                                    oninput="if(this.value > this.max) this.value = this.max;"
                                                                    required>
                                                            </td>
                                                        @endforeach
                                                    @else
                                                        <td colspan="{{ $groupMembers->count() }}" class="px-6 py-4">
                                                        </td>
                                                    @endif
                                                </tr>

                                                {{-- Sub-Sub Topics --}}
                                                @foreach ($subsubs as $ss)
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                                        <td class="px-6 py-4 pl-14">{{ $ss->name }}</td>
                                                        <td class="px-6 py-4 text-center">{{ $ss->score }}</td>
                                                        @foreach ($groupMembers as $gm)
                                                            <td class="px-6 py-4 text-center">
                                                                <input type="number"
                                                                    name="scores[subsub][{{ $ss->id }}][{{ $gm->id }}]"
                                                                    class="w-full text-center border rounded"
                                                                    min="0" max="{{ $ss->score }}"
                                                                    oninput="if(this.value > this.max) this.value = this.max;"
                                                                    required>
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- ช่องแสดงความคิดเห็น -->
                        {{-- <div class="mt-8">
                            <label for="message"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ข้อเสนอแนะ</label>
                            <textarea id="message" name="comment" rows="6"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="เขียนข้อเสนอแนะที่นี่..."></textarea>
                        </div> --}}

                        <!-- ปุ่มบันทึกคะแนน -->
                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg mr-4 text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                บันทึก
                            </button>
                            <button type="button"
                                onclick="window.location.href='{{ route('advisor.submission.index') }}'"
                                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                                ย้อนกลับ
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('input[type="number"][max]').forEach(input => {
            input.addEventListener('input', () => {
                const mx = parseFloat(input.max);
                if (input.value !== '' && parseFloat(input.value) > mx) {
                    input.value = mx;
                }
            });
        });
    });
</script>
