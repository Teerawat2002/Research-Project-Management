<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto bg-gray-50 dark:bg-gray-800 p-6 shadow-lg rounded-lg">
            <h1 class="text-2xl text-gray-900 dark:text-white font-bold mb-4">
                เพิ่มหัวข้อในแบบฟอร์ม: {{ $formset->name }}
            </h1>

            <form action="{{ route('admin.form.storeTopic', $formset->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        เลือกหัวข้อที่ต้องการเพิ่ม:
                    </h2>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        เลือก
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ชื่อหัวข้อ
                                    </th>
                                    {{-- <th scope="col" class="px-6 py-3">
                                        Lastname
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Major
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th> --}}
                                    {{-- <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($topics as $topic)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        {{-- <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $user->a_id }}
                                        </th> --}}
                                        <td class="px-6 py-4">
                                            <input type="checkbox" name="main_topics[]" value="{{ $topic->id }}"
                                                id="topic-{{ $topic->id }}" class="mr-2"
                                                @if ($topic->form_id == $formset->id) checked @endif>
                                        </td>
                                        {{-- <td class="px-6 py-4">
                                            {{ $user->a_lname }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $user->major->m_name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $user->a_type }}
                                        </td> --}}
                                        <td class="px-6 py-4">
                                            <label for="topic-{{ $topic->id }}">{{ $topic->name }}</label>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-6 py-4" colspan="7">
                                            ไม่พบหัวข้อ
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        บันทึก
                    </button>
                    <a href="{{ route('admin.form.index') }}"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        ยกเลิก
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
