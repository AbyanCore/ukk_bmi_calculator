<?php 
    require_once($UTIL_DIR . "auth.php");

    $editMode = ($_GET['editMode'] ?? 'false') === 'true';
?>

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
    </head>
<?php if (!isLoggedIn() || !isAdmin()): ?>
    <body class="bg-green-100 min-h-screen">
        <?php require_once($FRAGMENT_DIR . "navbar.php"); ?>
        
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-8 md:p-10 rounded-xl shadow-lg max-w-sm w-full border border-green-200">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-green-700">Login Akun Anda</h2>
                    <p class="text-gray-500 text-sm mt-1">Masukkan detail akun Anda di bawah.</p>
                </div>
    
                <form action="/action/siginin" method="POST"> 
                    <div class="mb-4">
                        <label for="fullname" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Masukkan nama lengkap Anda" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none" required>
                    </div>
    
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password Anda" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none" required>
                    </div>
    
                    <button type="submit" class="w-full bg-green-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-green-700 smooth-hover focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        Login
                    </button>
    
                    <p class="text-center text-sm text-gray-500 mt-6">
                        Belum punya akun? <a href="#" class="text-green-600 hover:underline font-medium">Daftar di sini</a>
                    </p>
                </form>
            </div>
        </div>

        <?php require_once($GLOBALS["FRAGMENT_DIR"] . 'footer.php') ?>
    </body>
