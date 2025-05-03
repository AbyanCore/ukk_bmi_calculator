<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Galery</title>
    </head>
    <body class="bg-gray-100 min-h-screen">

        <?php require_once($FRAGMENT_DIR . "navbar.php"); ?>

        <div class="container mx-auto">
            <h1 class="text-3xl font-bold text-green-800 mb-8 text-center">Galeri Data BMI Pengguna</h1>
            
            <div id="gallery-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <p id="loading-message" class="text-center text-gray-500 col-span-full">Memuat data...</p>
            </div> 
            
            <p id="no-data-gallery" class="text-center text-gray-500 mt-8 hidden">Belum ada data pengguna untuk ditampilkan.</p>
        </div>
    </body>

<script>
    // Fungsi untuk mendapatkan kelas warna berdasarkan status BMI
    function getStatusColorClass(status) {
        if (!status) return 'text-gray-600'; // Default jika status null/kosong
        status = status.toLowerCase(); // Normalisasi ke huruf kecil
        if (status === 'ideal') return 'text-green-600';
        if (status === 'kurus' || status === 'gemuk' || status === 'kelebihan berat badan') return 'text-yellow-600';
        if (status === 'obesitas') return 'text-red-600';
        return 'text-gray-600'; // Default untuk status lain
    }

    // Fungsi untuk memuat data galeri
    async function loadGalleryData() {
        const galleryGrid = document.getElementById('gallery-grid');
        const noDataMessage = document.getElementById('no-data-gallery');
        const loadingMessage = document.getElementById('loading-message');

        // Kosongkan grid dan sembunyikan pesan 'no data' saat memuat
        galleryGrid.innerHTML = '';
        noDataMessage.classList.add('hidden');
        if(loadingMessage) loadingMessage.classList.remove('hidden'); // Tampilkan loading

        try {
            const response = await fetch('/action/load_userbmi'); // Panggil endpoint
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const result = await response.json(); // Parse JSON

            if(loadingMessage) loadingMessage.classList.add('hidden'); // Sembunyikan loading

            // Asumsi struktur JSON: { data: [ { user1 }, { user2 }, ... ] }
            const users = result.data;

            if (!users || users.length === 0) {
                // Tampilkan pesan jika tidak ada data
                noDataMessage.classList.remove('hidden');
            } else {
                // Loop melalui data pengguna dan buat kartu
                users.forEach(user => {
                    const bmiData = user.userBmi || {}; // Default ke objek kosong jika userBmi null
                    const status = bmiData.status_weight || 'N/A';
                    const statusColorClass = getStatusColorClass(status);
                    const photoPath = user.photo ? `/public/uploads/${user.photo}` : null; // Sesuaikan path jika perlu
                    const fullname = user.fullname || 'Nama Tidak Tersedia';

                    // Buat elemen div untuk kartu
                    const card = document.createElement('div');
                    card.className = 'bg-white rounded-lg shadow-md border border-green-200 overflow-hidden card-hover';

                    // Isi HTML untuk kartu
                    card.innerHTML = `
                        <div class="w-full h-48 bg-green-100 flex flex-col items-center justify-center overflow-hidden card-image-container">
                            ${photoPath ?
                                `<img src="${photoPath}"
                                        alt="Foto ${htmlspecialchars(fullname)}"
                                        class="w-full h-full object-cover object-center shadow-md"
                                        onerror="this.onerror=null; this.parentElement.innerHTML = '<span class=&quot;text-green-700 text-sm p-4&quot;>[Foto ${htmlspecialchars(fullname)}]</span>';" />` 
                                :
                                `<span class="text-green-700 text-sm p-4">[Foto ${htmlspecialchars(fullname)}]</span>`
                            }
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="text-lg font-semibold text-green-800 mb-2 truncate" title="${htmlspecialchars(fullname)}">
                                ${htmlspecialchars(fullname)}
                            </h3>
                            <div class="space-y-3 text-sm text-left text-gray-700">
                                <p>
                                    <span class="font-medium text-gray-800">NIP:</span>
                                    ${htmlspecialchars(user.nip ?? 'N/A')}
                                </p>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="font-medium text-gray-800">Progres Berat Ideal:</span>
                                        <span class="${statusColorClass}">${Math.round((bmiData.weight / bmiData.ideal_weight) * 100)}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="${statusColorClass.replace('text-', 'bg-')} rounded-full h-2" 
                                             style="width: ${Math.min(Math.round((bmiData.weight / bmiData.ideal_weight) * 100), 150)}%"></div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="bg-green-50 p-2 rounded">
                                        <div class="font-medium text-gray-800">Berat Saat Ini</div>
                                        <div class="text-lg font-bold ${statusColorClass}">${htmlspecialchars(bmiData.weight ?? 'N/A')} kg</div>
                                    </div>
                                    <div class="bg-green-50 p-2 rounded">
                                        <div class="font-medium text-gray-800">Berat Ideal</div>
                                        <div class="text-lg font-bold text-green-600">${htmlspecialchars(bmiData.ideal_weight ?? 'N/A')} kg</div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span class="font-medium text-gray-800">Tinggi Badan:</span>
                                    ${htmlspecialchars(bmiData.height ?? 'N/A')} cm
                                </div>
                                <div class="bg-gray-50 p-2 rounded mt-2">
                                    <span class="font-medium text-gray-800">Status:</span>
                                    <span class="font-semibold ${statusColorClass} ml-2">
                                        ${htmlspecialchars(status)}
                                    </span>
                                </div>
                            </div>
                        </div>
                    `;
                    // Tambahkan kartu ke grid
                    galleryGrid.appendChild(card);
                });
            }

        } catch (error) {
            console.error("Gagal memuat data galeri:", error);
            if(loadingMessage) loadingMessage.classList.add('hidden'); // Sembunyikan loading
            // Tampilkan pesan error atau pesan 'no data' jika terjadi kesalahan
            galleryGrid.innerHTML = '<p class="text-center text-red-600 col-span-full">Gagal memuat data. Silakan coba lagi nanti.</p>';
            noDataMessage.classList.add('hidden');
        }
    }

    // Fungsi sederhana untuk escape HTML (opsional, bisa diganti library jika perlu)
    function htmlspecialchars(str) {
        if (typeof str !== 'string') return str; // Kembalikan jika bukan string
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return str.replace(/[&<>"']/g, function(m) { return map[m]; });
    }


    // Panggil fungsi loadGalleryData saat halaman selesai dimuat
    document.addEventListener('DOMContentLoaded', loadGalleryData);
</script>
</html>