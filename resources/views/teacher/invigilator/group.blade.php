<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-black-900 dark:text-white">รายการกลุ่มคณะกรรมการปีการศึกษา
                        {{ $academicYear->year }}</h3>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">ID</th>
                                    <th scope="col" class="px-6 py-3">ชื่อกลุ่ม</th>
                                    <th scope="col" class="px-6 py-3">จำนวนกรรมการ</th>
                                    {{-- <th scope="col" class="px-6 py-3">ปีการศึกษา</th> --}}
                                    <th scope="col" class="px-6 py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($groupsWithMemberCount as $groups)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">{{ $groups->id }}</td>
                                        <td class="px-6 py-4">{{ $groups->name }}</td>
                                        <td class="px-6 py-4">{{ $groups->memberCount }}</td>
                                        {{-- <td class="px-6 py-4">{{ $groups->academic_year->year }}</td> --}}
                                        <td class="px-6 py-4 text-center truncate">
                                            {{-- <a href="{{ route('teacher.invigilator.member', ['id' => $groups->id]) }}"
                                                class="text-blue-600 hover:text-blue-900">รายละเอียด</a> --}}
                                            <button type="button" title="ดูรายละเอียด"
                                                onclick="window.location.href='{{ route('teacher.invigilator.member', ['id' => $groups->id]) }}'"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2.5 py-1.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                <i class="fa-solid fa-eye fa-lg"></i>
                                            </button>
                                            <button type="button" title="แก้ไข"
                                                onclick="window.location.href='{{ route('teacher.invigilator.edit', ['id' => $groups->id]) }}'"
                                                class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 me-2 mb-2 dark:focus:ring-yellow-900">
                                                <i class="fa-solid fa-pen fa-lg"></i>
                                            </button>
                                            {{-- <a href="{{ route('teacher.invigilator.edit', ['id' => $groups->id]) }}"
                                                class="text-yellow-600 hover:text-yellow-900">แก้ไข</a> --}}

                                            <!-- ปุ่มลบ -->
                                            <form action="{{ route('teacher.invigilator.delete', $groups->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE') <!-- ใช้ DELETE Method -->
                                                <button type="button"
                                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2.5 py-1.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                    title="ลบ" onclick="confirmDelete(event, this)"
                                                    data-name="{{ $groups->name }}">
                                                    <i class="fa-solid fa-trash-can fa-lg"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-6 py-4 text-center" colspan="5">
                                            No invigilator groups found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end mt-4">
                        <a href="{{ route('teacher.invigilator.home') }}"
                            class="text-white bg-gray-600 hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-800">
                            กลับ
                        </a>
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
                text: "เมื่อลบแล้วข้อมูลกลุ่ม " + groupName + ' จะหายไป',
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
