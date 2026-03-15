<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-black-300 dark:text-white">ปฏิทินการศึกษา</h3>


                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                        <div
                            class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-2 mt-2">
                            <!-- ตัวเลือกปีการศึกษา -->
                            @if (Auth::guard('advisors')->check())
                                <form method="GET" action="{{ route('teacher.calendar.home') }}" id="calendar-form">
                                    <div class="mb-4">
                                        <label for="ac_id"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">เลือกปีการศึกษาที่จะแสดง</label>
                                        <select name="ac_id" id="ac_id"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                            onchange="this.form.submit()">
                                            <option value="" disabled selected>เลือกปีการศึกษา</option>
                                            @foreach ($academicYears as $year)
                                                <option value="{{ $year->id }}"
                                                    {{ request()->ac_id == $year->id ? 'selected' : '' }}>
                                                    {{ $year->year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            @endif
                        </div>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg rounded-lg">
                            <table
                                class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-700">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-base border border-gray-300 dark:border-gray-600">
                                            วันที่
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-base border border-gray-300 dark:border-gray-600">
                                            รายการ
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($calendarData as $data)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td
                                                class="px-6 py-4 whitespace-nowrap border border-gray-300 dark:border-gray-600">
                                                {{ \Carbon\Carbon::parse($data->start_date)->format('d/m/Y') }} -
                                                {{ \Carbon\Carbon::parse($data->end_date)->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 border border-gray-300 dark:border-gray-600">
                                                <div class="font-medium text-gray-900 dark:text-white">
                                                    {{ $data->title }}
                                                </div>
                                                <div class="text-gray-500 dark:text-gray-400">{{ $data->description }}
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="px-6 py-4 text-center border border-gray-300 dark:border-gray-600"
                                                colspan="2">
                                                ไม่พบข้อมูลปฏิทินการศึกษา
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript ที่จะส่งฟอร์มโดยอัตโนมัติเมื่อเลือกปี -->
    <script>
        // เมื่อเลือกปีการศึกษาใน select จะทำการส่งฟอร์มทันที
        document.getElementById("ac_id").addEventListener("change", function() {
            document.getElementById("calendar-form").submit();
        });
    </script>
</x-app-layout>