<?php else: ?>
    <body class="bg-gray-100 min-h-screen font-inter">
        <?php require_once($GLOBALS["FRAGMENT_DIR"] . "navbar.php"); ?>

        
        <div class="p-4 md:p-8 min-h-screen">
            <div class="container mx-auto flex flex-col space-y-8 max-w-4xl">
                
                <div class="bg-white p-6 md:p-8 rounded-lg shadow-md border border-gray-200">
                    <div class="container mx-auto flex items-center gap-6 max-w-4xl">
                        <a href="/action/signout" class="bg-red-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-red-700 smooth-hover focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            Logout
                        </a>
                        <h1 class="text-xl font-bold text-green-800">
                            <?= $_SESSION["fullname"] ?>, Selamat datang di Dashboard BMI
                        </h1>
                    </div>
                </div>
                
                <div class="bg-white p-6 md:p-8 rounded-lg shadow-md border border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Input Data User</h2>
                    <form id="data-form" class="space-y-4" method="post" onsubmit="onSubmitHandler(event)" enctype="multipart/form-data">
                        <h2 class="text-xl font-semibold text-gray-700 w-full border-b border-b-gray-300">User Data</h2>
                        <div>
                            <label for="fullname" class="block text-sm font-medium text-gray-600 mb-1">Nama Lengkap</label>
                            <input type="text" id="fullname" name="fullname" placeholder="Masukkan nama lengkap" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none" required>
                        </div>
                        
                        <div>
                            <label for="nip" class="block text-sm font-medium text-gray-600 mb-1">NIP</label>
                            <input type="text" id="nip" name="nip" placeholder="Masukkan NIP" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none" required>
                        </div>
                        
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-600 mb-1">Password</label>
                            <input type="password" id="password" name="password" placeholder="Masukkan Password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none" required>
                        </div>
                        
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-600 mb-1">Jenis Kelamin</label>
                            <select id="gender" name="gender" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none" required>
                                <option value="Pria" selected>Pria</option>
                                <option value="Wanita">Wanita</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="userType" class="block text-sm font-medium text-gray-600 mb-1">Tipe User</label>
                            <select id="userType" name="userType" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none" required>
                                <option value="admin">Admin</option>
                                <option value="guru" selected>Guru</option>
                                <option value="siswa">Siswa</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-600 mb-1">Foto</label>
                            <?= $editMode ? '<p class="text-sm text-gray-500 mb-2">Jika tidak ingin mengubah foto, biarkan kosong.</p>' : '' ?>
                            <input type="file" id="photo" name="photo" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none" accept="image/*" <?= $editMode ? '' : 'required' ?>>
                        </div>
                        
                        <h2 class="text-xl font-semibold text-gray-700 w-full border-b border-b-gray-300">BMI Data (Optional)</h2>

                        <div>
                            <label for="weight" class="block text-sm font-medium text-gray-600 mb-1">Berat Badan (kg)</label>
                            <input type="number" id="weight" name="weight" min="0" placeholder="Contoh: 65" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none">
                        </div>

                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <label for="height" class="block text-sm font-medium text-gray-600 mb-1">Tinggi Badan Manual (cm)</label>
                                <input type="number" id="height" name="height" min="0" placeholder="Contoh: 170" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none">
                            </div>
                            
                            <div class="flex-1">
                                <label for="height_auto" class="block text-sm font-medium text-gray-600 mb-1">Tinggi Badan Otomatis (cm)</label>
                                <div class="flex gap-2">
                                    <input type="number" id="height_auto" disabled min="0" max="300" placeholder="Menunggu data sensor..." class="w-full px-4 py-2 border bg-gray-100 border-gray-300 rounded-md focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none">
                                    <button type="button" id="lockHeight" class="bg-blue-500 hover:bg-blue-600 text-white px-4 rounded-md">
                                        <i class="fas fa-lock"></i> Lock
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4" id="submit-buttons">
                            <button type="submit" id="submitBtn" class="w-full md:w-auto bg-green-600 text-white font-semibold py-2 px-6 rounded-md hover:bg-green-700 smooth-hover focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                Tambah Data
                            </button>
                            <button type="reset" id="cancelBtn" onclick="editMode(false)" class="hidden w-full md:w-auto bg-red-600 text-white font-semibold py-2 px-6 rounded-md hover:bg-red-700 smooth-hover focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                Batal Edit
                            </button>
                        </div>
                    </form>
                </div>
                <div class="bg-white p-6 md:p-8 rounded-lg shadow-md border border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Data User</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-200 px-4 py-3 text-left text-sm font-semibold text-gray-600 bg-gray-100">Id</th>
                                    <th class="border border-gray-200 px-4 py-3 text-left text-sm font-semibold text-gray-600 bg-gray-100">Nama</th>
                                    <th class="border border-gray-200 px-4 py-3 text-left text-sm font-semibold text-gray-600 bg-gray-100">NIP</th>
                                    <th class="border border-gray-200 px-4 py-3 text-left text-sm font-semibold text-gray-600 bg-gray-100">Foto</th>
                                    <th class="border border-gray-200 px-4 py-3 text-left text-sm font-semibold text-gray-600 bg-gray-100">Berat (Kg)</th>
                                    <th class="border border-gray-200 px-4 py-3 text-left text-sm font-semibold text-gray-600 bg-gray-100">Tinggi (Cm)</th>
                                    <th class="border border-gray-200 px-4 py-3 text-left text-sm font-semibold text-gray-600 bg-gray-100">Status Berat</th>
                                    <th class="border border-gray-200 px-4 py-3 text-left text-sm font-semibold text-gray-600 bg-gray-100">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="data-table-body" class="bg-white divide-y divide-gray-200"></tbody>
                        </table>
                    </div>
                    <p id="no-data-message" class="text-center text-gray-500 mt-4">Belum ada data.</p> 
                </div>
            </div>
        </div>

        <?php require_once($FRAGMENT_DIR . 'footer.php') ?>
    </body>
<?php endif; ?>
<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
<script>
    const client = mqtt.connect('ws://localhost:8083/mqtt')
    
    client.on('connect', function () {
        console.log('Connected to MQTT broker');
        client.subscribe('height_meter', function (err) {
            if (!err) {
                console.log('Subscribed to topic: height_meter');
            }
        });
    });

    client.on('message', function (topic, message) {
        if (topic === 'height_meter') {
            const heightAuto = document.getElementById('height_auto');
            heightAuto.value = message.toString();
        }
    });

    document.getElementById('lockHeight').addEventListener('click', function() {
        const heightAuto = document.getElementById('height_auto');
        const heightManual = document.getElementById('height');
        heightManual.value = heightAuto.value;
    });
</script>
<script>
    function editMode(mode, userId = null) {
        // Update URL without page reload
        const url = new URL(window.location);
        url.searchParams.set('editMode', mode);
        if (userId) url.searchParams.set('user_id', userId);
        window.history.pushState({}, '', url);

        const submitBtn = document.getElementById('submitBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        
        if (!mode) {
            // Reset form and reload data when canceling edit
            document.getElementById('data-form').reset();
            url.searchParams.delete('editMode');
            url.searchParams.delete('user_id');
            window.history.pushState({}, '', url);

        }
        
        submitBtn.textContent = mode ? 'Edit Data' : 'Tambah Data';
        cancelBtn.style.display = mode ? 'inline-block' : 'none';
        
        load_update_data();
    }

    function onSubmitHandler(event) {
        event.preventDefault();
        
        const urlParams = new URLSearchParams(window.location.search);
        const editMode = urlParams.get('editMode') === 'true';
        const userId = urlParams.get('user_id');
        const form = event.target;
        const formData = new FormData(form);

        if (!editMode) {
            fetch("/action/add_userbmi", {
                method: "POST",
                body: formData,
            })
            .then(async (response) => {
                if (!response.ok) throw new Error("Failed to submit data");
                await response.json();
                alert("Data berhasil ditambahkan!");
                form.reset();            
                load_datagrid();
            })
            .catch((error) => {
                console.error("Error submitting data:", error);
                alert("Terjadi kesalahan saat menambahkan data.");
            });
        } else {
            fetch("/action/update_userbmi?user_id=" + userId, {
                method: "POST",
                body: formData,
            })
            .then(async (response) => {
                if (!response.ok) throw new Error("Failed to update data");
                await response.json();
                alert("Data berhasil diperbarui!");
                form.reset();
                
                // Clear URL parameters without reload
                const url = new URL(window.location);
                url.searchParams.delete('editMode');
                url.searchParams.delete('user_id');
                window.history.pushState({}, '', url);
                
                load_datagrid();
            })
            .catch((error) => {
                console.error("Error updating data:", error);
                alert("Terjadi kesalahan saat memperbarui data.");
            });
        }
    }

    // Rest of the functions remain unchanged
    function deleteUser(userId) {
        const formData = new FormData();

        fetch("/action/delete_user?user_id=" + userId, {
            method: "DELETE",
        })
        .then(async (response) => {
            if (!response.ok) throw new Error("Failed to delete user");
            await response.json();
            alert("User deleted successfully!");
            load_datagrid();
        })
        .catch((error) => {
            console.error("Error deleting user:", error);
            alert("Terjadi kesalahan saat menghapus data.");
        });
    }

    function load_datagrid() {
        fetch("/action/load_userbmi").then(async (res) => {
            const data = await res.json()

            const tableBody = document.getElementById("data-table-body")
            const noDataMessage = document.getElementById("no-data-message")

            tableBody.innerHTML = ""
            noDataMessage.style.display = "none"

            if (data.length === 0) {
                noDataMessage.style.display = "block" 
            } else {
                data.data.reverse().forEach((user) => {
                    const row = document.createElement("tr")
                    row.className = "hover:bg-gray-50 transition duration-200 ease-in-out"
                    row.innerHTML = `
                        <td class="border border-gray-200 px-4 py-3 text-sm text-gray-600">${user.id}</td>
                        <td class="border border-gray-200 px-4 py-3 text-sm text-gray-600">${user.fullname}</td>
                        <td class="border border-gray-200 px-4 py-3 text-sm text-gray-600">${user.nip}</td>
                        <td class="border border-gray-200 px-4 py-3 text-sm text-gray-600">
                            <img src="${"/public/uploads/"+user.photo}" alt="User Photo" class="w-12 h-12 object-cover">
                        </td>
                        <td class="border border-gray-200 px-4 py-3 text-sm text-gray-600">${user.userBmi ? user.userBmi.weight : "No Data"}</td>
                        <td class="border border-gray-200 px-4 py-3 text-sm text-gray-600">${user.userBmi ? user.userBmi.height : "No Data"}</td>
                        <td class="border border-gray-200 px-4 py-3 text-sm text-gray-600">${user.userBmi ? user.userBmi.status_weight : "No Data"}</td>
                        <td class="border border-gray-200 px-4 py-3 text-sm text-gray-600">
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onClick="deleteUser(${user.id})">Hapus</button>
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded" onClick="editMode(true,${user.id})">Edit</button>
                        </td>
                    `
                    tableBody.appendChild(row)
                })
            }
        }).catch((err) => {
            console.error("Error loading data:", err)
        })
    }

    function load_update_data() {
        const urlParams = new URLSearchParams(window.location.search);
        const editMode = urlParams.get('editMode') === 'true';
        const userId = urlParams.get('user_id');

        if (editMode && userId) {
            fetch("/action/get_user?user_id=" + userId).then(async (res) => {
                const data = await res.json()
    
                if (data.data) {
                    document.getElementById("fullname").value = data.data.fullname
                    document.getElementById("nip").value = data.data.nip
                    document.getElementById("password").value = data.data.password
                    document.getElementById("gender").value = data.data.gender
                    document.getElementById("userType").value = data.data.userType
                    document.getElementById("weight").value = data.data.userBmi ? data.data.userBmi.weight : ""
                    document.getElementById("height").value = data.data.userBmi ? data.data.userBmi.height : ""
                }
            })
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        load_datagrid();
        load_update_data();
    })
</script>
</html>