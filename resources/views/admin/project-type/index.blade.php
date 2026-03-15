<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">ประเภทโครงงานวิจัย</h3>


                    <div class="mt-4">
                        <div
                            class="flex flex-col sm:flex-row items-center justify-between
                space-y-4 sm:space-y-0 sm:space-x-4 pb-4 mt-4">

                            {{-- Filter + Search Form --}}
                            <form method="GET" action="{{ route('admin.project-type.index') }}"
                                class="flex flex-col sm:flex-row items-center
                     w-full sm:w-auto space-y-2 sm:space-y-0 sm:space-x-2">

                                {{-- ค้นหา --}}
                                <div class="relative w-full sm:w-80">
                                    <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0
                                 1110.89 3.476l4.817 4.817a1 1 0
                                 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input type="text" name="search" id="table-search"
                                        value="{{ request('search') }}"
                                        class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg
                              bg-gray-50 focus:ring-blue-500 focus:border-blue-500
                              dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="ค้นหาสาขาวิชา">
                                </div>
                            </form>

                            {{-- ปุ่ม เพิ่มประเภทโครงงานวิจัย --}}
                            <div class="w-full sm:w-auto">
                                <a href="{{ route('admin.project-type.create') }}"
                                    class="block w-full sm:inline-block text-center text-white bg-blue-500 hover:bg-blue-700
                      focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5
                      dark:bg-blue-500 dark:hover:bg-blue-600">
                                    <i class="fa-solid fa-plus fa-lg"></i> เพิ่มประเภทโครงงานวิจัย
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
                                            ชื่อประเภทโครงงานวิจัย
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($projectTypes as $projectType)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $loop->iteration + ($projectTypes->currentPage() - 1) * $projectTypes->perPage() }}
                                            </th>
                                            {{-- <td class="px-6 py-4">
                                                {{ $major->id }}
                                            </td> --}}
                                            <td class="px-6 py-4">
                                                {{ $projectType->name }}
                                            </td>
                                            <td class="px-6 py-4 text-center truncate">
                                                {{-- <a href="{{ route('admin.major.edit', $major->id) }}"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">แก้ไข</a>
                                            <form action="{{ route('admin.major.delete', $major->id) }}" method="POST"
                                                class="delete-form" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="delete-button font-medium text-red-600 dark:text-red-500 hover:underline"
                                                    data-topic="{{ $major->m_name }}">
                                                    ลบ
                                                </button>
                                            </form> --}}

                                                <button type="button" title="แก้ไข"
                                                    onclick="window.location.href='{{ route('admin.project-type.edit', $projectType->id) }}'"
                                                    class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                    <i class="fa-solid fa-pen fa-lg"></i>
                                                </button>
                                                <form
                                                    action="{{ route('admin.project-type.delete', $projectType->id) }}"
                                                    method="POST" class="delete-form" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" title="ลบ"
                                                        class="delete-button text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800"
                                                        data-topic="{{ $projectType->name }}">
                                                        <i class="fa-solid fa-trash-can fa-lg"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="px-6 py-4">
                                                ไม่พบข้อมูลประเภทโครงงานวิจัย
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-4">
                        {{ $projectTypes->links() }}
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
                const majorName = this.getAttribute('data-topic'); // Retrieve the topic name
                Swal.fire({
                    title: 'คุณต้องการลบประเภทโครงงานวิจัย "' + majorName +
                        '" ใช่หรือไม่?',
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
