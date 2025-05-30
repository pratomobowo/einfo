@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-lg shadow-lg p-6 text-white">
        <h2 class="text-2xl font-bold leading-7 sm:truncate sm:text-3xl sm:tracking-tight">Dokumentasi Aplikasi</h2>
        <p class="mt-1 text-blue-100">Panduan lengkap penggunaan aplikasi eInfo</p>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Documentation Navigation -->
        <div class="border-b border-gray-200">
            <nav class="flex overflow-x-auto py-4 px-6">
                <ul class="flex space-x-8">
                    <li>
                        <a href="#pendahuluan" class="text-blue-600 font-medium pb-4 border-b-2 border-blue-600">Pendahuluan</a>
                    </li>
                    <li>
                        <a href="#kegiatan" class="text-gray-500 hover:text-blue-600 font-medium pb-4 hover:border-b-2 hover:border-blue-600">Kegiatan</a>
                    </li>
                    <li>
                        <a href="#surat-keputusan" class="text-gray-500 hover:text-blue-600 font-medium pb-4 hover:border-b-2 hover:border-blue-600">Surat Keputusan</a>
                    </li>
                    <li>
                        <a href="#kategori-sk" class="text-gray-500 hover:text-blue-600 font-medium pb-4 hover:border-b-2 hover:border-blue-600">Kategori SK</a>
                    </li>
                    <li>
                        <a href="#rektor" class="text-gray-500 hover:text-blue-600 font-medium pb-4 hover:border-b-2 hover:border-blue-600">Rektor</a>
                    </li>
                    <li>
                        <a href="#pengguna" class="text-gray-500 hover:text-blue-600 font-medium pb-4 hover:border-b-2 hover:border-blue-600">Pengguna</a>
                    </li>
                    <li>
                        <a href="#aktivitas" class="text-gray-500 hover:text-blue-600 font-medium pb-4 hover:border-b-2 hover:border-blue-600">Log Aktivitas</a>
                    </li>
                    <li>
                        <a href="#tv-display" class="text-gray-500 hover:text-blue-600 font-medium pb-4 hover:border-b-2 hover:border-blue-600">TV Display</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Documentation Content -->
        <div class="p-6 space-y-8">
            <!-- Introduction Section -->
            <section id="pendahuluan" class="space-y-4">
                <h3 class="text-2xl font-bold text-gray-900">Pendahuluan</h3>
                
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                    <h4 class="text-lg font-semibold text-blue-800 mb-2">Tentang eInfo</h4>
                    <p class="text-blue-800">
                        eInfo adalah sistem informasi yang dibangun untuk mengelola jadwal kegiatan dan informasi penting di lingkungan universitas. 
                        Aplikasi ini memudahkan pengelolaan kegiatan, surat keputusan, dan informasi rektor.
                    </p>
                </div>
                
                <div class="space-y-4 mt-6">
                    <h4 class="text-lg font-semibold text-gray-900">Fitur Utama</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-2">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h5 class="text-md font-semibold text-gray-900 ml-3">Manajemen Kegiatan</h5>
                            </div>
                            <p class="text-gray-600 mt-2">
                                Mengelola seluruh kegiatan universitas, termasuk jadwal, lokasi, dan pejabat yang terlibat.
                            </p>
                        </div>
                        
                        <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-2">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h5 class="text-md font-semibold text-gray-900 ml-3">Surat Keputusan</h5>
                            </div>
                            <p class="text-gray-600 mt-2">
                                Menyimpan dan mengelola Surat Keputusan (SK) Rektorat dan Yayasan.
                            </p>
                        </div>
                        
                        <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-2">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <h5 class="text-md font-semibold text-gray-900 ml-3">Informasi Rektor</h5>
                            </div>
                            <p class="text-gray-600 mt-2">
                                Mengelola data dan jadwal kegiatan rektor dan pejabat penting universitas.
                            </p>
                        </div>
                        
                        <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-2">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <h5 class="text-md font-semibold text-gray-900 ml-3">Manajemen Pengguna</h5>
                            </div>
                            <p class="text-gray-600 mt-2">
                                Mengelola akses pengguna dan administrator sistem.
                            </p>
                        </div>
                        
                        <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-2">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                    </svg>
                                </div>
                                <h5 class="text-md font-semibold text-gray-900 ml-3">Log Aktivitas</h5>
                            </div>
                            <p class="text-gray-600 mt-2">
                                Mencatat dan memonitor aktivitas pengguna pada sistem, termasuk login dan logout.
                            </p>
                        </div>
                        
                        <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-2">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                                    </svg>
                                </div>
                                <h5 class="text-md font-semibold text-gray-900 ml-3">Kategori SK</h5>
                            </div>
                            <p class="text-gray-600 mt-2">
                                Mengelola kategori-kategori untuk Surat Keputusan untuk organisasi yang lebih baik.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Activities Section -->
            <section id="kegiatan" class="space-y-4 pt-6 border-t border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900">Pengelolaan Kegiatan</h3>
                
                <div class="space-y-8">
                    <!-- View Activities -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">1</span>
                            Melihat Daftar Kegiatan
                        </h4>
                        <p class="text-gray-700">
                            Daftar kegiatan dapat diakses melalui menu <strong>Kegiatan</strong> pada sidebar. Pada halaman ini, Anda dapat melihat semua kegiatan yang telah diinput dalam sistem.
                        </p>
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold text-blue-600">Tips:</span> Gunakan filter dan pencarian untuk menemukan kegiatan yang spesifik. Anda dapat mengklik pada judul kegiatan untuk melihat detail lengkapnya.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Add New Activity -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">2</span>
                            Menambahkan Kegiatan Baru
                        </h4>
                        <p class="text-gray-700">
                            Untuk menambahkan kegiatan baru, klik tombol <strong>Tambah Kegiatan</strong> pada halaman daftar kegiatan. Isi formulir dengan informasi yang diperlukan.
                        </p>
                        <div class="bg-white p-4 rounded-lg border border-gray-200 space-y-3">
                            <h5 class="font-medium text-gray-900">Formulir Kegiatan terdiri dari:</h5>
                            <ul class="list-disc list-inside text-gray-700 space-y-2">
                                <li><strong>Judul Kegiatan:</strong> Nama atau judul kegiatan</li>
                                <li><strong>Pejabat:</strong> Pejabat yang terkait dengan kegiatan</li>
                                <li><strong>Tanggal dan Waktu:</strong> Jadwal pelaksanaan kegiatan</li>
                                <li><strong>Kategori Kegiatan:</strong> Internal atau Eksternal</li>
                                <li><strong>Lokasi:</strong> Tempat pelaksanaan kegiatan</li>
                                <li><strong>Deskripsi:</strong> Penjelasan detail tentang kegiatan</li>
                                <li><strong>Surat Tugas:</strong> Unggah file surat tugas terkait (opsional)</li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Edit Activity -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">3</span>
                            Mengedit Kegiatan
                        </h4>
                        <p class="text-gray-700">
                            Untuk mengedit kegiatan, klik tombol <strong>Edit</strong> pada kegiatan yang ingin diubah. Formulir edit akan muncul dengan data yang sudah ada. Ubah informasi yang diperlukan dan simpan perubahan.
                        </p>
                    </div>
                    
                    <!-- Delete Activity -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">4</span>
                            Menghapus Kegiatan
                        </h4>
                        <p class="text-gray-700">
                            Untuk menghapus kegiatan, klik tombol <strong>Hapus</strong> pada kegiatan yang ingin dihapus. Konfirmasi penghapusan pada dialog yang muncul.
                        </p>
                        <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                            <p class="text-sm text-yellow-800">
                                <span class="font-semibold">Perhatian:</span> Penghapusan kegiatan bersifat permanen dan tidak dapat dikembalikan. Pastikan Anda yakin sebelum menghapus kegiatan.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Decree Section -->
            <section id="surat-keputusan" class="space-y-4 pt-6 border-t border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900">Pengelolaan Surat Keputusan</h3>
                
                <div class="space-y-8">
                    <!-- View Decrees -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">1</span>
                            Melihat Daftar Surat Keputusan
                        </h4>
                        <p class="text-gray-700">
                            Daftar Surat Keputusan (SK) dapat diakses melalui menu <strong>Surat Keputusan</strong> pada sidebar. Pada halaman ini, Anda dapat melihat semua SK yang telah diinput dalam sistem.
                        </p>
                    </div>
                    
                    <!-- Add New Decree -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">2</span>
                            Menambahkan Surat Keputusan Baru
                        </h4>
                        <p class="text-gray-700">
                            Untuk menambahkan SK baru, klik tombol <strong>Tambah SK</strong> pada halaman daftar SK. Isi formulir dengan informasi yang diperlukan.
                        </p>
                        <div class="bg-white p-4 rounded-lg border border-gray-200 space-y-3">
                            <h5 class="font-medium text-gray-900">Formulir SK terdiri dari:</h5>
                            <ul class="list-disc list-inside text-gray-700 space-y-2">
                                <li><strong>Nomor SK:</strong> Nomor surat keputusan</li>
                                <li><strong>Jenis SK:</strong> SK Rektorat atau SK Yayasan</li>
                                <li><strong>Tanggal:</strong> Tanggal penerbitan SK</li>
                                <li><strong>Perihal:</strong> Perihal atau judul SK</li>
                                <li><strong>Deskripsi:</strong> Penjelasan singkat tentang SK</li>
                                <li><strong>File SK:</strong> Unggah file SK dalam format PDF</li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Edit and Delete Decree -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">3</span>
                            Mengedit dan Menghapus SK
                        </h4>
                        <p class="text-gray-700">
                            Proses mengedit dan menghapus SK serupa dengan proses pada kegiatan. Gunakan tombol <strong>Edit</strong> atau <strong>Hapus</strong> pada daftar SK untuk melakukan operasi yang diinginkan.
                        </p>
                    </div>
                </div>
            </section>
            
            <!-- Officials Section -->
            <section id="rektor" class="space-y-4 pt-6 border-t border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900">Pengelolaan Data Rektor</h3>
                
                <div class="space-y-8">
                    <!-- View Officials -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">1</span>
                            Melihat Daftar Pejabat
                        </h4>
                        <p class="text-gray-700">
                            Daftar pejabat dapat diakses melalui menu <strong>Rektor</strong> pada sidebar. Pada halaman ini, Anda dapat melihat semua pejabat yang telah diinput dalam sistem.
                        </p>
                    </div>
                    
                    <!-- Manage Officials -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">2</span>
                            Mengelola Data Pejabat
                        </h4>
                        <p class="text-gray-700">
                            Anda dapat menambahkan, mengedit, dan menghapus data pejabat sesuai kebutuhan. Pastikan data pejabat selalu terbaru dan akurat.
                        </p>
                        <div class="bg-white p-4 rounded-lg border border-gray-200 space-y-3">
                            <h5 class="font-medium text-gray-900">Informasi pejabat meliputi:</h5>
                            <ul class="list-disc list-inside text-gray-700 space-y-2">
                                <li><strong>Nama:</strong> Nama lengkap pejabat</li>
                                <li><strong>Jabatan:</strong> Jabatan atau posisi pejabat</li>
                                <li><strong>NIP/NIK:</strong> Nomor identitas pejabat</li>
                                <li><strong>Email:</strong> Alamat email pejabat</li>
                                <li><strong>Nomor Telepon:</strong> Nomor telepon yang dapat dihubungi</li>
                                <li><strong>Foto:</strong> Foto pejabat (opsional)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Users Section -->
            <section id="pengguna" class="space-y-4 pt-6 border-t border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900">Manajemen Pengguna</h3>
                
                <div class="space-y-8">
                    <!-- View Users -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">1</span>
                            Melihat Daftar Pengguna
                        </h4>
                        <p class="text-gray-700">
                            Daftar pengguna dapat diakses melalui menu <strong>Pengguna</strong> pada sidebar. Pada halaman ini, Anda dapat melihat semua pengguna yang terdaftar dalam sistem.
                        </p>
                    </div>
                    
                    <!-- Add User -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">2</span>
                            Menambahkan Pengguna Baru
                        </h4>
                        <p class="text-gray-700">
                            Untuk menambahkan pengguna baru, klik tombol <strong>Tambah Pengguna</strong> pada halaman daftar pengguna. Isi formulir dengan informasi yang diperlukan.
                        </p>
                        <div class="bg-white p-4 rounded-lg border border-gray-200 space-y-3">
                            <h5 class="font-medium text-gray-900">Formulir pengguna terdiri dari:</h5>
                            <ul class="list-disc list-inside text-gray-700 space-y-2">
                                <li><strong>Nama:</strong> Nama lengkap pengguna</li>
                                <li><strong>Email:</strong> Alamat email pengguna (digunakan untuk login)</li>
                                <li><strong>Password:</strong> Kata sandi untuk akun pengguna</li>
                                <li><strong>Peran:</strong> Super Admin, Admin Sekretariat, atau Pengguna biasa</li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Manage User Access -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">3</span>
                            Mengelola Akses Pengguna
                        </h4>
                        <p class="text-gray-700">
                            Anda dapat mengedit peran pengguna atau menonaktifkan akun pengguna jika diperlukan. Setiap peran memiliki akses yang berbeda dalam sistem.
                        </p>
                        <div class="bg-white p-4 rounded-lg border border-gray-200 space-y-3">
                            <h5 class="font-medium text-gray-900">Peran Pengguna dan Hak Akses:</h5>
                            <ul class="list-disc list-inside text-gray-700 space-y-2">
                                <li><strong>Super Admin:</strong> Memiliki akses penuh ke seluruh fitur sistem, termasuk mengelola semua pengguna lain</li>
                                <li><strong>Admin Sekretariat:</strong> Dapat mengelola kegiatan, SK, dan pengguna biasa, namun tidak dapat mengelola Super Admin</li>
                                <li><strong>Pengguna:</strong> Memiliki akses terbatas sesuai dengan izin yang diberikan</li>
                            </ul>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                            <p class="text-sm text-yellow-800">
                                <span class="font-semibold">Perhatian:</span> Berhati-hatilah dalam memberikan akses admin. Pastikan hanya pengguna yang berwenang yang memiliki peran admin.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Decree Categories Section -->
            <section id="kategori-sk" class="space-y-4 pt-6 border-t border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900">Pengelolaan Kategori Surat Keputusan</h3>
                
                <div class="space-y-8">
                    <!-- View Categories -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">1</span>
                            Melihat Daftar Kategori SK
                        </h4>
                        <p class="text-gray-700">
                            Daftar kategori SK dapat diakses melalui menu <strong>Kategori SK</strong> pada sidebar. Pada halaman ini, Anda dapat melihat semua kategori SK yang telah dibuat dalam sistem.
                        </p>
                    </div>
                    
                    <!-- Add New Category -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">2</span>
                            Menambahkan Kategori SK Baru
                        </h4>
                        <p class="text-gray-700">
                            Untuk menambahkan kategori SK baru, klik tombol <strong>Tambah Kategori</strong> pada halaman daftar kategori. Isi formulir dengan informasi yang diperlukan.
                        </p>
                        <div class="bg-white p-4 rounded-lg border border-gray-200 space-y-3">
                            <h5 class="font-medium text-gray-900">Formulir Kategori SK terdiri dari:</h5>
                            <ul class="list-disc list-inside text-gray-700 space-y-2">
                                <li><strong>Nama Kategori:</strong> Nama untuk kategori SK</li>
                                <li><strong>Deskripsi:</strong> Penjelasan singkat tentang kategori (opsional)</li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Manage Categories -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">3</span>
                            Mengelola Kategori SK
                        </h4>
                        <p class="text-gray-700">
                            Anda dapat mengedit atau menghapus kategori SK yang ada. Saat membuat atau mengedit SK, Anda dapat memilih kategori yang sesuai dari daftar yang tersedia.
                        </p>
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold text-blue-600">Tips:</span> Mengorganisir SK dalam kategori memudahkan pencarian dan pengelolaan SK, terutama ketika jumlah SK semakin banyak.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Activity Log Section -->
            <section id="aktivitas" class="space-y-4 pt-6 border-t border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900">Log Aktivitas Pengguna</h3>
                
                <div class="space-y-8">
                    <!-- View Activity Logs -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">1</span>
                            Melihat Log Aktivitas
                        </h4>
                        <p class="text-gray-700">
                            Log aktivitas pengguna dapat diakses melalui menu <strong>Log Aktivitas</strong> pada sidebar. Pada halaman ini, Anda dapat melihat semua aktivitas yang dilakukan pengguna dalam sistem, termasuk login dan logout.
                        </p>
                    </div>
                    
                    <!-- Log Information -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">2</span>
                            Informasi dalam Log Aktivitas
                        </h4>
                        <p class="text-gray-700">
                            Log aktivitas memberikan informasi detail tentang aktivitas pengguna yang dilakukan dalam sistem.
                        </p>
                        <div class="bg-white p-4 rounded-lg border border-gray-200 space-y-3">
                            <h5 class="font-medium text-gray-900">Informasi yang tersedia dalam log aktivitas meliputi:</h5>
                            <ul class="list-disc list-inside text-gray-700 space-y-2">
                                <li><strong>Waktu:</strong> Tanggal dan waktu aktivitas dilakukan</li>
                                <li><strong>Pengguna:</strong> Nama pengguna yang melakukan aktivitas</li>
                                <li><strong>Jenis Aktivitas:</strong> Jenis tindakan yang dilakukan (login, logout, membuat, mengedit, menghapus)</li>
                                <li><strong>Modul:</strong> Bagian sistem tempat aktivitas dilakukan</li>
                                <li><strong>Detail:</strong> Informasi tambahan tentang aktivitas</li>
                                <li><strong>IP Address:</strong> Alamat IP perangkat yang digunakan</li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Using Activity Logs -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">3</span>
                            Manfaat Log Aktivitas
                        </h4>
                        <p class="text-gray-700">
                            Log aktivitas berguna untuk audit, pemecahan masalah, dan memantau aktivitas pengguna dalam sistem.
                        </p>
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold text-blue-600">Tips:</span> Gunakan filter dan pencarian untuk menemukan aktivitas spesifik berdasarkan pengguna, jenis aktivitas, atau waktu tertentu.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- TV Display Section -->
            <section id="tv-display" class="space-y-4 pt-6 border-t border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900">Tampilan TV (TV Display)</h3>
                
                <div class="space-y-8">
                    <!-- About TV Display -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">1</span>
                            Tentang Tampilan TV
                        </h4>
                        <p class="text-gray-700">
                            Tampilan TV adalah halaman khusus yang dirancang untuk ditampilkan pada layar TV atau monitor besar untuk menunjukkan jadwal kegiatan hari ini. Halaman ini dapat diakses melalui URL <strong>/tv</strong>.
                        </p>
                    </div>
                    
                    <!-- TV Display Features -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">2</span>
                            Fitur Tampilan TV
                        </h4>
                        <p class="text-gray-700">
                            Tampilan TV menyajikan informasi kegiatan dengan cara yang optimal untuk dilihat dari jarak jauh.
                        </p>
                        <div class="bg-white p-4 rounded-lg border border-gray-200 space-y-3">
                            <h5 class="font-medium text-gray-900">Fitur utama tampilan TV meliputi:</h5>
                            <ul class="list-disc list-inside text-gray-700 space-y-2">
                                <li><strong>Tampilan Waktu:</strong> Menampilkan waktu dan tanggal saat ini</li>
                                <li><strong>Daftar Kegiatan:</strong> Menampilkan semua kegiatan untuk hari ini</li>
                                <li><strong>Indikator Status:</strong> Menunjukkan status kegiatan (berlangsung, akan datang, selesai)</li>
                                <li><strong>Latar Merah:</strong> Kegiatan yang telah lewat lebih dari 1 jam ditandai dengan latar belakang merah</li>
                                <li><strong>Running Text:</strong> Informasi kegiatan berjalan di bagian bawah layar</li>
                                <li><strong>Auto-Refresh:</strong> Halaman akan diperbarui secara otomatis setiap 5 menit</li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Using TV Display -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-800 rounded-full w-6 h-6 flex items-center justify-center mr-2">3</span>
                            Menggunakan Tampilan TV
                        </h4>
                        <p class="text-gray-700">
                            Untuk menggunakan tampilan TV secara optimal, ikuti langkah-langkah berikut:
                        </p>
                        <div class="bg-white p-4 rounded-lg border border-gray-200 space-y-3">
                            <ol class="list-decimal list-inside text-gray-700 space-y-2">
                                <li>Buka browser pada komputer yang terhubung dengan TV atau monitor</li>
                                <li>Akses URL <strong>[domain]/tv</strong></li>
                                <li>Atur browser ke mode fullscreen (biasanya dengan menekan tombol F11)</li>
                                <li>Pastikan komputer tetap menyala dan terhubung ke internet</li>
                            </ol>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <p class="text-sm text-gray-600">
                                <span class="font-semibold text-blue-600">Tips:</span> Untuk tampilan optimal, gunakan monitor dengan resolusi minimal 1080p. Tampilan TV dirancang responsif dan akan menyesuaikan dengan ukuran layar.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Additional Tips Section -->
            <section class="space-y-4 pt-6 border-t border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900">Tips dan Praktik Terbaik</h3>
                
                <div class="bg-blue-50 p-5 rounded-lg border border-blue-200 space-y-4">
                    <h4 class="font-medium text-blue-800">Berikut beberapa praktik terbaik untuk penggunaan aplikasi eInfo:</h4>
                    <ul class="list-disc list-inside text-blue-700 space-y-3">
                        <li>Selalu perbarui informasi secara berkala agar data tetap akurat dan terkini.</li>
                        <li>Gunakan fitur pencarian dan filter untuk menemukan informasi dengan cepat.</li>
                        <li>Buat cadangan data secara rutin untuk menghindari kehilangan informasi penting.</li>
                        <li>Pastikan detail kegiatan diisi lengkap dan jelas untuk memudahkan pengguna lain memahami informasi.</li>
                        <li>Gunakan format yang konsisten untuk tanggal, waktu, dan penamaan file untuk menjaga kerapian data.</li>
                    </ul>
                </div>
            </section>
            
            <!-- Support Section -->
            <section class="space-y-4 pt-6 border-t border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900">Dukungan Teknis</h3>
                
                <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                    <p class="text-gray-700 mb-4">
                        Jika Anda mengalami masalah atau memiliki pertanyaan tentang penggunaan aplikasi eInfo, silakan hubungi Tim Dukungan Teknis Biro Teknologi Informasi USBYPKP.
                    </p>
                    
                    <div class="flex items-center text-gray-700">
                        <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Email: <a href="mailto:it@usbypkp.ac.id" class="text-blue-600 hover:underline">it@usbypkp.ac.id</a></span>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all the documentation navigation links (lebih spesifik dengan membatasi selector)
        const navLinks = document.querySelectorAll('.bg-white.rounded-lg.shadow-md.overflow-hidden nav a');
        
        // Add click event listener to each link
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Get the target section id from href
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);
                
                // Scroll to the target section smoothly
                if (targetSection) {
                    window.scrollTo({
                        top: targetSection.offsetTop - 80, // Offset for fixed header
                        behavior: 'smooth'
                    });
                    
                    // Update active link style
                    navLinks.forEach(nav => {
                        nav.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                        nav.classList.add('text-gray-500', 'hover:text-blue-600');
                    });
                    
                    this.classList.remove('text-gray-500', 'hover:text-blue-600');
                    this.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                }
            });
        });
        
        // Highlight active section on scroll
        window.addEventListener('scroll', function() {
            const scrollPosition = window.scrollY;
            
            // Get all sections
            const sections = document.querySelectorAll('section[id]');
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                const sectionHeight = section.offsetHeight;
                const sectionId = '#' + section.getAttribute('id');
                
                if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                    navLinks.forEach(nav => {
                        nav.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                        nav.classList.add('text-gray-500', 'hover:text-blue-600');
                        
                        if (nav.getAttribute('href') === sectionId) {
                            nav.classList.remove('text-gray-500', 'hover:text-blue-600');
                            nav.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush 