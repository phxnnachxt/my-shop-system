<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">ร้านของเรา</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-6 text-center">ยินดีต้อนรับสู่หน้าร้าน!</h3>

            <!-- รูปโปรโมทร้าน -->
            <div class="mb-8">
                <img src="{{ asset('img/promote.png') }}" alt="รูปโปรโมทร้าน" class="mx-auto rounded-lg shadow-lg" />
            </div>

            <!-- หัวข้อเมนูแนะนำ -->
            <h3 class="text-xl font-semibold mb-4 border-b-2 border-blue-600 pb-2">เมนูแนะนำ</h3>

            <!-- บล็อกแสดงสินค้าแบบตาราง 3 คอลัมน์ -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div class="border rounded-lg p-4 shadow hover:shadow-lg transition">
                    <img src="{{ asset('img/coacoa.png') }}" alt="โก้โก้ปั่น"
                        class="w-full h-40 object-cover rounded mb-3" />
                    <h4 class="text-lg font-semibold">โก้โก้ปั่น</h4>
                    <p class="text-blue-600 font-bold mt-1">40.00 บาท</p>
                </div>

                <div class="border rounded-lg p-4 shadow hover:shadow-lg transition">
                    <img src="{{ asset('img/starwberry.png') }}" alt="น้ำสตอเบอรี่ปั่น"
                        class="w-full h-40 object-cover rounded mb-3" />
                    <h4 class="text-lg font-semibold">น้ำสตอเบอรี่ปั่น</h4>
                    <p class="text-blue-600 font-bold mt-1">50.00 บาท</p>
                </div>

                <div class="border rounded-lg p-4 shadow hover:shadow-lg transition">
                    <img src="{{ asset('img/bluehawii.png') }}" alt="น้ำบลูฮาวาย"
                        class="w-full h-40 object-cover rounded mb-3" />
                    <h4 class="text-lg font-semibold">น้ำบลูฮาวาย</h4>
                    <p class="text-blue-600 font-bold mt-1">40.00 บาท</p>
                </div>

                <!-- เมนูแนะนำเพิ่ม -->
                <div class="border rounded-lg p-4 shadow hover:shadow-lg transition">
                    <img src="{{ asset('img/mango.png') }}" alt="แมงโก้สมูทตี้"
                        class="w-full h-40 object-cover rounded mb-3" />
                    <h4 class="text-lg font-semibold">แมงโก้สมูทตี้</h4>
                    <p class="text-blue-600 font-bold mt-1">55.00 บาท</p>
                </div>

                <div class="border rounded-lg p-4 shadow hover:shadow-lg transition">
                    <img src="{{ asset('img/latae.png') }}" alt="กาแฟเย็น"
                        class="w-full h-40 object-cover rounded mb-3" />
                    <h4 class="text-lg font-semibold">ลาเต้เย็น</h4>
                    <p class="text-blue-600 font-bold mt-1">40.00 บาท</p>
                </div>

                <div class="border rounded-lg p-4 shadow hover:shadow-lg transition">
                    <img src="{{ asset('img/greentea.png') }}" alt="ชาเขียวเย็น"
                        class="w-full h-40 object-cover rounded mb-3" />
                    <h4 class="text-lg font-semibold">ชาเขียว</h4>
                    <p class="text-blue-600 font-bold mt-1">50.00 บาท</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
