<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-black-300 dark:text-white">ปฏิทินการศึกษา</h3>

                    <div class="flex flex-wrap items-center justify-between pb-4 mt-4">
                        <form method="GET" action="{{ route('teacher.calendar.index') }}" class="flex items-center">
                            <label for="ac_id"
                                class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-4">เลือกปีการศึกษา:</label>
                            <select name="ac_id" id="ac_id" class="px-4 py-2 border rounded-lg text-sm"
                                onchange="this.form.submit()">
                                <option value="">ปีการศึกษาทั้งหมด</option>
                                @foreach ($academicYears as $year)
                                    <option value="{{ $year->id }}"
                                        {{ request('ac_id') == $year->id ? 'selected' : '' }}>
                                        {{ $year->year }}
                                    </option>
                                @endforeach
                            </select>
                        </form>

                        <a href="{{ route('teacher.calendar.create') }}"
                            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                            เพิ่มรายการ
                        </a>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    {{-- <th scope="col" class="px-6 py-3">ID</th>
                                    <th scope="col" class="px-6 py-3 whitespace-nowrap w-auto">ปีการศึกษา</th> --}}
                                    <th scope="col" class="px-6 py-3 text-center">วันที่เริ่ม</th>
                                    <th scope="col" class="px-6 py-3 text-center">วันที่สิ้นสุด</th>
                                    <th scope="col" class="px-6 py-3">รายการ</th>
                                    <th scope="col" class="px-6 py-3">รายละเอียด</th>
                                    <th scope="col" class="px-6 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($calendarData as $data)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        {{-- <td class="px-6 py-4">{{ $data->id }}</td>
                                        <td class="px-6 py-4">{{ $data->academic_year->year }}</td> --}}
                                        <td class="px-6 py-4 whitespace-nowrap w-auto text-center">
                                            {{ $data->start_date->format('d-m-Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap w-auto text-center">
                                            {{ $data->end_date->format('d-m-Y') }}</td>
                                        <td class="px-6 py-4">{{ $data->title }}</td>
                                        <td class="px-6 py-4">{{ $data->description }}</td>
                                        <td class="px-6 py-4 text-center truncate">
                                            {{-- <a href="{{ route('teacher.calendar.edit', $data->id) }}"
                                                class="text-blue-600 hover:text-blue-900">แก้ไข</a>
                                            <a href="{{ route('teacher.calendar.delete', $data->id) }}"
                                                class="text-red-600 hover:text-red-900">ลบ</a> --}}

                                            <button type="button" title="แก้ไข"
                                                onclick="window.location.href='{{ route('teacher.calendar.edit', $data->id) }}'"
                                                class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 me-2 mb-2 dark:focus:ring-yellow-900">
                                                <i class="fa-solid fa-pen fa-lg"></i>
                                            </button>
                                            {{-- <a href="{{ route('teacher.invigilator.edit', ['id' => $groups->id]) }}"
                                                class="text-yellow-600 hover:text-yellow-900">แก้ไข</a> --}}

                                            <!-- ปุ่มลบ -->
                                            <form action="{{ route('teacher.calendar.delete', $data->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE') <!-- ใช้ DELETE Method -->
                                                <button type="button"
                                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2.5 py-1.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                    title="ลบ" onclick="confirmDelete(event, this)"
                                                    data-name="{{ $data->title }}">
                                                    <i class="fa-solid fa-trash-can fa-lg"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-6 py-4 text-center" colspan="6">
                                            No data found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $calendarData->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- แสดงการแจ้งเตือนด้วย SweetAlert2 ถ้า success -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ!',
                text: '{{ session('success') }}',
                showConfirmButton: true,
                timer: 3000
            });
        </script>
    @endif

    <!-- แสดงการแจ้งเตือนด้วย SweetAlert2 ถ้า Error-->
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'มีข้อผิดพลาด!',
                text: '{{ $errors->first() }}',
                showConfirmButton: true,
            });
        </script>
    @endif

    <!-- SweetAlert2 Delete Confirmation -->
    <script>
        function confirmDelete(event, button) {
            event.preventDefault(); // Prevent the default form submission

            // ดึงชื่อกลุ่มจาก data-name
            var groupName = button.getAttribute('data-name');

            Swal.fire({
                title: 'คุณแน่ใจหรือไม่ที่จะลบ?',
                text: "เมื่อลบแล้วข้อมูล " + groupName + ' จะหายไป',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่, ลบเลย!',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    button.closest('form').submit();
                }
            });
        }
    </script>
</x-app-layout>
