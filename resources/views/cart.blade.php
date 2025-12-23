<x-layoutCategories>

<div class="max-w-6xl mx-auto px-6 py-12 pt-40 pb-30">

    {{-- TITLE --}}
    <h1 class="text-3xl font-light tracking-wide mb-8" style="font-family: cormorant, serif !important;">
        Shopping Cart
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- CART TABLE --}}
        <div class="lg:col-span-2 bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr class="text-left text-gray-700" style="font-family: poppins, sans-serif;">
                        <th class="p-4 text-xs uppercase tracking-wider">Product</th>
                        <th class="p-4 text-xs uppercase tracking-wider">Price</th>
                        <th class="p-4 text-xs uppercase tracking-wider">Quantity</th>
                        <th class="p-4 text-xs uppercase tracking-wider">Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="border-b hover:bg-gray-50">
                        {{-- PRODUCT --}}
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <button class="text-gray-400 hover:text-red-500 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                                <img src="{{ asset('images/parfum.png') }}" class="w-16 h-16 object-cover rounded">
                                <span class="font-medium text-gray-900" style="font-family: poppins, sans-serif;">
                                    Sweet Translucence
                                </span>
                            </div>
                        </td>

                        {{-- PRICE --}}
                        <td class="p-4 text-gray-700" style="font-family: poppins, sans-serif;">Rp 290,000</td>

                        {{-- QUANTITY --}}
                        <td class="p-4">
                            <div class="inline-flex border rounded-md overflow-hidden">
                                <button class="px-3 py-1 hover:bg-gray-100">−</button>
                                <input
                                    type="text"
                                    value="1"
                                    class="w-12 text-center border-x focus:outline-none"
                                >
                                <button class="px-3 py-1 hover:bg-gray-100">+</button>
                            </div>
                        </td>

                        {{-- SUBTOTAL --}}
                        <td class="p-4 font-semibold text-gray-900" style="font-family: poppins, sans-serif;">Rp 290,000</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- CART TOTALS --}}
        <div class="bg-white rounded-lg shadow-md p-6 h-fit">
            <h2 class="text-xl font-light tracking-wide mb-6" style="font-family: cormorant, serif !important;">
                Order Summary
            </h2>

            <div class="space-y-3 text-sm" style="font-family: poppins, sans-serif;">
                <div class="flex justify-between border-b pb-3">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="text-gray-900">Rp 290,000</span>
                </div>

                <div class="flex justify-between border-b pb-3">
                    <span class="text-gray-600">Shipping</span>
                    <span class="text-gray-900">Free</span>
                </div>

                <div class="flex justify-between pt-2 text-base font-semibold">
                    <span>Total</span>
                    <span>Rp 290,000</span>
                </div>
            </div>

            <button class="w-full bg-black text-white py-3 mt-6 rounded-md uppercase tracking-widest text-sm font-semibold hover:bg-gray-800 transition">
                Checkout
            </button>

            <a href="/buy" class="block text-center text-sm text-gray-600 mt-4 hover:text-black">
                ← Continue Shopping
            </a>
        </div>

    </div>
</div>


</x-layoutCategories>