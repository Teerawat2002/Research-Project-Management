<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                <div class="p-6">

                    <h2 class="mb-2 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                        รายละเอียดการยื่นแก้ไข</h2>
                    <p class="mb-4 text-lg text-gray-600 dark:text-gray-400">
                        {{ $revision->exam_submission->propose->title }}</p>

                    {{-- ข้อมูลหลัก --}}
                    <div class="mt-4 space-y-2">
                        <p class="text-md text-gray-600 dark:text-gray-400"><strong>รายวิชา:</strong>
                            {{ $revision->exam_submission->exam_type->name }}</p>
                        <p class="text-md text-gray-600 dark:text-gray-400">
                            <strong>ไฟล์แนบ:</strong>
                            <a href="{{ route('student.revision.download', $revision->id) }}"
                                class="text-blue-600 hover:underline" download>
                                ดาวน์โหลดไฟล์
                            </a>
                        </p>
                    </div>

                    {{-- รายละเอียดการแก้ไข --}}
                    <div class="mt-4 space-y-2">
                        <label for="edit_detail" class="block font-medium text-gray-700 dark:text-gray-300">
                            รายละเอียดการแก้ไข
                        </label>
                        <textarea name="edit_detail" id="edit_detail" rows="5"
                            class="mt-1 block w-full p-2.5 border-gray-300 rounded-md shadow-sm text-gray-900
                                             focus:ring-blue-500 focus:border-blue-500 dark:text-white dark:bg-gray-700 dark:border-gray-600"
                            placeholder="อธิบายสิ่งที่แก้ไขตามที่คณะกรรมการเสนอ..." disabled>{{ old('edit_detail', $revision->edit_detail) }}</textarea>
                        @error('edit_detail')
                            <p class="mt-1 text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ตารางกรรมการ --}}
                    <div class="mt-4 space-y-2">
                        <label class="block font-medium text-gray-700 dark:text-gray-300">
                            รายละเอียดการอนุมัติของคณะกรรมการ
                        </label>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2 rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-sm text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-6 py-3">กรรมการ</th>
                                        <th class="px-6 py-3 text-center">สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invigilators as $inv)
                                        <tr
                                            class="bg-white dark:bg-gray-800 border-b hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="px-6 py-3">{{ $inv['name'] }}
                                                @if ($inv['role'] == 1)
                                                    <span
                                                        class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-700 dark:text-green-300">อาจารย์ที่ปรึกษา</span>
                                                @elseif($inv['role'] == 2)
                                                    <span
                                                        class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">กรรมการ</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-3 text-center">
                                                @switch($inv['status'])
                                                    @case(null)
                                                        <span
                                                            class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md">รออนุมัติ</span>
                                                    @break

                                                    @case('1')
                                                        <span
                                                            class="px-2 py-0.5 bg-green-200 text-green-800 rounded-md">อนุมัติแล้ว</span>
                                                    @break

                                                    @case('2')
                                                        <span
                                                            class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md">รออนุมัติ</span>
                                                    @break

                                                    @case('3')
                                                        <span
                                                            class="px-2 py-0.5 bg-red-200 text-red-800 rounded-md">ไม่อนุมัติ</span>
                                                    @break

                                                    @default
                                                        <span
                                                            class="px-2 py-0.5 bg-gray-100 text-gray-800 rounded-md">ไม่ทราบสถานะ</span>
                                                @endswitch
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- ปุ่มกลับ --}}
                    <div class="flex justify-end mt-6">
                        <a href="{{ route('invigilator.revision.index') }}"
                            class="inline-block px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                            ย้อนกลับ
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
