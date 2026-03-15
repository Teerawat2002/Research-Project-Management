<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-300">เสนอหัวข้อโครงงาน</h3>

                    <!-- ฟอร์มค้นหา -->
                    <div class="flex justify-between items-center mb-4 mt-4">
                        <form method="GET" action="{{ route('advisor.propose.index') }}" class="flex space-x-4">
                            @csrf
                            <input type="text" name="search" placeholder="ค้นหาด้วยชื่อเรื่อง"
                                class="px-4 py-2 border rounded-md w-80" value="{{ request('search') }}">

                            <button type="submit"
                                class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                ค้นหา
                            </button>
                        </form>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg rounded-lg mt-2">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">ลำดับ</th>
                                    <th scope="col" class="px-6 py-3 truncate">ชื่อโครงงาน</th>
                                    {{-- <th scope="col" class="px-6 py-3">กลุ่ม</th> --}}
                                    {{-- <th scope="col" class="px-6 py-3">อาจารย์ที่ปรึกษา</th> --}}
                                    <th scope="col" class="px-6 py-3 text-center">สถานะ</th>
                                    <th scope="col" class="px-6 py-3">วันที่เสนอ</th>
                                    <th scope="col" class="px-6 py-3">วันที่อนุมัติ</th>
                                    <th scope="col" class="px-6 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($proposals as $proposal)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">
                                            {{ $loop->iteration + ($proposals->currentPage() - 1) * $proposals->perPage() }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $proposal->title }}
                                        </td>
                                        {{-- <td class="px-6 py-4">
                                            {{ $proposal->group_id }}
                                        </td> --}}
                                        {{-- <td class="px-6 py-4">
                                            {{ $proposal->advisor->name ?? 'N/A' }}
                                        </td> --}}
                                        <td class="px-6 py-4 text-center max-w-xs truncate">
                                            @switch($proposal->status)
                                                @case(0)
                                                    <span
                                                        class="px-2 py-0.5 bg-green-200 text-green-800 rounded-md truncate">เสร็จสิ้น</span>
                                                @break

                                                @case(1)
                                                    <span
                                                        class="px-2 py-0.5 bg-yellow-200 text-yellow-800 rounded-md truncate">รอการอนุมัติ</span>
                                                @break

                                                @case(2)
                                                    <span
                                                        class="px-2 py-0.5 bg-red-200 text-red-800 rounded-md truncate">ถูกปฏิเสธ</span>
                                                @break

                                                @default
                                                    <span
                                                        class="px-2 py-0.5 bg-gray-200 text-gray-800 rounded-md truncate">สถานะไม่รู้จัก</span>
                                            @endswitch
                                        </td>
                                        <td class="px-6 py-4">{{ $proposal->created_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4">{{ $proposal->updated_at->format('d/m/Y') }}</td>
                                        {{-- <td class="px-6 py-4 text-center max-w-xs truncate">
                                            @if ($proposal->status == 1)
                                                <!-- แสดงลิงก์ "อนุมัติ" หากสถานะเป็น 1 -->
                                                <a href="{{ route('advisor.propose.approveFormView', $proposal->id) }}"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                    อนุมัติ
                                                </a>
                                                <a href="{{ route('advisor.propose.history', $proposal->id) }}"
                                                    class="font-medium text-grey-600 dark:text-grey-500 hover:underline">
                                                    ประวัติ
                                                </a>
                                            @elseif ($proposal->status == 2)
                                                <a href="{{ route('advisor.propose.history', $proposal->id) }}"
                                                    class="font-medium text-grey-600 dark:text-grey-500 hover:underline">
                                                    ประวัติ
                                                </a>
                                            @else
                                                <!-- แสดงลิงก์ "ดู" หากสถานะเป็น 0 หรือ 2 -->
                                                <a href="{{ route('advisor.propose.approveView', $proposal->id) }}"
                                                    class="font-medium text-green-600 dark:text-green-500 hover:underline">
                                                    ดู
                                                </a>
                                                <a href="{{ route('advisor.propose.history', $proposal->id) }}"
                                                    class="font-medium text-grey-600 dark:text-grey-500 hover:underline">
                                                    ประวัติ
                                                </a>
                                            @endif
                                        </td> --}}

                                        <td class="px-6 py-4 text-center max-w-xs truncate">
                                            @if ($proposal->status == 1)
                                                <!-- แสดงลิงก์ "อนุมัติ" หากสถานะเป็น 1 -->
                                                <button type="button" title="แก้ไข"
                                                    onclick="window.location.href='{{ route('advisor.propose.approveFormView', $proposal->id) }}'"
                                                    class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                    <i class="fa-solid fa-pen fa-lg"></i>
                                                </button>
                                                <button type="button" title="ประวัติ"
                                                    onclick="window.location.href='{{ route('advisor.propose.history', $proposal->id) }}'"
                                                    class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                    <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                                                </button>
                                            @elseif ($proposal->status == 2)
                                                <button type="button" title="รายละเอียด"
                                                    onclick="window.location.href='{{ route('advisor.propose.approveView', $proposal->id) }}'"
                                                    class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                    <i class="fa-solid fa-eye fa-lg"></i>
                                                </button>
                                                <button type="button" title="ประวัติ"
                                                    onclick="window.location.href='{{ route('advisor.propose.history', $proposal->id) }}'"
                                                    class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                    <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                                                </button>
                                            @else
                                                <button type="button" title="รายละเอียด"
                                                    onclick="window.location.href='{{ route('advisor.propose.approveView', $proposal->id) }}'"
                                                    class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                    <i class="fa-solid fa-eye fa-lg"></i>
                                                </button>
                                                <button type="button" title="ประวัติ"
                                                    onclick="window.location.href='{{ route('advisor.propose.history', $proposal->id) }}'"
                                                    class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                    <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
                                                </button>
                                            @endif

                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td class="px-6 py-4 text-center" colspan="6">
                                                ไม่พบข้อเสนอการศึกษา
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $proposals->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // ตรวจสอบ success message
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ',
                    // timmer: 2000,
                    text: "{{ session('success') }}",
                    confirmButtonText: 'ตกลง'
                });
            @endif

            // ตรวจสอบ validation errors (แสดงข้อความแรก)
            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    // timmer: 2000,
                    text: "{{ $errors->first() }}",
                    confirmButtonText: 'ตกลง'
                });
            @endif
        </script>
    </x-app-layout>
