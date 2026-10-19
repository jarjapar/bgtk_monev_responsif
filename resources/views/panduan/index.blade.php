@extends('layouts.app')

@section('title', 'Panduan Pengisian')

@section('page-title', 'Panduan Pengisian')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold text-slate-800">
            Panduan Pengisian
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Panduan penggunaan sistem Monitoring dan Evaluasi BGTK Provinsi NTB.
        </p>
    </div>

    {{-- Pengantar --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

        <div class="flex items-start gap-4">

            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                <span class="text-lg font-bold">i</span>
            </div>

            <div>
                <h2 class="text-lg font-bold text-slate-800">
                    Tentang Sistem Monev BGTK
                </h2>

                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Sistem Monitoring dan Evaluasi BGTK Provinsi NTB digunakan
                    untuk membantu pengelolaan data monitoring, wawancara,
                    tindak lanjut, serta informasi sekolah yang menjadi objek
                    pemantauan dan evaluasi.
                </p>
            </div>

        </div>

    </div>

    {{-- Alur penggunaan --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-6 py-5">
            <h2 class="text-lg font-bold text-slate-800">
                Alur Penggunaan Sistem
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Ikuti tahapan berikut dalam melakukan monitoring dan evaluasi.
            </p>
        </div>

        <div class="p-6">

            <div class="space-y-6">

                {{-- Step 1 --}}
                <div class="flex gap-4">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white">
                        1
                    </div>

                    <div>
                        <h3 class="font-semibold text-slate-800">
                            Data Sekolah
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-slate-600">
                            Tambahkan dan kelola data sekolah yang menjadi
                            sasaran monitoring dan evaluasi. Pastikan NPSN,
                            nama sekolah, jenjang, dan wilayah telah diisi
                            dengan benar.
                        </p>
                    </div>

                </div>

                {{-- Step 2 --}}
                <div class="flex gap-4">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white">
                        2
                    </div>

                    <div>
                        <h3 class="font-semibold text-slate-800">
                            Instrumen Pemantauan
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-slate-600">
                            Kelola instrumen yang digunakan sebagai dasar
                            pelaksanaan monitoring dan evaluasi. Informasi
                            instrumen meliputi kode, nama, jenis, status,
                            jumlah pertanyaan, dan periode pelaksanaan.
                        </p>
                    </div>

                </div>

                {{-- Step 3 --}}
                <div class="flex gap-4">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white">
                        3
                    </div>

                    <div>
                        <h3 class="font-semibold text-slate-800">
                            Lembar Wawancara
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-slate-600">
                            Catat kegiatan wawancara yang dilakukan pada
                            sekolah. Data yang dicatat meliputi narasumber,
                            pewawancara, tanggal wawancara, status, hasil,
                            dan catatan.
                        </p>
                    </div>

                </div>

                {{-- Step 4 --}}
                <div class="flex gap-4">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white">
                        4
                    </div>

                    <div>
                        <h3 class="font-semibold text-slate-800">
                            Rencana Tindak Lanjut
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-slate-600">
                            Buat tindak lanjut berdasarkan hasil monitoring
                            maupun wawancara. Tentukan penanggung jawab,
                            tanggal mulai, target penyelesaian, dan status
                            pelaksanaan.
                        </p>
                    </div>

                </div>

                {{-- Step 5 --}}
                <div class="flex gap-4">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white">
                        5
                    </div>

                    <div>
                        <h3 class="font-semibold text-slate-800">
                            Monitoring Tindak Lanjut
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-slate-600">
                            Pantau perkembangan tindak lanjut melalui status
                            Belum Dimulai, Dalam Proses, dan Selesai.
                            Perbarui data apabila terdapat perubahan.
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Panduan menu --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-6 py-5">
            <h2 class="text-lg font-bold text-slate-800">
                Panduan Menu
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Fungsi utama setiap menu dalam sistem.
            </p>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead class="border-b border-slate-200 bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 font-semibold text-slate-700">
                            Menu
                        </th>

                        <th class="px-6 py-4 font-semibold text-slate-700">
                            Fungsi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    <tr>
                        <td class="px-6 py-4 font-semibold text-slate-800">
                            Dashboard
                        </td>

                        <td class="px-6 py-4 text-slate-600">
                            Menampilkan ringkasan informasi monitoring dan evaluasi.
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4 font-semibold text-slate-800">
                            Instrumen Pemantauan
                        </td>

                        <td class="px-6 py-4 text-slate-600">
                            Mengelola instrumen yang digunakan dalam kegiatan monitoring.
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4 font-semibold text-slate-800">
                            Lembar Wawancara
                        </td>

                        <td class="px-6 py-4 text-slate-600">
                            Mencatat dan mengelola data kegiatan wawancara.
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4 font-semibold text-slate-800">
                            Rencana Tindak Lanjut
                        </td>

                        <td class="px-6 py-4 text-slate-600">
                            Mengelola rencana dan progres tindak lanjut hasil monitoring.
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4 font-semibold text-slate-800">
                            Data Sekolah
                        </td>

                        <td class="px-6 py-4 text-slate-600">
                            Mengelola data sekolah yang menjadi sasaran monitoring.
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4 font-semibold text-slate-800">
                            Profil Saya
                        </td>

                        <td class="px-6 py-4 text-slate-600">
                            Menampilkan informasi profil pengguna sistem.
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

    {{-- Catatan --}}
    <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5">

        <div class="flex items-start gap-3">

            <div class="mt-0.5 font-bold text-amber-600">
                !
            </div>

            <div>
                <h3 class="text-sm font-bold text-amber-800">
                    Catatan
                </h3>

                <p class="mt-1 text-sm leading-6 text-amber-700">
                    Pastikan setiap data yang dimasukkan telah diperiksa
                    sebelum disimpan. Data yang telah tersimpan dapat
                    diperbarui melalui fitur Edit apabila terjadi perubahan.
                </p>
            </div>

        </div>

    </div>

</div>

@endsection