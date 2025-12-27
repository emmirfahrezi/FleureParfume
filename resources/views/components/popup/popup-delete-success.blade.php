@if (session('success') && session('action') == 'delete')
<div id="deletePopup" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white w-96 rounded-2xl shadow-xl p-6 text-center">

        <!-- CHECK (BG MERAH) -->
        <div class="mx-auto mb-4 w-16 h-16 rounded-full bg-red-600
                    flex items-center justify-center shadow-lg
                    text-white text-4xl font-semibold">
            ✓
        </div>

        <h2 class="text-xl font-bold text-gray-800 mb-1">
            Berhasil!
        </h2>

        <p class="text-gray-600 mb-6">
            {{ session('success') }}
        </p>

        <button onclick="closeDeletePopup()" class="w-full py-2 bg-red-600 hover:bg-red-700
                       text-white rounded-xl font-semibold transition">
            OK
        </button>
    </div>
</div>

<script>
function closeDeletePopup() {
    document.getElementById('deletePopup').style.display = 'none';
}
</script>
@endif