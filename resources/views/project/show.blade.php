<x-guest-layout :types="$types" :type-id="$typeId">
    <div x-data="{ showPdf: false, pdfUrl: '', pdfTitle: '' }" class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-5 gap-8 py-8">

        {{-- LEFT: Cover --}}
        <div class="md:col-span-2">
            <div class="bg-white rounded-xl shadow border overflow-hidden">
                <div class="aspect-[3/4] bg-gray-100">
                    <img src="{{ $coverUrl ?: 'https://picsum.photos/seed/placeholder/600/800' }}" alt="ปกโครงงาน"
                        class="w-full h-full object-cover">
                </div>
            </div>
        </div>

        <div class="md:col-span-3">
            <div class="bg-white rounded-xl shadow border p-6">
                <h1 class="text-2xl md:text-3xl font-bold leading-snug text-gray-900">
                    {{ $source === 'upload' ? $propose->title ?? 'ไม่พบชื่อโครงงาน' : $project->title ?? 'ไม่พบชื่อโครงงาน' }}
                </h1>

                <div class="mt-3 text-sm text-gray-600 space-y-1">
                    {{-- <div>กลุ่ม: <span class="font-medium">{{ $propose->group_id ?? '-' }}</span></div> --}}
                    <div>
                        หมวดหมู่:
                        <span class="font-medium">
                            {{ $source === 'upload' ? $propose->project_type?->name ?? '-' : $project->projectType?->name ?? '-' }}
                        </span>
                    </div>
                    <div>
                        วันที่อัปโหลด:
                        <span class="font-medium">
                            {{ optional($project->updated_at)->format('d M Y') ?? '-' }}
                        </span>
                    </div>
                    {{-- <div>
                        สถานะ:
                        @php $status=(int)($upload->status ?? 1); @endphp
                        @switch($status)
                            @case(0)
                                <span class="px-2 py-0.5 rounded bg-green-100 text-green-700 text-xs">อนุมัติแล้ว</span>
                            @break

                            @case(2)
                                <span class="px-2 py-0.5 rounded bg-red-100 text-red-700 text-xs">ปฏิเสธ</span>
                            @break

                            @default
                                <span class="px-2 py-0.5 rounded bg-yellow-100 text-yellow-700 text-xs">รออนุมัติ</span>
                        @endswitch
                    </div> --}}
                </div>

                {{-- Action buttons --}}
                <div class="mt-6 flex items-center gap-3">
                    @if ($abstractUrl)
                        <button
                            @click="pdfUrl='{{ route('project.preview', [
                                'source' => $source,
                                'id' => $project->id,
                                'type' => 'abstract',
                            ]) }}' + '?v=' + Date.now();
        pdfTitle='บทคัดย่อ'; showPdf=true"
                            class="inline-flex items-center px-5 py-2 rounded-full border font-semibold hover:bg-pink-500 hover:text-white">
                            ดูรายละเอียด
                        </button>
                    @else
                        <button disabled class="inline-flex items-center px-5 py-2 rounded-full bg-gray-300 text-white">
                            ดูรายละเอียด
                        </button>
                    @endif

                </div>

                {{-- Meta list --}}
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M4 6h16v2H4V6Zm0 5h16v2H4v-2Zm0 5h10v2H4v-2Z" />
                        </svg>
                        <div>
                            <div class="text-gray-500">คำสำคัญ</div>
                            <div class="font-medium text-gray-800">{{ $project->keyword ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2a10 10 0 1 0 .001 20.001A10 10 0 0 0 12 2Z" />
                        </svg>
                        <div>
                            <div class="text-gray-500">ไฟล์ที่มี</div>
                            <div class="font-medium text-gray-800">
                                {{ $abstractUrl ? 'Abstract' : '-' }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Members & Advisor --}}
                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">

                    {{-- ผู้จัดทำ --}}
                    <div class="p-4 bg-gray-50 rounded-lg border">
                        <div class="text-gray-500 mb-1">ผู้จัดทำ</div>

                        @if ($source === 'upload')
                            <ul class="space-y-1">
                                @forelse($propose->project_group?->group_members ?? [] as $m)
                                    @if ($m->student)
                                        <li class="font-medium text-gray-800">
                                            {{ $m->student->s_fname }} {{ $m->student->s_lname }}
                                        </li>
                                    @endif
                                @empty
                                    <li class="text-gray-500">-</li>
                                @endforelse
                            </ul>
                        @else
                            <ul class="space-y-1">
                                @forelse($project->projectGroup?->group_members ?? [] as $m)
                                    @if ($m->student)
                                        <li class="font-medium text-gray-800">
                                            {{ $m->student->s_fname }} {{ $m->student->s_lname }}
                                        </li>
                                    @endif
                                @empty
                                    <li class="text-gray-500">-</li>
                                @endforelse
                            </ul>
                        @endif
                    </div>

                    {{-- อาจารย์ที่ปรึกษา --}}
                    <div class="p-4 bg-gray-50 rounded-lg border">
                        <div class="text-gray-500 mb-1">อาจารย์ที่ปรึกษา</div>

                        @if ($source === 'upload')
                            @php $adv = $propose->advisor ?? null; @endphp
                        @else
                            @php $adv = $project->advisor ?? null; @endphp
                        @endif

                        @if ($adv)
                            <div class="font-medium text-gray-800">
                                {{ $adv->a_fname }} {{ $adv->a_lname }}
                            </div>
                        @else
                            <div class="text-gray-500">-</div>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        {{-- MODAL PDF Preview --}}
        <div x-cloak x-show="showPdf" x-transition.opacity
            class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center">
            <div class="bg-white rounded-xl overflow-hidden w-11/12 max-w-5xl h-[90%] flex flex-col shadow-lg">
                <div class="flex justify-between items-center bg-blue-600 text-white px-6 py-3">
                    <h2 class="font-bold text-lg" x-text="pdfTitle"></h2>
                    <button @click="showPdf=false"
                        class="text-white hover:text-gray-200 text-2xl font-bold">&times;</button>
                </div>
                <iframe :src="pdfUrl" class="flex-1 w-full" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</x-guest-layout>
