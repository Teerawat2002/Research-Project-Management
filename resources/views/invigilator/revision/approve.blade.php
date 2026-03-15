<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-300">
                        การอนุมัติการแก้ไขโครงงาน
                    </h3>

                    {{-- ลิงก์ดาวน์โหลดไฟล์ --}}
                    <div class="mt-4">
                        <label class="block font-medium text-gray-700 dark:text-gray-300">
                            ไฟล์เอกสารที่แก้ไข
                        </label>
                        <a href="{{ route('invigilator.revision.download', $revisions->id) }}" target="_blank"
                            class="inline-flex items-center text-blue-600 hover:underline">
                            <img src="{{ asset('icons/pdf.png') }}" class="w-8 h-8 mr-2">
                            ดาวน์โหลด
                        </a>
                    </div>

                    {{-- รายละเอียด --}}
                    <div class="mt-4">
                        <label class="block font-medium text-gray-700 dark:text-gray-300">
                            รายละเอียดการแก้ไข
                        </label>
                        <textarea disabled rows="3"
                            class="auto-expand mt-1 block w-full p-2.5 border-gray-300 rounded-md shadow-sm text-gray-900
                                             focus:ring-blue-500 focus:border-blue-500 dark:text-white dark:bg-gray-700 dark:border-gray-600">{{ $revisions->edit_detail }}</textarea>
                    </div>
                    {{-- <ul class="mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700"></ul> --}}

                    {{-- ฟอร์มเลือกผลการตรวจสอบ --}}
                    <form action="{{ route('invigilator.revision.update', $revisions->id) }}" method="POST"
                        class="mt-6 space-y-6">
                        @csrf @method('PUT')

                        <div>
                            <label class="block font-medium text-gray-700 dark:text-gray-300">
                                ผลการตรวจสอบ
                            </label>
                            <div class="flex items-center space-x-6 mt-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="1"
                                        class="text-green-500 focus:ring-green-500">
                                    <span class="ml-2 text-gray-900 dark:text-white">อนุมัติ</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="3"
                                        class="text-red-500 focus:ring-red-500">
                                    <span class="ml-2 text-gray-900 dark:text-white">ไม่อนุมัติ</span>
                                </label>
                            </div>
                            @error('status')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- ตารางกรรมการ --}}
                        <div>
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
                                                <td class="px-6 py-4">{{ $inv['name'] }}
                                                    @if ($inv['role'] == 1)
                                                        <span
                                                            class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-700 dark:text-green-300">อาจารย์ที่ปรึกษา</span>
                                                    @elseif($inv['role'] == 2)
                                                        <span
                                                            class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">กรรมการ</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 text-center">
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
                                                                class="px-2 py-0.5 bg-gray-200 text-gray-800 rounded-md">ไม่ทราบสถานะ</span>
                                                    @endswitch
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="flex justify-end items-center space-x-4">
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                บันทึก
                            </button>
                            <a href="{{ route('invigilator.revision.index') }}"
                                class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                                ยกเลิก
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        // ปรับขนาด textarea อัตโนมัติ
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.auto-expand').forEach(textarea => {
                const adjust = el => {
                    el.style.height = 'auto';
                    el.style.height = el.scrollHeight + 'px';
                };
                adjust(textarea);
                textarea.addEventListener('input', () => adjust(textarea));
            });
        });
    </script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.auto-expand').forEach(textarea => {
                const adjust = el => {
                    // รีเซ็ตความสูงเดิม
                    el.style.height = 'auto';
                    // ดึงความสูงบรรทัดจาก CSS
                    const lineHeight = parseInt(window.getComputedStyle(el).lineHeight);
                    // ปรับความสูง = ความสูงเนื้อหา + 1 row เพิ่มเติม
                    el.style.height = (el.scrollHeight + lineHeight) + 'px';
                };
                // เรียกปรับขนาดตอนโหลดครั้งแรก
                adjust(textarea);
                // เรียกปรับขนาดทุกครั้งที่มีการพิมพ์
                textarea.addEventListener('input', () => adjust(textarea));
            });
        });
    </script>

</x-app-layout>
