<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-white">สถานะกลุ่มโครงงาน</h3>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg rounded-lg mt-6">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">ลำดับ</th>
                                    <th scope="col" class="px-6 py-3">ชื่อโครงงาน</th>
                                    {{-- <th scope="col" class="px-6 py-3 truncate">กลุ่มโครงงาน</th> --}}
                                    <th scope="col" class="px-6 py-3">อาจารย์ที่ปรึกษา</th>
                                    <th scope="col" class="px-6 py-3 text-center">สถานะ</th>
                                    <th scope="col" class="px-6 py-3 truncate">วันที่เสนอหัวข้อ</th>
                                    <th scope="col" class="px-6 py-3 truncate">Last update</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($propose as $proposal)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">
                                            {{ $loop->iteration + ($propose->currentPage() - 1) * $propose->perPage() }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $proposal->title }}
                                        </td>
                                        {{-- <td class="px-6 py-4">
                                            {{ $proposal->group_id }}
                                        </td> --}}
                                        <td class="px-6 py-4">
                                            {{ $proposal->advisor->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @switch($proposal->project_group->status)
                                                @case(0)
                                                    <span class="px-2 py-0.5 bg-green-200 text-green-800 rounded-md truncate">อัพโหลดโครงงานแล้ว</span>
                                                @break

                                                @case(1)
                                                    <span class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md truncate">กำลังยื่นหัวข้อโครงงาน</span>
                                                @break

                                                @case(2)
                                                    <span class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md truncate">กำลังยื่นสอบโครงงาน</span>
                                                @break

                                                @case(3)
                                                    <span class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md truncate">กำลังดำเนินการสอบ</span>
                                                @break

                                                @case(4)
                                                    <span class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md truncate">กำลังแก้ไข</span>
                                                @break

                                                @case(5)
                                                    <span class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md truncate">กำลังอัพโหลดโครงงาน</span>
                                                @break

                                                @default
                                                    <span class="text-gray-500">Unknown status</span>
                                            @endswitch
                                        </td>
                                        <td class="px-6 py-4">{{ $proposal->created_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4">{{ $proposal->updated_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 truncate">
                                            <!-- Display "View" link if status is 0 or 2 -->
                                            <a href="{{ route('teacher.propose.show', $proposal->id) }}"
                                                class="font-medium text-green-600 dark:text-green-500 hover:underline">
                                                รายละเอียด
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td class="px-6 py-4 text-center" colspan="6">
                                                ไม่พบข้อมูลกลุ่มโครงงาน
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $propose->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
