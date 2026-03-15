<nav class="space-y-3">
    @php
        use App\Models\ProjectType;

        // ถ้าไม่ได้ส่ง $types มาจาก include ให้ query เอง
        $types =
            isset($types) && $types instanceof \Illuminate\Support\Collection
                ? $types
                : ProjectType::orderBy('name')->get();

        // ถ้าไม่ได้ส่ง $typeId มา ให้ดึงจาก query string ?type=
        $typeId = $typeId ?? request()->integer('type');
    @endphp
    
    <div>
        <h3 class="text-sm font-semibold text-gray-700 mb-2">หมวดหมู่โครงงานวิจัย</h3>
        <ul class="space-y-1 text-sm">
            {{-- ลิงก์ "ทั้งหมด" --}}
            <li>
                <a href="{{ route('welcome') }}"
                    class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-100
                  {{ empty($typeId) ? 'bg-gray-100 font-semibold text-gray-900' : '' }}">
                    <span>ทั้งหมด</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path
                            d="M9.29 6.71a1 1 0 0 0 0 1.41L12.17 11l-2.88 2.88a1 1 0 1 0 1.42 1.41l3.59-3.58a1 1 0 0 0 0-1.42L10.71 6.7a1 1 0 0 0-1.42 0Z" />
                    </svg>
                </a>
            </li>

            {{-- ลูปหมวดหมู่จาก project_types --}}
            @foreach ($types as $t)
                <li>
                    <a href="{{ route('project.index', ['type' => $t->id]) }}"
                        class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-100
                    {{ (string) $typeId === (string) $t->id ? 'bg-gray-100 font-semibold text-gray-900' : '' }}">
                        <span>{{ $t->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M9.29 6.71a1 1 0 0 0 0 1.41L12.17 11l-2.88 2.88a1 1 0 1 0 1.42 1.41l3.59-3.58a1 1 0 0 0 0-1.42L10.71 6.7a1 1 0 0 0-1.42 0Z" />
                        </svg>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- <div class="pt-4 border-t">
        <h3 class="text-sm font-semibold text-gray-700 mb-2">อื่น ๆ</h3>
        <ul class="space-y-1 text-sm">
            <li><a href="#" class="block px-3 py-2 rounded-lg hover:bg-gray-100">โปรโมชัน</a></li>
            <li><a href="#" class="block px-3 py-2 rounded-lg hover:bg-gray-100">หนังสือมาใหม่</a></li>
            <li><a href="#" class="block px-3 py-2 rounded-lg hover:bg-gray-100">หนังสือขายดี</a></li>
        </ul>
    </div> --}}
</nav>
