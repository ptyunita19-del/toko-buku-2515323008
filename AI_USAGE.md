# AI_USAGE.md  
AI yang Digunakan: ChatGPT (OpenAI)

## Catatan Penggunaan AI

### 1. Memahami Soal UTS

**Pertanyaan kepada AI:** Meminta penjelasan mengenai tugas UTS fitur Penulis dan urutan pengerjaan pada aplikasi Laravel BookStore.

**Bantuan yang digunakan:** Penjelasan pembagian tugas Level 1, Level 2, dan Level 3 serta urutan implementasi fitur.

**Penerapan:** Menggunakan penjelasan sebagai panduan pengerjaan proyek.

### 2. Membuat CRUD Penulis

**Pertanyaan kepada AI:** Meminta panduan membuat fitur tambah, tampil, ubah, dan hapus Penulis.

**Bantuan yang digunakan:** Contoh struktur `AuthorController.php`, Model `Author.php`, migration tabel `authors`, route resource, dan tampilan Blade.

**Penerapan:** Membuat halaman CRUD Penulis dan menguji proses tambah, ubah, serta hapus data.

### 3. Membuat Validasi Penulis

**Pertanyaan kepada AI:** Meminta panduan validasi nama wajib diisi, nama tidak boleh duplikat, serta negara yang boleh dikosongkan.

**Bantuan yang digunakan:** Contoh penggunaan `$request->validate()` dan `Rule::unique()->ignore()`.

**Penerapan:** Menambahkan validasi pada `AuthorController.php` dan menguji pesan kesalahan berbahasa Indonesia.

### 4. Menambahkan Menu Penulis

**Pertanyaan kepada AI:** Meminta bantuan menampilkan menu Penulis pada navbar aplikasi BookStore.

**Bantuan yang digunakan:** Contoh link `route('penulis.index')`.

**Penerapan:** Menambahkan menu Penulis pada `resources/views/components/navbar.blade.php`.

### 5. Membuat Relasi Buku dan Penulis

**Pertanyaan kepada AI:** Meminta panduan menambahkan kolom `author_id` tanpa menghapus `author_name`.

**Bantuan yang digunakan:** Contoh migration foreign key nullable dan relasi `hasMany()` serta `belongsTo()`.

**Penerapan:** Membuat migration baru, menjalankan `php artisan migrate`, dan memperbarui Model Book dan Author.

### 6. Memperbarui BookController

**Pertanyaan kepada AI:** Meminta bantuan menambahkan daftar Penulis ke form Buku dan membuat validasi `author_id`.

**Bantuan yang digunakan:** Contoh `Author::orderBy('name')->get()` serta validasi `nullable|integer|exists:authors,id`.

**Penerapan:** Memperbarui method `create()`, `edit()`, `aturan()`, dan `pesan()` tanpa menghapus fitur lama.

### 7. Menambahkan Dropdown Penulis

**Pertanyaan kepada AI:** Meminta bantuan menambahkan dropdown Penulis Terdaftar pada form Tambah dan Edit Buku.

**Bantuan yang digunakan:** Contoh Blade `@foreach`, `@selected`, dan `old()`.

**Penerapan:** Memperbarui `buku/create.blade.php` dan `buku/edit.blade.php`. Penulis yang sudah tersimpan dapat ditampilkan kembali sebagai pilihan aktif.

### 8. Memperbaiki Error Laravel

**Pertanyaan kepada AI:** Meminta bantuan ketika muncul error `Undefined variable $categories` dan `Undefined variable $daftarPenulis`.

**Bantuan yang digunakan:** Penjelasan mengenai kesesuaian nama variabel antara Controller dan Blade.

**Penerapan:** Memperbaiki penggunaan variabel di file Blade serta menghapus dropdown yang salah tempat.

### 9. Debugging Penyimpanan author_id

**Pertanyaan kepada AI:** Meminta bantuan karena nilai `author_id` tetap `null` setelah memilih Penulis Terdaftar.

**Bantuan yang digunakan:** Panduan penggunaan Laravel Tinker serta `dd()` untuk memeriksa data request dan proses penyimpanan.

**Penerapan:** Memeriksa nilai `author_id`, memperbaiki dan menguji proses penyimpanan, kemudian menghapus kode debugging sementara.

### 10. Membuat Proteksi Hapus Penulis

**Pertanyaan kepada AI:** Meminta panduan agar Penulis yang masih digunakan oleh Buku tidak dapat dihapus.

**Bantuan yang digunakan:** Contoh pemeriksaan relasi menggunakan `$penulis->books()->exists()`.

**Penerapan:** Memperbarui method `destroy()` pada AuthorController dan menguji pesan penolakan penghapusan.

### 11. Menampilkan Penulis pada Detail Buku

**Pertanyaan kepada AI:** Meminta bantuan menampilkan Penulis Terdaftar tanpa menghilangkan nama penulis lama.

**Bantuan yang digunakan:** Contoh eager loading relasi `author` dan kondisi Blade `@if ($buku->author)`.

**Penerapan:** Memperbarui `BookController.php` dan `buku/show.blade.php`. Buku dengan maupun tanpa Penulis Terdaftar berhasil ditampilkan.

## Kesimpulan

ChatGPT digunakan sebagai alat bantu untuk memahami soal, mempelajari sintaks Laravel, memperoleh contoh kode, melakukan debugging, dan memeriksa hasil pengujian.

Kode yang digunakan disesuaikan dengan struktur proyek BookStore. Implementasi, pengujian melalui browser, dan pemeriksaan database dilakukan pada proyek Laravel sendiri.

Catatan ini disusun berdasarkan riwayat bantuan AI selama pengerjaan dan perlu disesuaikan apabila terdapat saran yang tidak diterapkan.