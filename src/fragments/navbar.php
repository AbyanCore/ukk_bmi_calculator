<header class="bg-white/75 backdrop-blur-xl shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="/" class="text-2xl font-bold text-green-700">Sehat<span class="text-green-500">Ideal</span></a>

        <div class="hidden md:flex space-x-6 items-center">
            <a href="dashboard" class="text-gray-600 hover:text-green-600 smooth-hover">Dashboard</a>
            <a href="galery" class="text-gray-600 hover:text-green-600 smooth-hover">Galeri</a>
            <a href="docs" class="text-gray-600 hover:text-green-600 smooth-hover">Panduan</a>
            <a href="#hitung" class="bg-green-600 text-white px-4 py-2 rounded-full hover:bg-green-700 smooth-hover">Hitung BMI</a>
        </div>

        <div class="md:hidden">
            <button id="mobile-menu-button" class="text-gray-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </nav>

    <div id="mobile-menu" class="md:hidden hidden bg-white pb-4">
        <a href="dashboard" class="block px-6 py-2 text-gray-600 hover:bg-green-100">Dashboard</a>
        <a href="galery" class="block px-6 py-2 text-gray-600 hover:bg-green-100">Galeri</a>
        <a href="docs" class="block px-6 py-2 text-gray-600 hover:bg-green-100">Panduan</a>
        <a href="#hitung" class="block mx-6 my-2 text-center bg-green-600 text-white px-4 py-2 rounded-full hover:bg-green-700 smooth-hover">Hitung BMI</a>
    </div>
</header>