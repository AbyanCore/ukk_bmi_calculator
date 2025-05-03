<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kesehatan Anda - Berat Badan Ideal</title>
</head>
<body class="bg-green-50 text-gray-800">

    <?php require_once($FRAGMENT_DIR . 'navbar.php') ?>

    <main>
        <section id="dashboard" class="bg-gradient-to-br from-green-600 to-teal-600 text-white py-20 md:py-32 fade-in-up">
            <div class="container mx-auto px-6 text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">Capai Berat Badan Ideal Anda</h1>
                <p class="text-lg md:text-xl mb-8 text-green-100">Ketahui status berat badan Anda dan mulailah hidup lebih sehat bersama kami.</p>
                <a href="dashboard" class="bg-white text-green-700 font-semibold px-8 py-3 rounded-full hover:bg-gray-100 smooth-hover text-lg">Mulai Hitung Sekarang</a>
            </div>
        </section>

        <section id="info" class="py-16 md:py-24 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl md:text-4xl font-bold text-center text-green-800 mb-12">Mengapa Berat Badan Ideal Penting?</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-green-50 p-6 rounded-lg shadow-lg text-center border border-green-200">
                        <img src="https://placehold.co/100x100/a7f3d0/14532d?text=Kesehatan" alt="[Image of Ilustrasi Kesehatan Jantung]" class="mx-auto mb-4 rounded-full" onerror="this.src='https://placehold.co/100x100/cccccc/ffffff?text=Error'">
                        <h3 class="text-xl font-semibold text-green-700 mb-2">Kesehatan Jantung</h3>
                        <p class="text-gray-600">Menjaga berat badan ideal dapat mengurangi risiko penyakit jantung dan tekanan darah tinggi.</p>
                    </div>
                    <div class="bg-green-50 p-6 rounded-lg shadow-lg text-center border border-green-200">
                        <img src="https://placehold.co/100x100/a7f3d0/14532d?text=Energi" alt="[Image of Ilustrasi Tingkat Energi]" class="mx-auto mb-4 rounded-full" onerror="this.src='https://placehold.co/100x100/cccccc/ffffff?text=Error'">
                        <h3 class="text-xl font-semibold text-green-700 mb-2">Tingkat Energi</h3>
                        <p class="text-gray-600">Berat badan yang sehat seringkali berkorelasi dengan tingkat energi yang lebih tinggi dan stamina yang lebih baik.</p>
                    </div>
                    <div class="bg-green-50 p-6 rounded-lg shadow-lg text-center border border-green-200">
                         <img src="https://placehold.co/100x100/a7f3d0/14532d?text=Mental" alt="[Image of Ilustrasi Kesejahteraan Mental]" class="mx-auto mb-4 rounded-full" onerror="this.src='https://placehold.co/100x100/cccccc/ffffff?text=Error'">
                        <h3 class="text-xl font-semibold text-green-700 mb-2">Kesejahteraan Mental</h3>
                        <p class="text-gray-600">Merasa nyaman dengan tubuh Anda dapat meningkatkan kepercayaan diri dan kesehatan mental secara keseluruhan.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="hitung" class="py-16 md:py-24 bg-green-100">
            <div class="container mx-auto px-6 max-w-3xl">
                <h2 class="text-3xl md:text-4xl font-bold text-center text-green-800 mb-8">Hitung Indeks Massa Tubuh (BMI) Anda</h2>
                <p class="text-center text-gray-700 mb-10">Masukkan tinggi dan berat badan Anda untuk mengetahui perkiraan BMI Anda. Ini adalah langkah awal untuk memahami status berat badan Anda.</p>
                <div class="bg-white p-8 rounded-lg shadow-xl border border-green-200">
                    <form id="bmi-form">
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="height" class="block text-sm font-medium text-gray-700 mb-1">Tinggi Badan (cm)</label>
                                <input type="number" id="height" name="height" placeholder="Contoh: 170" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500" required>
                            </div>
                            <div>
                                <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">Berat Badan (kg)</label>
                                <input type="number" id="weight" name="weight" placeholder="Contoh: 65" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500" required>
                            </div>
                        </div>
                         <div class="text-center mb-6">
                            <button type="submit" class="bg-green-600 text-white font-semibold px-8 py-3 rounded-full hover:bg-green-700 smooth-hover text-lg">Hitung BMI</button>
                        </div>
                    </form>
                    <div id="bmi-result" class="mt-6 text-center text-lg font-medium text-green-800 hidden">
                        </div>
                     <div id="bmi-info" class="mt-4 text-center text-sm text-gray-600 hidden">
                        </div>
                </div>
                 <p class="text-xs text-center text-gray-500 mt-4">*Kalkulator ini memberikan perkiraan. Konsultasikan dengan profesional kesehatan untuk penilaian yang akurat.</p>
            </div>
        </section>

        <section id="gallery" class="py-16 md:py-24 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl md:text-4xl font-bold text-center text-green-800 mb-12">Galeri Inspirasi Sehat</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-green-50 rounded-lg shadow-md overflow-hidden border border-green-100">
                        <img src="https://placehold.co/600x400/a7f3d0/14532d?text=Nutrisi" alt="[Image of Piring makanan seimbang]" class="w-full h-48 object-cover" onerror="this.src='https://placehold.co/600x400/cccccc/ffffff?text=Error'">
                        <div class="p-4">
                            <h3 class="font-semibold text-lg text-green-700 mb-1">Nutrisi Seimbang</h3>
                            <p class="text-sm text-gray-600">Penuhi piring Anda dengan warna-warni dari alam.</p>
                        </div>
                    </div>
                    <div class="bg-green-50 rounded-lg shadow-md overflow-hidden border border-green-100">
                        <img src="https://placehold.co/600x400/86efac/14532d?text=Aktivitas" alt="[Image of Orang berolahraga di luar]" class="w-full h-48 object-cover" onerror="this.src='https://placehold.co/600x400/cccccc/ffffff?text=Error'">
                        <div class="p-4">
                            <h3 class="font-semibold text-lg text-green-700 mb-1">Gerak Aktif</h3>
                            <p class="text-sm text-gray-600">Temukan aktivitas fisik yang Anda nikmati setiap hari.</p>
                        </div>
                    </div>
                    <div class="bg-green-50 rounded-lg shadow-md overflow-hidden border border-green-100">
                        <img src="https://placehold.co/600x400/4ade80/166534?text=Hidrasi+Alami" alt="[Image of Gelas air dengan irisan lemon]" class="w-full h-48 object-cover" onerror="this.src='https://placehold.co/600x400/cccccc/ffffff?text=Error'">
                        <div class="p-4">
                            <h3 class="font-semibold text-lg text-green-700 mb-1">Hidrasi Cukup</h3>
                            <p class="text-sm text-gray-600">Air adalah kunci vitalitas dan metabolisme tubuh.</p>
                        </div>
                    </div>
                    <div class="bg-green-50 rounded-lg shadow-md overflow-hidden border border-green-100">
                        <img src="https://placehold.co/600x400/22c55e/166534?text=Relaksasi" alt="[Image of Orang bermeditasi dengan tenang]" class="w-full h-48 object-cover" onerror="this.src='https://placehold.co/600x400/cccccc/ffffff?text=Error'">
                        <div class="p-4">
                            <h3 class="font-semibold text-lg text-green-700 mb-1">Istirahat & Relaksasi</h3>
                            <p class="text-sm text-gray-600">Berikan waktu bagi tubuh dan pikiran untuk pulih.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="panduan" class="py-16 md:py-24 bg-green-50">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl md:text-4xl font-bold text-center text-green-800 mb-12">Panduan Menuju Hidup Sehat</h2>
                <div class="max-w-3xl mx-auto space-y-6">
                    <div class="bg-white p-6 rounded-lg shadow-md border border-green-200">
                        <h3 class="text-xl font-semibold text-green-700 mb-2">1. Pola Makan Seimbang</h3>
                        <p class="text-gray-600">Fokus pada konsumsi buah-buahan, sayuran, protein tanpa lemak, dan biji-bijian utuh. Batasi makanan olahan, gula tambahan, dan lemak jenuh.</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md border border-green-200">
                        <h3 class="text-xl font-semibold text-green-700 mb-2">2. Aktivitas Fisik Teratur</h3>
                        <p class="text-gray-600">Usahakan setidaknya 150 menit aktivitas aerobik intensitas sedang atau 75 menit aktivitas intensitas tinggi setiap minggu.</p>
                    </div>
                     <div class="bg-white p-6 rounded-lg shadow-md border border-green-200">
                        <h3 class="text-xl font-semibold text-green-700 mb-2">3. Istirahat yang Cukup</h3>
                        <p class="text-gray-600">Tidur berkualitas selama 7-9 jam setiap malam sangat penting untuk pemulihan tubuh dan pengaturan hormon.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <?php require_once($FRAGMENT_DIR . 'footer.php') ?>

    <script>
        // Fungsi untuk toggle menu mobile
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Fungsi Kalkulator BMI
        const bmiForm = document.getElementById('bmi-form');
        const heightInput = document.getElementById('height');
        const weightInput = document.getElementById('weight');
        const bmiResultDiv = document.getElementById('bmi-result');
        const bmiInfoDiv = document.getElementById('bmi-info');

        bmiForm.addEventListener('submit', (e) => {
            e.preventDefault(); // Mencegah form submit default

            const height = parseFloat(heightInput.value);
            const weight = parseFloat(weightInput.value);

            // Validasi input
            if (isNaN(height) || isNaN(weight) || height <= 0 || weight <= 0) {
                bmiResultDiv.textContent = 'Masukkan tinggi dan berat badan yang valid.';
                bmiResultDiv.classList.remove('hidden');
                bmiInfoDiv.classList.add('hidden');
                // Hapus kelas warna sebelumnya sebelum menambahkan yang baru
                bmiResultDiv.classList.remove('text-green-800', 'text-yellow-600', 'text-green-700', 'text-orange-600', 'text-red-600');
                bmiResultDiv.classList.add('text-red-600'); // Warna merah untuk error
                return;
            }

            // Hitung BMI (berat / (tinggi dalam meter)^2)
            const heightInMeters = height / 100;
            const bmi = weight / (heightInMeters * heightInMeters);
            const bmiRounded = bmi.toFixed(1); // Bulatkan 1 angka desimal

            // Tentukan kategori BMI
            let category = '';
            let infoText = '';
            let textColorClass = 'text-green-800'; // Default color class
            let infoColorClass = 'text-gray-600'; // Default info color class

            if (bmi < 18.5) {
                category = 'Berat Badan Kurang';
                infoText = 'Anda mungkin perlu menambah asupan kalori sehat.';
                textColorClass = 'text-yellow-600';
                infoColorClass = 'text-yellow-500';
            } else if (bmi >= 18.5 && bmi < 24.9) {
                category = 'Berat Badan Normal';
                infoText = 'Pertahankan gaya hidup sehat Anda!';
                textColorClass = 'text-green-700';
                infoColorClass = 'text-green-600';
            } else if (bmi >= 25 && bmi < 29.9) {
                category = 'Kelebihan Berat Badan';
                infoText = 'Pertimbangkan untuk mengatur pola makan dan meningkatkan aktivitas fisik.';
                textColorClass = 'text-orange-600';
                infoColorClass = 'text-orange-500';
            } else { // bmi >= 30
                category = 'Obesitas';
                infoText = 'Sangat disarankan untuk berkonsultasi dengan dokter atau ahli gizi.';
                textColorClass = 'text-red-600';
                infoColorClass = 'text-red-500';
            }

            // Tampilkan hasil
            bmiResultDiv.textContent = `BMI Anda adalah: ${bmiRounded} (${category})`;
            bmiInfoDiv.textContent = infoText;

            // Atur kelas warna teks hasil dan info (hapus kelas lama, tambahkan yang baru)
            bmiResultDiv.className = `mt-6 text-center text-lg font-medium ${textColorClass} block`; // Ganti hidden dengan block
            bmiInfoDiv.className = `mt-4 text-center text-sm ${infoColorClass} block`; // Ganti hidden dengan block

        });
    </script>
</body>
</html>
