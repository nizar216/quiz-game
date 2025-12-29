<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4" dir="rtl">
        <div class="max-w-6xl mx-auto">

            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 mb-3">
                    إنشاء لعبة جديدة
                </h1>
                <p class="text-gray-600 text-lg">
                    جهّز الفرق واختر الفئات قبل بدء التحدي
                </p>
            </div>

            <form action="{{ route('games.store') }}" method="POST" id="gameForm" class="space-y-12">
                @csrf

                <!-- Section 1: Team Setup -->
                <div class="bg-white/90 backdrop-blur rounded-3xl p-8 shadow-lg border border-gray-200">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">
                        إعداد الفرق
                    </h2>
                    <p class="text-gray-500 text-sm mb-8">
                        أدخل اسم الحكم وأسماء الفرق المشاركة في اللعبة
                    </p>

                    <!-- Judge -->
                    <div class="mb-10 max-w-md">
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            اسم الحكم
                        </label>
                        <input
                            type="text"
                            name="judge_name"
                            id="judgeNameInput"
                            required
                            autofocus
                            value="{{ old('judge_name') }}"
                            placeholder="أدخل اسم الحكم"
                            onkeyup="updateTeamPreview()"
                            class="w-full rounded-xl px-5 py-3 text-lg
                                   text-gray-900 placeholder-gray-400
                                   border border-gray-300
                                   focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                   transition shadow-sm"
                        >
                        @error('judge_name')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Teams -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <!-- Team 1 -->
                        <div class="relative">
                            <span class="absolute right-0 top-0 h-full w-1 bg-blue-500 rounded-r-xl"></span>

                            <label class="block text-sm font-bold text-gray-700 mb-2 pr-3">
                                الفريق الأول
                            </label>
                            <input
                                type="text"
                                name="team_1_name"
                                id="team1Input"
                                required
                                value="{{ old('team_1_name') }}"
                                placeholder="اسم الفريق الأول"
                                onkeyup="updateTeamPreview()"
                                class="w-full rounded-xl px-5 py-3 text-lg
                                       text-gray-900 placeholder-gray-400
                                       border border-gray-300
                                       focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                       transition shadow-sm"
                            >
                            @error('team_1_name')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Team 2 -->
                        <div class="relative">
                            <span class="absolute right-0 top-0 h-full w-1 bg-red-500 rounded-r-xl"></span>

                            <label class="block text-sm font-bold text-gray-700 mb-2 pr-3">
                                الفريق الثاني
                            </label>
                            <input
                                type="text"
                                name="team_2_name"
                                id="team2Input"
                                required
                                value="{{ old('team_2_name') }}"
                                placeholder="اسم الفريق الثاني"
                                onkeyup="updateTeamPreview()"
                                class="w-full rounded-xl px-5 py-3 text-lg
                                       text-gray-900 placeholder-gray-400
                                       border border-gray-300
                                       focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                                       transition shadow-sm"
                            >
                            @error('team_2_name')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Section 2: Category Selection (unchanged) -->
                <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-200">
                    <div class="flex items-center justify-between mb-8 flex-wrap gap-4">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900">اختيار الفئات</h2>
                            <p class="text-gray-500 text-sm mt-1">
                                اختر المواضيع التي ستتضمنها هذه اللعبة
                            </p>
                        </div>
                        <div class="text-center bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <p class="text-gray-500 text-xs font-semibold">عدد المختارة</p>
                            <p class="text-4xl font-black text-blue-600" id="categoryCount">0</p>
                        </div>
                    </div>

                    @error('categories')
                    <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-xl mb-6 font-semibold">
                        {{ $message }}
                    </div>
                    @enderror

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                        @forelse($categories as $category)
                            <label class="group relative block">
                                <input
                                    type="checkbox"
                                    name="categories[]"
                                    value="{{ $category->id }}"
                                    {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}
                                    class="sr-only peer"
                                    onchange="updateCategoryCount()"
                                >

                                <div class="rounded-3xl border border-gray-200 bg-white shadow-sm
                                            transition-all duration-300
                                            peer-checked:ring-2 peer-checked:ring-blue-500
                                            peer-checked:shadow-lg">

                                    <div class="h-40 rounded-t-3xl overflow-hidden bg-gray-100">
                                        <img
                                            src="{{ asset($category->image) }}"
                                            alt="{{ $category->name }}"
                                            class="w-full h-full object-fill"
                                        >
                                    </div>

                                    <div class="p-4 text-center">
                                        <p class="font-bold text-gray-900">
                                            {{ $category->name }}
                                        </p>
                                    </div>
                                </div>
                            </label>
                        @empty
                            <p class="col-span-full text-center text-gray-500 py-8">
                                لا توجد فئات متاحة
                            </p>
                        @endforelse
                    </div>
                </div>

                <!-- Section 3: Game Preview (unchanged) -->
                <!-- Section 3: Game Preview -->
                <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-200">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">
                        معاينة اللعبة
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <!-- Judge -->
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                            <p class="text-xs font-bold text-gray-500 mb-2">
                                الحكم
                            </p>
                            <p class="text-2xl font-black text-gray-900" id="judgePreview">
                                مجهول
                            </p>
                        </div>

                        <!-- Team 1 -->
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                            <p class="text-xs font-bold text-blue-600 mb-2">
                                الفريق الأول
                            </p>
                            <p class="text-2xl font-black text-gray-900" id="team1Preview">
                                بدون اسم
                            </p>
                        </div>

                        <!-- Team 2 -->
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                            <p class="text-xs font-bold text-red-600 mb-2">
                                الفريق الثاني
                            </p>
                            <p class="text-2xl font-black text-gray-900" id="team2Preview">
                                بدون اسم
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-center gap-4 flex-wrap">
                    <a href="{{ route('judge.dashboard') }}"
                       class="px-8 py-4 rounded-xl bg-gray-200 text-gray-900 font-bold hover:bg-gray-300 transition">
                        العودة
                    </a>
                    <button
                        type="submit"
                        class="px-10 py-4 rounded-xl bg-blue-600 text-white font-bold
                               hover:bg-blue-700 transition shadow-lg">
                        بدء اللعبة
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function updateTeamPreview () {
            document.getElementById('judgePreview').textContent =
                document.getElementById('judgeNameInput').value || 'مجهول'

            document.getElementById('team1Preview').textContent =
                document.getElementById('team1Input').value || 'بدون اسم'

            document.getElementById('team2Preview').textContent =
                document.getElementById('team2Input').value || 'بدون اسم'
        }

        function updateCategoryCount () {
            document.getElementById('categoryCount').textContent =
                document.querySelectorAll('input[name="categories[]"]:checked').length
        }

        updateCategoryCount()
        updateTeamPreview()
    </script>
</x-app-layout>
