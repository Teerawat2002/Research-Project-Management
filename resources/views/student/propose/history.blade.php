<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">ประวัติการเสนอหัวข้อ:
                        {{ $proposal->title }}</h3>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">ลำดับ.</th>
                                    <th scope="col" class="px-6 py-3">สถานะ</th>
                                    <th scope="col" class="px-6 py-3">ความคิดเห็น</th>
                                    <th scope="col" class="px-6 py-3">วันที่</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($history as $record)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4">
                                            @switch($record->status)
                                                @case('approved')
                                                    <span class="text-green-500">อนุมัติ</span>
                                                @break

                                                @case('rejected')
                                                    <span class="text-red-500">ไม่อนุมัติ</span>
                                                @break

                                                @case('pending')
                                                    <span class="text-yellow-500">กำลังดำเนินการ</span>
                                                @break

                                                @default
                                                    <span class="text-gray-500">ไม่ทราบสถานะ</span>
                                            @endswitch
                                        </td>
                                        <td class="px-6 py-4">{{ $record->comments ?? 'ไม่มีความคิดเห็น' }}</td>
                                        <td class="px-6 py-4">{{ $record->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center">ไม่พบข้อมูลประวัติการเสนอหัวข้อ
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $history->links() }}
                        </div>

                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('student.propose.index') }}"
                                class="px-4 py-2 text-white bg-gray-500 hover:bg-gray-600 rounded-md">
                                <i class="fa-solid fa-angles-left"></i>
                                กลับไปที่หน้าเสนอหัวข้อ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
