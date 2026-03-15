<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-6 shadow-lg rounded-lg">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                รายละเอียดแบบฟอร์ม: {{ $formset->name }}
            </h1>

            <div class="mb-4">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">ประเภทการสอบ</h2>
                <p class="text-gray-700 dark:text-gray-300">
                    {{ $formset->project_type->name }}
                </p>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">รายละเอียดหัวข้อ</h2>
                @if ($attachedTopics->isEmpty())
                    <p class="text-gray-700 dark:text-gray-300">ไม่พบหัวข้อโปรดเพิ่มหัวข้อ</p>
                @else
                    <ul class="list-disc pl-5">
                        @foreach ($attachedTopics as $topic)
                            <li class="text-gray-900 dark:text-white">
                                {{ $topic->name }}
                                {{-- Check if subtopics exist --}}
                                @if ($topic->sub_topics->isNotEmpty())
                                    <ul class="list-disc pl-5 mb-2">
                                        @foreach ($topic->sub_topics as $subtopic)
                                            <li class="text-gray-900 dark:text-white">
                                                {{ $subtopic->name }}

                                                {{-- Check if sub-subtopics exist --}}
                                                @if ($subtopic->subsub_topics->isNotEmpty())
                                                    <ul class="list-disc pl-5 mb-2">
                                                        @foreach ($subtopic->subsub_topics as $subsub)
                                                            <li class="text-gray-900 dark:text-white">
                                                                {{ $subsub->name }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Back Button -->
            <div class="mt-4 flex justify-end">
                <a href="{{ route('admin.form.index') }}"
                    class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                    กลับ
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
