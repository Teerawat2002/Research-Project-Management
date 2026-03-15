<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">หัวข้อย่อย</h3>

                    <div class="mt-4">
                        <div
                            class="flex flex-col sm:flex-row items-center justify-between
         space-y-4 sm:space-y-0 sm:space-x-4 pb-4 mt-3">
                            {{-- Filter + Search --}}
                            <form id="filterForm" method="GET" action="{{ route('admin.topic.subsubtopic.index') }}"
                                class="flex flex-col sm:flex-row items-center
           w-full sm:w-auto space-y-2 sm:space-y-0 sm:space-x-2">
                                {{-- Dropdown เลือกหัวข้อรอง --}}
                                <select name="subtopic_id" id="subtopic_id"
                                    class="block w-full sm:w-48 px-4 py-2 text-sm border rounded-md
             bg-white dark:bg-gray-700 dark:text-white">
                                    <option value="">หัวข้อทั้งหมด</option>
                                    <option value="unattached"
                                        {{ request('subtopic_id') === 'unattached' ? 'selected' : '' }}>
                                        ไม่อยู่ในหัวข้อรอง
                                    </option>
                                    @foreach ($subtopics as $st)
                                        <option value="{{ $st->id }}"
                                            {{ request('subtopic_id') == $st->id ? 'selected' : '' }}>
                                            {{ $st->name }}
                                        </option>
                                    @endforeach
                                </select>

                                {{-- ช่องค้นหา --}}
                                <div class="relative w-full sm:w-auto">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0
                   1110.89 3.476l4.817 4.817a1 1 0
                   01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" name="search" id="table-search"
                                        value="{{ request('search') }}"
                                        class="block w-full sm:w-64 p-2 pl-10 text-sm border border-gray-300 rounded-lg
               bg-gray-50 focus:ring-blue-500 focus:border-blue-500
               dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                        placeholder="ค้นหาหัวข้อย่อย" />
                                </div>
                            </form>

                            {{-- ปุ่ม เพิ่มหัวข้อ --}}
                            <div class="w-full sm:w-auto">
                                <a href="{{ route('admin.topic.subsubtopic.create') }}"
                                    class="block w-full sm:inline-block text-center bg-blue-500 hover:bg-blue-700 text-white
             font-medium rounded-lg text-sm px-5 py-2.5 transition">
                                    <i class="fa-solid fa-plus fa-lg"></i> เพิ่มหัวข้อ
                                </a>
                            </div>
                        </div>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">ลำดับ</th>
                                        <th scope="col" class="px-6 py-3">id</th>
                                        <th scope="col" class="px-6 py-3">ชื่อหัวข้อ</th>
                                        <th scope="col" class="px-6 py-3">ชื่อหัวข้อรอง</th>
                                        <th scope="col" class="px-6 py-3">คะแนน</th>
                                        <th scope="col" class="px-6 py-3 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($subsub_topics as $topic)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $loop->iteration + ($subsub_topics->currentPage() - 1) * $subsub_topics->perPage() }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $topic->id }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $topic->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $topic->sub_topic->name ?? '' }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $topic->score }}
                                            </td>
                                            <td class="px-6 py-4 text-center truncate">
                                                {{-- <a href="{{ route('admin.topic.subsubtopic.edit', $topic->id) }}"
                                               class="font-medium text-blue-600 dark:text-blue-500 hover:underline">แก้ไข</a>
                                            <form action="{{ route('admin.topic.subsubtopic.delete', $topic->id) }}"
                                                  method="POST" class="delete-form" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                        class="delete-button font-medium text-red-600 dark:text-red-500 hover:underline"
                                                        data-topic="{{ $topic->name }}">
                                                    ลบ
                                                </button>
                                            </form> --}}
                                                <button type="button" title="แก้ไข"
                                                    onclick="window.location.href='{{ route('admin.topic.subsubtopic.edit', $topic->id) }}'"
                                                    class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-yellow-400 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                                    <i class="fa-solid fa-pen fa-lg"></i>
                                                </button>
                                                <form
                                                    action="{{ route('admin.topic.subsubtopic.delete', $topic->id) }}"
                                                    method="POST" class="delete-form" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" title="ลบ"
                                                        class="delete-button text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2.5 py-1.5 dark:bg-red-500 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                                        data-topic="{{ $topic->name }}">
                                                        <i class="fa-solid fa-trash-can fa-lg"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="px-6 py-4" colspan="5">
                                                ไม่พบหัวข้อย่อย
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-4">
                        {{ $subsub_topics->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Auto-submit the filter form on change -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterForm = document.getElementById('filterForm');
            const subtopicSelect = document.getElementById('subtopic_id');
            const searchInput = document.getElementById('table-search');

            // Submit form when the dropdown changes
            subtopicSelect.addEventListener('change', () => {
                filterForm.submit();
            });

            // Debounce search input so it doesn't submit on every keystroke
            let debounceTimer;
            searchInput.addEventListener('input', () => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    filterForm.submit();
                }, 500);
            });
        });
    </script>

    <!-- SweetAlert2 delete confirmation -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.delete-button').forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    const topicName = this.getAttribute('data-topic');
                    Swal.fire({
                        title: 'คุณต้องการลบหัวข้อ "' + topicName + '" ใช่หรือไม่?',
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
</x-app-layout>

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
