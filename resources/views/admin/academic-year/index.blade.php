<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">ปีการศึกษา</h3>


                    <div class="mt-4">
                        <div
                            class="flex flex-col sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-end pb-4 mt-3">
                            <!-- ปุ่ม Create -->
                            <div>
                                <a href="{{ route('admin.academic-year.create') }}"
                                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                    <i class="fa-solid fa-plus fa-lg"></i> เพิ่มปีการศึกษา
                                </a>
                            </div>
                        </div>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            ลำดับ
                                        </th>
                                        {{-- <th scope="col" class="px-6 py-3">
                                            ID
                                        </th> --}}
                                        <th scope="col" class="px-6 py-3">
                                            ปีการศึกษา
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($academicYear as $year)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $loop->iteration + ($academicYear->currentPage() - 1) * $academicYear->perPage() }}
                                            </th>
                                            {{-- <td class="px-6 py-4">
                                                {{ $year->id }}
                                            </td> --}}
                                            <td class="px-6 py-4">
                                                {{ $year->year }}
                                            </td>
                                            <td class="px-6 py-4 text-center truncate">
                                                {{-- <a href="{{ route('admin.advisor.edit', $user->id) }}"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> --}}
                                                {{-- <form action="{{ route('admin.academic-year.delete', $year->id) }}"
                                                method="POST" class="delete-form" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="delete-button font-medium text-red-600 dark:text-red-500 hover:underline"
                                                    data-topic="{{ $year->year }}">
                                                    ลบ
                                                </button>
                                            </form> --}}
                                                <form action="{{ route('admin.academic-year.delete', $year->id) }}"
                                                    method="POST" class="delete-form" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" title="ลบ"
                                                        class="delete-button text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800"
                                                        data-topic="{{ $year->year }}">
                                                        <i class="fa-solid fa-trash-can fa-lg"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="px-6 py-4">
                                                Not found year
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-4">
                        {{ $academicYear->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                const yearName = this.getAttribute('data-topic'); // Retrieve the topic name
                Swal.fire({
                    title: 'คุณต้องการลบปี "' + yearName + '" ใช่หรือไม่?',
                    text: "เมื่อลบแล้วข้อมูลจะหายไป!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่, ลบเลย!',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

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
