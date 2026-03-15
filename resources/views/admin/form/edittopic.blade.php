<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto bg-gray-50 dark:bg-gray-800 p-6 shadow-lg rounded-lg">
            <h1 class="text-2xl text-gray-900 dark:text-white font-bold mb-4">
                แก้ไขหัวข้อแบบฟอร์ม: {{ $formset->name }}
            </h1>

            <form action="{{ route('admin.form.updateTopic', $formset->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        เลือกหัวข้อที่ต้องการแก้ไข:
                    </h2>
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        @if ($topics->isEmpty())
                            <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">
                                Not found Topics
                            </h3>
                        @else
                            <ul
                                class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach ($topics as $topic)
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center ps-3">
                                            <input id="topic-{{ $topic->id }}" type="checkbox"
                                                value="{{ $topic->id }}" name="main_topics[]"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                                @if ($topic->form_id == $formset->id) checked @endif>
                                            <label for="topic-{{ $topic->id }}"
                                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                {{ $topic->name }}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
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
