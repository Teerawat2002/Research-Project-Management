<x-guest-layout :types="$types" :type-id="$typeId">
    <section class="mb-6">
        <h2 class="text-xl font-bold">โครงงานวิจัยทั้งหมด</h2>
    </section>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">
        @forelse ($projects as $u)
            <a href="{{ route('project.show', [
                'source' => $u['source'],
                'id' => $u['id'],
            ]) }}"
                class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden relative group hover:shadow-md transition">

                <div class="aspect-[3/4] bg-gray-100">
                    @if (!empty($u['cover_url']))
                        <img src="{{ $u['cover_url'] }}" alt="{{ $u['title'] }}" class="w-full h-full object-cover"
                            loading="lazy" decoding="async">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            ไม่มีรูปปก
                        </div>
                    @endif
                </div>

                <div class="p-3">
                    <h3 class="text-sm font-medium leading-snug line-clamp-2">
                        {{ $u['title'] ?? 'ไม่พบชื่อโครงงาน' }}
                    </h3>

                    @if (!empty($u['keyword']))
                        <div class="mt-1 text-xs text-gray-500 line-clamp-1">
                            {{ $u['keyword'] }}
                        </div>
                    @endif
                </div>
            </a>
        @empty
            <div class="col-span-full text-gray-500">
                ไม่พบข้อมูลโครงงานวิจัย
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $projects->links() }}
    </div>

</x-guest-layout>
