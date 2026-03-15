{{-- <aside :class="open ? 'block' : 'hidden sm:block'" class="w-64 bg-white border-r border-gray-200 min-h-screen fixed sm:relative z-50">
    <div class="h-16 flex items-center justify-center border-b border-gray-200">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </a>
        <div>{{ Auth::user()->name }} ({{ Auth::guard('advisors')->user()->a_type }})</div>
    </div>

    <nav class="mt-4 flex flex-col space-y-2 px-4">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block py-2 px-4 hover:bg-gray-100">
            {{ __('Dashboard') }}
        </x-nav-link>

        <!-- Add more links or dropdowns as needed -->
        <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" class="block py-2 px-4 hover:bg-gray-100">
            {{ __('Profile') }}
        </x-nav-link>
    </nav>

    <div class="absolute bottom-4 w-full">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-nav-link :href="route('logout')" class="block py-2 px-4 hover:bg-red-100 text-red-600"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-nav-link>
        </form>
    </div>
</aside> --}}

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 bg-white border-r border-gray-200 sm:translate-x-0 transition-transform dark:bg-gray-800 dark:border-gray-700"
    x-bind:class="open ? 'translate-x-0' : '-translate-x-full'" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto">
        <!-- Profile -->
        <ul class="space-y-2 font-medium">
            <!-- Users -->
            <li>
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i
                        class="fas fa-user text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Profile</span>
                    {{-- <span class="flex-1 ms-3 whitespace-nowrap">{{ Auth::user()->name }}</span> --}}
                </a>
            </li>
        </ul>

        @if (
            (Auth::guard('advisors')->check() && in_array(Auth::guard('advisors')->user()->a_type, ['advisor', 'teacher'])) ||
                Auth::guard('students')->check())
            <ul class="space-y-2 font-medium">
                <!-- calender -->
                <li>
                    <a href="{{ route('teacher.calendar.home') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-solid fa-calendar-days text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="ms-3">ปฏิทินการการดำเนินงาน</span>
                    </a>
                </li>
            </ul>
        @endif

        <!-- Admin menu -->
        @if (Auth::guard('advisors')->check() && Auth::guard('advisors')->user()->a_type === 'admin')
            <div class="pt-4 mt-4 space-y-2 border-t border-gray-200 dark:border-gray-700">
                <h3 class="px-2 text-lg font-semibold text-gray-900 dark:text-white">
                    เมนูผู้ดูแลระบบ
                </h3>
            </div>
            <ul class="space-y-2 font-medium">

                <!-- จัดการหัวข้อ -->
                <li x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        <i
                            class="fas fa-users text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">จัดการผู้ใช้</span>
                        <i class="fas fa-chevron-down w-3 h-3"></i>
                    </button>
                    <ul x-show="open" class="py-2 space-y-2">
                        <!-- หัวข้อรอง -->
                        <li>
                            <a href="{{ route('admin.advisor.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <i
                                    class="fas fa-solid fa-user-tie text-xs text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                                <span class="ms-3">อาจารย์</span>
                            </a>
                        </li>
                        <!-- หัวข้อย่อย -->
                        <li>
                            <a href="{{ route('admin.student.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <i
                                    class="fas fa-solid fa-user text-xs text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                                <span class="ms-3">นักศึกษา</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Majors -->
                <li>
                    <a href="{{ route('admin.major.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-folder-tree text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">สาขาวิชา</span>
                    </a>
                </li>

                <!-- Majors -->
                <li>
                    <a href="{{ route('admin.course.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-solid fa-bookmark text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">รายวิชาโครงงาน</span>
                    </a>
                </li>

                <!-- Arcademy year -->
                <li>
                    <a href="{{ route('admin.academic-year.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-solid fa-user-graduate text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">ปีการศึกษา</span>
                    </a>
                </li>

                <!-- จัดการหัวข้อ -->
                <li x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        <i
                            class="fas fa-list text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">จัดการหัวข้อ</span>
                        <i class="fas fa-chevron-down w-3 h-3"></i>
                    </button>
                    <ul x-show="open" class="py-2 space-y-2">
                        <!-- หัวข้อหลัก -->
                        <li>
                            <a href="{{ route('admin.topic.maintopic.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <i
                                    class="fas fa-circle text-xs text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                                <span class="ms-3">หัวข้อหลัก</span>
                            </a>
                        </li>
                        <!-- หัวข้อรอง -->
                        <li>
                            <a href="{{ route('admin.topic.subtopic.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <i
                                    class="fas fa-circle-notch text-xs text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                                <span class="ms-3">หัวข้อรอง</span>
                            </a>
                        </li>
                        <!-- หัวข้อย่อย -->
                        <li>
                            <a href="{{ route('admin.topic.subsubtopic.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <i
                                    class="fas fa-dot-circle text-xs text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                                <span class="ms-3">หัวข้อย่อย</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Exam form -->
                <li>
                    <a href="{{ route('admin.form.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-solid fa-clipboard-list text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">แบบฟอร์มคะแนน</span>
                    </a>
                </li>
                <!-- Alumni Project -->
                {{-- <li x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        <i
                            class="fas fa-users text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span
                            class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">จัดการโครงงานศิษย์เก่า</span>
                        <i class="fas fa-chevron-down w-3 h-3"></i>
                    </button>
                    <ul x-show="open" class="py-2 space-y-2">
                        <!-- Alumni Student -->
                        <li>
                            <a href="{{ route('admin.alumni.student.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <i
                                    class="fas fa-solid fa-user text-xs text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                                <span class="ms-3">ศิษย์เก่า</span>
                            </a>
                        </li>
                        <!-- Alumni Project -->
                        <li>
                            <a href="{{ route('admin.alumni.project.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <i
                                    class="fas fa-solid fa-book-bookmark text-xs text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                                <span class="ms-3">โครงงานวิจัย</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li>
                    <a href="{{ route('admin.alumni.project.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-solid fa-book-bookmark text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">จัดการโครงงานศิษย์เก่า</span>
                    </a>
                </li>
            </ul>
            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700"></ul>
        @endif

        <!-- Teacher menu -->
        @if (Auth::guard('advisors')->check() && Auth::guard('advisors')->user()->a_type === 'teacher')
            <div class="pt-4 mt-4 space-y-2 border-t border-gray-200 dark:border-gray-700">
                <h3 class="px-2 text-lg font-semibold text-gray-900 dark:text-white">
                    เมนูอาจารย์รายวิชา
                </h3>
            </div>
            <ul class="space-y-2 font-medium">
                <!-- calender -->
                <li>
                    <a href="{{ route('teacher.calendar.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-solid fa-calendar-days text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="ms-3">ปฏิทินการศึกษา</span>
                    </a>
                </li>

                <!-- Users -->
                <li>
                    <a href="{{ route('teacher.propose.proposeIndex') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-solid fa-book-bookmark text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">หัวข้อโครงงาน</span>
                    </a>
                </li>

                <!-- Arcademy year -->
                <li>
                    <a href="{{ route('teacher.invigilator.home') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-users text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">จัดกลุ่มกรรมการ</span>
                    </a>
                </li>
            </ul>
            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700"></ul>
        @endif

        <!-- Advisor menu -->
        @if (Auth::guard('advisors')->check() && in_array(Auth::guard('advisors')->user()->a_type, ['advisor', 'teacher']))
            <div class="pt-4 mt-4 space-y-2 border-t border-gray-200 dark:border-gray-700">
                <h3 class="px-2 text-lg font-semibold text-gray-900 dark:text-white">
                    เมนูอาจารย์ที่ปรึกษา
                </h3>
            </div>
            <ul class="space-y-2 font-medium">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('advisor.propose.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-solid fa-book-bookmark text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="ms-3">หัวข้อโครงงาน</span>
                    </a>
                </li>

                <!-- จัดการหัวข้อ -->
                <li x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                        <i
                            class="fas fa-solid fa-table-list text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">การสอบ</span>
                        <i class="fas fa-chevron-down w-3 h-3"></i>
                    </button>
                    <ul x-show="open" class="py-2 space-y-2">
                        <!-- หัวข้อหลัก -->
                        <li>
                            <a href="{{ route('advisor.submission.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <i
                                    class="fas fa-solid fa-table-columns text-xs text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                                <span class="ms-3">การยื่นสอบ</span>
                            </a>
                        </li>
                        <!-- หัวข้อหลัก -->
                        {{-- <li>
                            <a href="{{ route('advisor.examination.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <i
                                    class="fas fa-solid fa-table-columns text-xs text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                                <span class="ms-3">จัดการสอบ</span>
                            </a>
                        </li> --}}
                        <!-- หัวข้อรอง -->
                        {{-- <li>
                            <a href="{{ route('advisor.score.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <i
                                    class="fas fa-solid fa-clipboard-list text-xs text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                                <span class="ms-3">การให้คะแนน</span>
                            </a>
                        </li> --}}
                        <!-- หัวข้อย่อย -->
                        <li>
                            <a href="{{ route('advisor.revision.index') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <i
                                    class="fas fa-solid fa-file-pen text-xs text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                                <span class="ms-3">การแก้ไข</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Arcademy year -->
                <li>
                    <a href="{{ route('advisor.upload.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-solid fa-folder-open text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">อัพโหลดโครงงาน</span>
                    </a>
                </li>
            </ul>
            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700"></ul>
        @endif

        <!-- invigilator menu -->
        @if (Auth::guard('advisors')->check() && Auth::guard('advisors')->user()->a_type !== 'admin')
            <div class="pt-4 mt-4 space-y-2 border-t border-gray-200 dark:border-gray-700">
                <h3 class="px-2 text-lg font-semibold text-gray-900 dark:text-white">
                    เมนูกรรมการ
                </h3>
            </div>
            <ul class="space-y-2 font-medium">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('invigilator.examination.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-solid fa-table-columns text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="ms-3">รายการสอบ</span>
                    </a>
                </li>

                {{-- <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-solid fa-clipboard-list text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="ms-3">ให้คะแนน</span>
                    </a>
                </li> --}}

                <li>
                    <a href="{{ route('invigilator.revision.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-solid fa-file-pen text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="ms-3">การแก้ไข</span>
                    </a>
                </li>

            </ul>
            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700"></ul>
        @endif

        <!-- Student menu -->
        @if (Auth::guard('students')->check())
            <div class="pt-4 mt-4 space-y-2 border-t border-gray-200 dark:border-gray-700">
                <h3 class="px-2 text-lg font-semibold text-gray-900 dark:text-white">
                    เมนูนักศึกษา
                </h3>
            </div>
            <ul class="space-y-2 font-medium">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('student.group.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-users text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="ms-3">กลุ่มโครงงาน</span>
                    </a>
                </li>

                <!-- Users -->
                <li>
                    <a href="{{ route('student.propose.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-solid fa-book-bookmark text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">เสนอหัวข้อ</span>
                    </a>
                </li>

                <!-- Arcademy year -->
                <li>
                    <a href="{{ route('student.submission.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-clipboard-check text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">ยื่นสอบ</span>
                    </a>
                </li>

                <!-- Arcademy year -->
                <li>
                    <a href="{{ route('student.revision.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-file-pen text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">ยื่นแก้ไข</span>
                    </a>
                </li>

                <!-- Arcademy year -->
                <li>
                    <a href="{{ route('student.upload.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-file-upload text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">ยื่นอัพโหลดโครงงาน</span>
                    </a>
                </li>
            </ul>
        @endif

        <!-- Logout -->
        {{-- <div class="absolute bottom-0 left-0 w-full">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i
                        class="fas fa-sign-out-alt text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap text-start">Logout</span>
                </button>
            </form>
        </div> --}}
        <div class="absolute bottom-0 left-0 w-full px-4 pb-4">
            @if (Auth::guard('students')->check())
                <form method="POST" action="{{ route('studentLogout.logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-sign-out-alt text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap text-start">Logout</span>
                    </button>
                </form>
            @endif

            @if (Auth::guard('advisors')->check())
                <form method="POST" action="{{ route('advisorLogout.logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <i
                            class="fas fa-sign-out-alt text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap text-start">Logout</span>
                    </button>
                </form>
            @endif
        </div>


    </div>
</aside>

{{-- <!-- Hamburger menu for mobile -->
<button id="sidebarToggle"
    class="sm:hidden fixed top-0 left-0 z-50 p-2 text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0=" 1-.75-translate-x-full"></path>
    </svg>
</button>

<script>
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('logo-sidebar');
    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
    });
</script> --}}
