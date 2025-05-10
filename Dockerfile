# Gunakan image PHP resmi dengan server Apache.
# Anda bisa mengganti 8.2 dengan versi PHP yang Anda inginkan (misalnya, 7.4, 8.0, 8.1, 8.3).
FROM php:8.2-apache

# Set direktori kerja utama untuk Apache. Ini adalah document root.
WORKDIR /var/www/html

# Aktifkan modul Apache mod_rewrite.
# Ini penting agar aturan dalam .htaccess bisa berfungsi.
RUN a2enmod rewrite

# Salin file .htaccess dari direktori build ke document root Apache.
# Pastikan file .htaccess (dengan konten dari artefak htaccess_php_front_controller)
# berada di direktori yang sama dengan Dockerfile ini saat proses build.
COPY .htaccess /var/www/html/.htaccess

# Salin index.php dari root proyek Anda ke document root Apache.
COPY index.php /var/www/html/index.php

# Salin isi dari direktori 'public' lokal Anda (yang berisi aset statis)
# ke subdirektori 'public' di dalam document root Apache.
# Aset akan dapat diakses melalui URL seperti /public/assets/style.css.
COPY public/ /var/www/html/public/

# Salin isi dari direktori 'src' lokal Anda ke direktori /var/www/html/src di dalam container.
# Skrip PHP utama (index.php di /var/www/html/) dapat meng-include atau me-require file
# dari direktori ini menggunakan path seperti __DIR__ . '/src/utils/database.php';
COPY src/ /var/www/html/src/

# (Opsional) Jika Anda memiliki direktori 'docs' dan ingin menyalinnya juga ke dalam image:
# COPY docs/ /var/www/docs/

# Instal ekstensi PHP mysqli.
# Anda mungkin perlu menginstal dependensi sistem terlebih dahulu untuk beberapa ekstensi.
# Untuk mysqli, biasanya tidak memerlukan dependensi sistem tambahan pada image php:apache.
# Jika Anda membutuhkan ekstensi lain, Anda bisa menambahkannya di sini.
# Contoh: docker-php-ext-install pdo pdo_mysql gd zip
RUN apt-get update && \
    docker-php-ext-install mysqli && \
    # Bersihkan cache apt untuk mengurangi ukuran image
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# (Opsional) Jika Anda menggunakan Composer untuk manajemen dependensi:
# Pastikan composer.json dan composer.lock ada di root proyek Anda atau sesuaikan path.
# COPY composer.json composer.lock* ./
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# RUN composer install --no-dev --optimize-autoloader
# Jika composer.json ada di dalam direktori 'src':
# WORKDIR /var/www/src
# COPY src/composer.json src/composer.lock* /var/www/src/
# RUN composer install --no-dev --optimize-autoloader
# WORKDIR /var/www/html # Kembali ke WORKDIR utama Apache

# Pastikan direktori 'uploads' (jika ada di dalam public/ dan digunakan untuk unggahan file) dapat ditulis oleh server web (Apache).
# Apache di image ini berjalan sebagai user www-data.
# Path disesuaikan menjadi /var/www/html/public/uploads.
RUN if [ -d "/var/www/html/public/uploads" ]; then \
        chown -R www-data:www-data /var/www/html/public/uploads && \
        chmod -R 755 /var/www/html/public/uploads; \
    fi
# Jika Anda ingin memastikan direktori 'uploads' selalu ada (misalnya, jika tidak ada di source code):
# RUN mkdir -p /var/www/html/public/uploads && \
#     chown -R www-data:www-data /var/www/html/public/uploads && \
#     chmod -R 755 /var/www/html/public/uploads

# Expose port 80, port default yang digunakan oleh Apache.
EXPOSE 80

# Perintah default dari image php:apache (yaitu apache2-foreground) akan otomatis dijalankan
# saat container dimulai. Jadi, Anda tidak perlu menambahkan CMD atau ENTRYPOINT secara eksplisit
# kecuali jika Anda ingin menimpa perilaku default tersebut.
