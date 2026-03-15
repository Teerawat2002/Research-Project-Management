<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">การให้คะแนน</h3>

                    <form
                        action="{{ route('advisor.score.save', ['id' => $examsubmission->id]) }}"
                        method="POST">
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
                                    <!-- Loop through main topics -->
                                    @foreach ($mainTopics as $mainTopic)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                            <th scope="row"
                                                class="px-6 py-4 font-bold text-gray-500 dark:text-white">
                                                {{ $mainTopic->name }}
                                            </th>
                                            <td class="px-6 py-4 text-center font-bold">{{ $mainTopic->score }}</td>
                                            @foreach ($groupMembers as $member)
                                                <td class="px-6 py-4 text-center font-bold"></td>
                                            @endforeach
                                        </tr>

                                        <!-- ตรวจสอบว่ามีหัวข้อย่อยหรือไม่ -->
                                        @forelse ($subTopics->where('mtopic_id', $mainTopic->id) as $subTopic)
                                            <tr
                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                                <td class="px-6 py-4 pl-10">{{ $subTopic->name }}</td>
                                                <td class="px-6 py-4 text-center">{{ $subTopic->score }}</td>

                                                <!-- ตรวจสอบว่า Sub Topic มี Subsub Topics หรือไม่ -->
                                                @php
                                                    $hasSubSubTopic =
                                                        $subSubTopics->where('stopic_id', $subTopic->id)->count() > 0;
                                                @endphp

                                                @foreach ($groupMembers as $member)
                                                    <!-- ถ้าไม่มี Subsub Topic ให้แสดงช่องกรอกคะแนน -->
                                                    @if (!$hasSubSubTopic)
                                                        <td class="px-6 py-4 text-center">
                                                            <input type="number"
                                                                name="score_{{ $subTopic->id }}_person{{ $member->id }}"
                                                                class="w-full text-center border rounded score-input"
                                                                min="0" max="{{ $subTopic->score }}" required>
                                                        </td>
                                                    @else
                                                        <!-- หากมี Subsub Topic ซ่อนช่องกรอกคะแนน -->
                                                        <td class="px-6 py-4 text-center"></td>
                                                    @endif
                                                @endforeach
                                            </tr>

                                            <!-- Loop through subsub topics if they belong to this sub topic -->
                                            @foreach ($subSubTopics->where('stopic_id', $subTopic->id) as $subSubTopic)
                                                <tr
                                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                                    <td class="px-6 py-4 pl-14">{{ $subSubTopic->name }}</td>
                                                    <td class="px-6 py-4 text-center">{{ $subSubTopic->score }}</td>
                                                    @foreach ($groupMembers as $member)
                                                        <td class="px-6 py-4 text-center">
                                                            <input type="number"
                                                                name="score_{{ $subSubTopic->id }}_person{{ $member->id }}"
                                                                class="w-full text-center border rounded score-input"
                                                                min="0" max="{{ $subSubTopic->score }}" required>
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        @empty
                                            <!-- หากไม่มีหัวข้อย่อย ให้แสดงช่องกรอกคะแนนในหัวข้อหลัก -->
                                            <tr
                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                                <td class="px-6 py-4 pl-10 font-semibold">{{ $mainTopic->name }}</td>
                                                <td class="px-6 py-4 text-center">{{ $mainTopic->score }}</td>
                                                @foreach ($groupMembers as $member)
                                                    <td class="px-6 py-4 text-center">
                                                        <input type="number"
                                                            name="score_{{ $mainTopic->id }}_person{{ $member->id }}"
                                                            class="w-full text-center border rounded score-input"
                                                            min="0" max="{{ $mainTopic->score }}" required>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforelse
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
                            <button type="button" onclick="window.location.href='{{ route('advisor.submission.index') }}'"
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
