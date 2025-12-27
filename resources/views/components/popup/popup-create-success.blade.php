@if (session('success'))
<div
    x-data="{ open: true }"
    x-show="open"
    x-transition
    class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
>
    <div
        class="bg-white w-96 rounded-2xl shadow-xl p-6 text-center
               transform transition-all"
    >
        <!-- Icon -->
        <div class="mx-auto mb-4 w-16 h-16 rounded-full bg-emerald-600
                    flex items-center justify-center shadow-lg
                    text-white text-4xl font-semibold">
            ✓
        </div>

        <!-- Title -->
        <h2 class="text-xl font-bold text-gray-800 mb-1">
            Berhasil!
        </h2>

        <!-- Message -->
        <p class="text-gray-600 mb-6">
            {{ session('success') }}
        </p>

        <!-- Button -->
        <button
            @click="open = false"
            class="w-full py-2 bg-emerald-600 hover:bg-emerald-700
                   text-white rounded-xl font-semibold transition"
        >
            OK
        </button>
    </div>
</div>
@endif