@extends('layouts.app')



@section('title', 'Edit Pengisian PKGSD MBI')

@section('page-title', 'Edit Pengisian PKGSD MBI')



@section('content')

    @php

        // Data instrumen diambil dari file INSTRUMEN_MONITORING_DAN_EVALUASI.docx

        $levelData = json_decode(<<<'PKGSD_JSON'

        {"1": {"indikator": [{"no": 1, "indikator": "Kesesuaian tujuan, struktur, dan materi pelatihan dengan kebutuhan guru SD dalam mengajar Bahasa Inggris.", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 2, "indikator": "Kesesuain bahan ajar dengan struktur program", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 3, "indikator": "Kesesuaian alokasi materi dengan bobot materi", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 4, "indikator": "Materi mendukung pengajaran Bahasa Inggris sesuai fase/kelas, kebutuhan murid, dan konteks sekolah", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 5, "indikator": "Manfaat materi pelatihan dalam meningkatkan kompetensi peserta", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 6, "indikator": "Kesiapan dan ketersediaan sarana kegiatan [audio visual, LCD/laptop, papan putih, pelantang, spidol, penghapus].", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 7, "indikator": "Kenyamanan ruang kegiatan [ventilasi udara/AC, pencahayaan].", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 8, "indikator": "Kebersihan ruang kelas.", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 9, "indikator": "Ketersediaan sarana ibadah.", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 10, "indikator": "Ketersediaan akses internet", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 11, "indikator": "Fasilitator memfasilitasi dan mendampingi proses pembelajaran peserta.", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 12, "indikator": "Fasilitator menggunakan bahasa yang menghargai dan menghormati di dalam berkomunikasi dengan peserta.", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 13, "indikator": "Fasilitator memulai dan mengakhiri pembelajaran tepat waktu.", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 14, "indikator": "Fasilitator mampu menyampaikan materi dengan jelas dan tepat, sehingga peserta dapat memahami pembelajaran dengan baik.", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 15, "indikator": "Kemudahan dalam mengakses LMS Pembelajaran", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 16, "indikator": "Kemudahan dalam membaca materi/video yang ada di LMS", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 17, "indikator": "Kemudahan dalam mengikuti alur LMS", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 18, "indikator": "Kemudahan dalam pembelajaran di LMS", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 19, "indikator": "Kemudahan dalam berdiskusi di LMS", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 20, "indikator": "Kemudahan dalam mengumpulkan tugas di LMS", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 21, "indikator": "Kelengkapan dokumen/kit bahan kegiatan [materi, LMS, ATK]", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 22, "indikator": "Kualitas tampilan bahan tayang kegiatan.", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 23, "indikator": "Kemudahan penggunaan bahan tayang, modul, dan sumber belajar", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 24, "indikator": "Ketersediaan ilustrasi dan contoh pada bahan pembelajaran kegiatan.", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 25, "indikator": "Kesesuaian alokasi waktu pelaksanaan kegiatan dengan tujuan dan sasaran program kegiatan.", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 26, "indikator": "Ketepatan alokasi waktu untuk menyelesaikan setiap tagihan pembelajaran.", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 27, "indikator": "Kecukupan menu yang mendukung pemenuhan gizi.", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 28, "indikator": "Variasi hidangan/konsumsi.", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}, {"no": 29, "indikator": "Ketepatan waktu penyediaan konsumsi.", "rubrik": ["Kurang", "Cukup", "Baik", "Sangat Baik"]}], "kelompok": {"1": "Program dan Materi", "6": "Sarana dan Prasarana Penunjang Kegiatan", "11": "Fasilitator", "15": "Akses LMS", "21": "Bahan Kegiatan", "25": "Jangka Waktu Pelaksanaan Kegiatan", "27": "Layanan Menu"}, "label": "LEVEL 1 – REACTION", "deskripsi": "Nilai respons terhadap program dan pelaksanaan pelatihan. Skor 1–4."}, "2": {"indikator": [{"no": 1, "indikator": "Pemahaman capaian dan tujuan pembelajaran Bahasa Inggris", "rubrik": ["Belum dapat menjelaskan tujuan/capaian pembelajaran yang relevan.", "Menjelaskan secara umum, tetapi tujuan belum spesifik atau belum sesuai kelas/fase.", "Menetapkan tujuan yang relevan dengan kelas/fase dan keterampilan berbahasa yang dituju.", "Tujuan spesifik, terukur, sesuai kebutuhan murid, serta mengintegrasikan konteks yang dekat dengan kehidupan mereka."]}, {"no": 2, "indikator": "Pengembangan keterampilan menyimak (listening)", "rubrik": ["Tidak mampu memilih/merancang aktivitas menyimak yang sesuai.", "Aktivitas menyimak ada tetapi instruksi, sumber audio, atau tindak lanjut kurang jelas.", "Merancang aktivitas menyimak dengan instruksi, sumber yang sesuai, dan tugas pemahaman.", "Menggunakan tahapan pra-menyimak, saat menyimak, dan pasca-menyimak serta strategi untuk tingkat kemampuan berbeda."]}, {"no": 3, "indikator": "Pengembangan keterampilan berbicara (speaking)", "rubrik": ["Tidak merancang kesempatan murid berbicara.", "Kesempatan berbicara terbatas pada pengulangan bersama atau jawaban satu kata.", "Menyediakan praktik berpasangan/kelompok dengan ungkapan dan konteks yang sesuai.", "Menyediakan interaksi bermakna, pemodelan, dukungan ungkapan, serta kesempatan berbicara yang merata dan bertahap."]}, {"no": 4, "indikator": "Pengembangan keterampilan membaca (reading)", "rubrik": ["Aktivitas tidak sesuai kemampuan baca atau tujuan.", "Aktivitas didominasi membaca/menyalin tanpa strategi pemahaman yang jelas.", "Memilih teks sesuai tingkat murid dan menyertakan pertanyaan pemahaman.", "Menggunakan strategi sebelum, selama, dan setelah membaca serta dukungan kosakata dan pemahaman."]}, {"no": 5, "indikator": "Pengembangan keterampilan menulis (writing)", "rubrik": ["Tidak menunjukkan tahapan atau contoh penulisan.", "Tugas menulis diberikan tanpa contoh atau bantuan yang memadai.", "Memberi model, kosakata/kerangka, dan kesempatan menulis sesuai tingkat murid.", "Merancang tahapan dari model ke tulisan mandiri, dengan umpan balik dan revisi sederhana."]}, {"no": 6, "indikator": "Media dan sumber belajar", "rubrik": ["Merancang media yang tidak sesuai tujuan/tidak menggunakan media", "Merancang media yang tidak mendukung aktivitas inti", "Merancang media/audio/gambar/kartu/objek mendukung pemahaman dan praktik berbahasa.", "Memilih atau membuat media yang tepat, inklusif, mudah diakses, dan mengaktifkan murid."]}, {"no": 7, "indikator": "Pemahaman terkait prinsip pembelajaran Bahasa Inggris yang sesuai untuk siswa SD.", "rubrik": ["Tidak mampu menjelaskan/menggambarkan prinsip pembelajaran bahasa inggris yang sesuai untuk siswa SD", "Menjelaskan prinsip pembelajaran bahasa inggris namun tidak sesuai dengan siswa SD", "Mampu menjelaskan prinsip pembelajaran bahasa inggris yang sesuai dengan siswa SD", "Mampu menjelaskan prinsip pembelajaran bahasa inggris yang sesuai dengan siswa SD secara spesifik."]}, {"no": 8, "indikator": "Penggunaan ungkapan Bahasa Inggris sederhana dalam kegiatan wawancara", "rubrik": ["Belum mampu menggunakan ungkapan bahasa inggris sederhana ketika wawancara", "Menggunakan Bahasa Inggris secara terbatas tanpa dukungan pemahaman yang konsisten.", "Menggunakan ungkapan bahasa inggris sederhana, model pelafalan, gerak, visual, dan/atau terjemahan seperlunya.", "Bahasa inggris konsisten, jelas, bertahap, disertai visual/gestur."]}, {"no": 9, "indikator": "Penyusunan modul ajar atau rencana pembelajaran Bahasa Inggris.", "rubrik": ["Tidak menyusun modul ajar atau rencana pembelajaran bahasa inggris", "Menyusun modul ajar atau rencana pembelajaran bahasa inggris namun tidak runut", "Menyusun modul ajar atau rencana pembelajaran bahasa inggris namun belum terlihat media dan kegiatan yang menunjang peningkatan kemampuan bahasa inggris siswa", "Modul ajar atau rencana pembelajaran bahasa inggris yang disusun sudah lengkap dan dapat menunjang peningkatan kemampuan bahasa inggris siswa."]}, {"no": 10, "indikator": "merancang aktivitas interaktif, seperti permainan bahasa, lagu, dialog, dan bermain peran.", "rubrik": ["Tidak mampu merancang aktivitas interaktif seperti permainan bahasa, lagu, dialog, dan bermain peran.", "Mampu merancang aktivitas interaktif namun tidak sesuai dengan tujuan pembelajaran", "Mampu merancang aktifitas interaktif yang sesuai dengan tujuan namun masih monoton", "Mampu merancang aktivitas interaktif yang beragam dan sesuai dengan tujuan pembelajaran"]}], "kelompok": {}, "label": "LEVEL 2 — LEARNING: Pengetahuan dan Keterampilan yang Dipelajari", "deskripsi": "Penilai melakukan wawancara dengan guru setelah pelatihan, lalu menilai setiap indikator dengan rubrik 1–4."}, "3": {"indikator": [{"no": 1, "indikator": "Guru menyampaikan tujuan dan alur pembelajaran", "rubrik": ["Tujuan disampaikan/diarahkan dan kegiatan tidak terkait dengan tujuan.", "Tujuan atau alur ada tetapi tidak jelas bagi murid.", "Kegiatan runtut dan mengarah pada tujuan Bahasa Inggris.", "Tujuan, kegiatan, dan penutup saling terhubung; guru mengecek pencapaian tujuan."]}, {"no": 2, "indikator": "Guru menggunakan konteks nyata yang dekat dengan kehidupan murid.", "rubrik": ["Pembelajaran hanya memakai angka dan simbol tanpa konteks.", "Konteks digunakan, tetapi tidak dikenal murid atau tidak diperlukan untuk memahami soal.", "Konteks dikenal murid dan digunakan dalam kegiatan inti.", "Konteks dekat dengan kehidupan murid, digunakan sepanjang pembelajaran, dan murid menyebutkan contoh dari pengalaman mereka sendiri."]}, {"no": 3, "indikator": "Guru mengajukan pertanyaan pemantik yang mendorong murid berpikir.", "rubrik": ["Guru tidak mengajukan pertanyaan yang mendorong murid berpikir.", "Hampir semua pertanyaan guru bersifat tertutup (jawaban singkat benar/salah).", "Guru mengajukan beberapa pertanyaan terbuka, tetapi sebagian besar pertanyaan lainnya tertutup.", "Sebagian besar pertanyaan guru terbuka, dan murid memberi jawaban lebih dari satu kata atau menyertakan alasan."]}, {"no": 4, "indikator": "Guru membangun rasa ingin tahu murid.", "rubrik": ["Tidak ada murid yang bertanya, menebak, atau mencoba atas inisiatif sendiri; murid menunggu instruksi.", "Kurang dari separuh murid bertanya, menebak, atau mencoba atas inisiatif sendiri.", "Separuh hingga tiga perempat murid bertanya, menebak, atau mencoba atas inisiatif sendiri.", "Hampir semua murid (lebih dari tiga perempat) bertanya, menebak, atau mencoba atas inisiatif sendiri tanpa harus diminta berulang kali."]}, {"no": 5, "indikator": "Guru membangun konsep secara bertahap dari pengalaman konkret.", "rubrik": ["Guru langsung memberikan rumus, aturan, atau cara penyelesaian, lalu murid berlatih.", "Guru menjelaskan konsep tahap demi tahap, tetapi tanpa benda atau gambar sehingga urutannya melompat ke simbol.", "Guru menyajikan konsep dari benda atau pengalaman konkret ke simbol dengan urutan runtut, tetapi murid lebih banyak menerima penjelasan.", "Murid membangun konsep melalui pengalaman konkret, gambar/representasi, lalu simbol, dan hubungan antartahap diungkapkan murid atau dimunculkan lewat pertanyaan guru."]}, {"no": 6, "indikator": "Guru menghubungkan konsep baru dengan konsep atau pengalaman sebelumnya.", "rubrik": ["Guru tidak menghubungkan konsep dengan pembelajaran atau pengalaman sebelumnya.", "Guru menyebut keterkaitan sekilas (misalnya “kemarin kita sudah belajar”) tanpa memakainya dalam kegiatan.", "Guru menghubungkan konsep baru dengan satu konsep atau pengalaman sebelumnya secara spesifik dan memakainya dalam kegiatan.", "Guru dan murid menghubungkan konsep baru dengan beberapa konsep atau konteks lain, dan murid dapat menyebutkan keterkaitannya."]}, {"no": 7, "indikator": "Guru menggunakan media atau alat bantu untuk membantu murid memahami konsep.", "rubrik": ["Tidak ada media atau alat bantu.", "Media ada, tetapi hanya dipakai guru sebagai peraga atau tidak berkaitan dengan konsep.", "Media dipakai murid dan membantu mereka mengerjakan tugas.", "Murid memanipulasi media sendiri, dan media membantu mereka menjelaskan atau menemukan konsep."]}, {"no": 8, "indikator": "Guru menyisipkan penggunaan bahasa inggris sederhana.", "rubrik": ["Guru hampir tidak menggunakan Bahasa Inggris saat konteks memungkinkan.", "Ungkapan Bahasa Inggris digunakan sesekali, tetapi tidak konsisten atau sulit dipahami murid.", "Guru menggunakan ungkapan kelas sederhana dengan pelafalan dan dukungan yang sesuai.", "Guru menggunakan Bahasa Inggris secara konsisten dan bertahap, memanfaatkan gestur/visual serta mengecek pemahaman."]}, {"no": 9, "indikator": "Pemodelan bahasa dan pelafalan", "rubrik": ["Tidak memberi model sebelum murid diminta melakukan tugas.", "Model diberikan terbatas atau tidak jelas.", "Guru memberi contoh kosakata, ungkapan, pelafalan, atau struktur yang dibutuhkan.", "Guru memberi model jelas, memecah contoh bila perlu, lalu memberi kesempatan murid menirukan dan menggunakan secara mandiri."]}, {"no": 10, "indikator": "Siswa terlibat aktif dalam kegiatan menyimak (listening)", "rubrik": ["Tidak ada aktivitas menyimak yang relevan.", "Aktivitas menyimak singkat tanpa tujuan atau tindak lanjut jelas.", "Murid menyimak instruksi, cerita, dialog, atau audio dan menunjukkan pemahaman.", "Aktivitas menyimak bertahap; guru mengulang/menyesuaikan dukungan dan memeriksa pemahaman beragam murid."]}, {"no": 11, "indikator": "Siswa terlibat aktif dalam kegiatan berbicara (speaking)", "rubrik": ["Murid tidak diberi kesempatan berbicara selain menirukan serentak.", "Hanya sebagian kecil murid berbicara atau respons didominasi murid tertentu.", "Murid berlatih berbicara melalui tanya jawab, pasangan, permainan peran, atau kelompok.", "Lebih dari tiga perempat murid memperoleh kesempatan berbicara bermakna dan guru memantau pemerataan partisipasi."]}, {"no": 12, "indikator": "Siswa terlibat aktif dalam kegiatan membaca (reading)", "rubrik": ["Tidak ada kegiatan membaca yang sesuai tujuan.", "Membaca terbatas pada menirukan bunyi tanpa memeriksa pemahaman.", "Murid membaca kata/kalimat/teks sesuai tingkat dan menjawab pertanyaan pemahaman.", "Guru membimbing strategi membaca dan memberi dukungan kosakata serta tindak lanjut berdasarkan respons murid."]}, {"no": 13, "indikator": "Siswa diberikan kesempatan untuk menulis (writing)", "rubrik": ["Tidak ada kesempatan menulis sesuai tujuan.", "Murid menyalin tanpa memahami fungsi atau produk yang diharapkan.", "Murid menulis kata/kalimat/teks pendek sesuai tingkat dengan contoh atau kerangka.", "Murid menyusun tulisan bertahap, memperoleh umpan balik, dan memperbaiki hasil sesuai kemampuan."]}, {"no": 14, "indikator": "Aktivitas murid sesuai dengan tujuan pembelajaran.", "rubrik": ["Aktivitas yang dilakukan murid tidak mengarah pada tujuan pembelajaran.", "Sebagian aktivitas mengarah pada tujuan, tetapi aktivitas inti melenceng.", "Seluruh aktivitas mengarah pada tujuan pembelajaran.", "Seluruh aktivitas mengarah pada tujuan pembelajaran, dan guru memeriksa (melalui pertanyaan atau hasil kerja) apakah tujuan tercapai."]}, {"no": 15, "indikator": "Suasana belajar terasa menggembirakan bagi murid (tampak dari ekspresi dan perilaku murid).", "rubrik": ["Sebagian besar murid tampak pasif, tegang, atau tidak tertarik (misalnya diam, menunduk, atau melamun).", "Beberapa murid tampak senang pada bagian tertentu (permainan atau lagu), tetapi kembali pasif saat mengerjakan konsep.", "Sebagian besar murid tampak senang dan bersemangat (tersenyum, tertawa, atau bersuara antusias) selama sebagian besar kegiatan.", "Hampir semua murid tampak senang dan bersemangat sepanjang pembelajaran, termasuk saat mengerjakan tugas matematika (bukan hanya saat selingan)."]}, {"no": 16, "indikator": "Guru memberi ruang bagi beragam jawaban dan cara penyelesaian murid.", "rubrik": ["Guru mengabaikan jawaban murid atau langsung menyalahkannya.", "Guru hanya menerima satu jawaban atau satu cara yang dianggap benar.", "Guru menerima dan menanggapi beberapa jawaban atau cara yang berbeda.", "Guru mengundang jawaban dan cara yang berbeda, menampilkan beberapa di antaranya, dan membandingkannya bersama murid."]}, {"no": 17, "indikator": "Guru mengajukan pertanyaan lanjutan (probing) untuk menggali cara berpikir murid.", "rubrik": ["Guru tidak mengajukan pertanyaan lanjutan setelah murid menjawab.", "Guru mengajukan pertanyaan lanjutan 1–2 kali selama pembelajaran.", "Guru mengajukan pertanyaan lanjutan 3–4 kali, kepada murid yang berbeda.", "Guru mengajukan pertanyaan lanjutan 5 kali atau lebih, bertingkat (cara, alasan, lalu pengembangan), kepada murid yang berbeda-beda."]}, {"no": 18, "indikator": "Guru menanggapi jawaban murid secara membangun.", "rubrik": ["Guru langsung mengoreksi atau memberi jawaban benar ketika murid keliru.", "Guru memberi tanggapan umum (pujian atau “salah”) tanpa membimbing murid.", "Guru membimbing murid memperbaiki jawabannya dengan pertanyaan penuntun.", "Guru membimbing murid memperbaiki jawabannya dan memanfaatkan jawaban keliru sebagai bahan belajar bagi seluruh kelas."]}, {"no": 19, "indikator": "Guru mengakomodasi perbedaan kemampuan dan kebutuhan murid (diferensiasi).", "rubrik": ["Seluruh murid mengerjakan tugas yang sama dengan bantuan yang sama.", "Guru membantu murid tertentu hanya jika murid meminta.", "Guru secara sengaja memberi bantuan atau tantangan berbeda kepada satu kelompok murid (yang perlu bantuan atau yang cepat selesai).", "Guru secara sengaja menyesuaikan tugas, media, atau bantuan bagi murid yang perlu bantuan maupun yang perlu tantangan."]}, {"no": 20, "indikator": "Murid melakukan refleksi pembelajaran.", "rubrik": ["Tidak ada kegiatan refleksi.", "Hanya guru yang merangkum atau menilai pembelajaran.", "Kurang dari separuh murid menyampaikan apa yang dipelajari atau dirasakan.", "Sebagian besar murid menyampaikan (lisan, tulisan, atau gambar) apa yang dipelajari, bagaimana caranya, dan perasaannya."]}, {"no": 21, "indikator": "Guru mengapresiasi proses belajar murid, bukan hanya hasil.", "rubrik": ["Tidak ada apresiasi.", "Apresiasi bersifat umum (misalnya “bagus”) atau hanya untuk jawaban yang benar.", "Guru mengapresiasi usaha atau cara berpikir murid secara spesifik kepada beberapa murid.", "Guru mengapresiasi usaha dan cara berpikir murid secara spesifik kepada sedikitnya lima murid yang berbeda, termasuk murid yang belum berhasil."]}, {"no": 22, "indikator": "Guru menutup pembelajaran dengan menyimpulkan bersama murid.", "rubrik": ["Pembelajaran berakhir tanpa penutup (misalnya waktu habis).", "Guru menyampaikan kesimpulan sendiri.", "Guru menyusun kesimpulan bersama murid melalui tanya jawab.", "Guru menyusun kesimpulan bersama murid dan mengaitkannya dengan pembelajaran berikutnya atau kehidupan sehari-hari murid."]}], "kelompok": {"1": "Tahap 1: Gali dan Eksplorasi", "5": "Tahap 2: Muat Konten", "10": "Tahap 3: Buat Aktivitas", "16": "Tahap 4: Ikuti Pemikiran Murid", "20": "Tahap 5: Rayakan dan Akhiri"}, "label": "LEVEL 3 — BEHAVIOR: Penerapan Hasil Pelatihan di Kelas (Observasi Pembelajaran)", "deskripsi": "Observasi penerapan hasil pelatihan di kelas. Skor 3–4 wajib disertai bukti. Pilih TD bila indikator tidak ada kesempatan diamati dan tuliskan alasannya."}, "4": {"indikator": [{"no": 1, "indikator": "Guru menerapkan strategi hasil pelatihan", "rubrik": ["Tidak ada bukti penerapan setelah pelatihan.", "Menerapkan satu strategi pada satu kesempatan.", "Menerapkan beberapa strategi pada 2–3 kesempatan dan terdokumentasi.", "Menerapkan strategi secara konsisten pada 4 kesempatan atau lebih; ada bukti perangkat dan refleksi."]}, {"no": 2, "indikator": "Guru mengembangkan perangkat ajar", "rubrik": ["Tidak membuat/menyesuaikan perangkat ajar berdasarkan pelatihan.", "Perangkat sebagian besar menyalin contoh tanpa penyesuaian nyata.", "Perangkat disesuaikan dengan kelas, tujuan, dan kebutuhan murid.", "Membuat/mengadaptasi perangkat untuk beberapa topik, dengan asesmen dan tindak lanjut berbasis bukti."]}, {"no": 3, "indikator": "Guru berbagi praktik dengan rekan", "rubrik": ["Tidak ada kegiatan berbagi.", "Berbagi informal tanpa contoh atau dokumentasi.", "Berbagi praktik dalam KKG/komunitas belajar/rapat guru.", "Berbagi disertai demonstrasi, bahan ajar, atau observasi sejawat dan tindak lanjut."]}, {"no": 4, "indikator": "Keberanian menggunakan Bahasa Inggris", "rubrik": ["Tidak tampak perubahan dibanding kondisi awal.", "Kurang dari 50% murid yang sebelumnya pasif mulai mencoba menggunakan Bahasa Inggris.", "50–75% murid yang sebelumnya pasif mulai mencoba menggunakan Bahasa Inggris.", "Lebih dari 75% murid yang sebelumnya pasif mulai mencoba ungkapan Bahasa Inggris, termasuk saat belum yakin."]}, {"no": 5, "indikator": "Pemahaman kosakata dan ungkapan", "rubrik": ["Tidak ada bukti peningkatan dari kondisi awal.", "Kurang dari 50% murid menunjukkan peningkatan pada tugas/cek pemahaman.", "50–75% murid menunjukkan peningkatan pada tugas/cek pemahaman.", "Lebih dari 75% murid menunjukkan peningkatan yang terverifikasi melalui asesmen atau hasil kerja."]}, {"no": 6, "indikator": "Keterampilan menyimak dan merespons", "rubrik": ["Tidak ada bukti peningkatan kemampuan memahami instruksi/dialog sederhana.", "Kurang dari 50% murid menunjukkan peningkatan pemahaman/ respons.", "50–75% murid menunjukkan peningkatan pemahaman/ respons.", "Lebih dari 75% murid menunjukkan peningkatan, dibanding asesmen atau contoh kerja awal."]}, {"no": 7, "indikator": "Keterampilan berbicara/interaksi", "rubrik": ["Tidak ada bukti peningkatan berbicara atau interaksi.", "Kurang dari 50% murid meningkat dalam penggunaan kata/ungkapan lisan.", "50–75% murid meningkat dalam penggunaan ungkapan/percakapan sesuai tujuan.", "Lebih dari 75% murid meningkat dan mampu menggunakan ungkapan dalam konteks tugas/percakapan."]}, {"no": 8, "indikator": "Keterampilan membaca/menulis sesuai target", "rubrik": ["Tidak ada bukti perubahan pada tugas membaca/menulis yang diajarkan.", "Kurang dari 50% murid menunjukkan peningkatan pada tugas terkait.", "50–75% murid menunjukkan peningkatan pada tugas terkait.", "Lebih dari 75% murid menunjukkan peningkatan berdasarkan rubrik/hasil kerja yang dibandingkan."]}, {"no": 9, "indikator": "Motivasi dan sikap terhadap Bahasa Inggris", "rubrik": ["Tidak ada perubahan atau murid semakin menghindari kegiatan.", "Kurang dari 50% murid menunjukkan tanda minat/kepercayaan diri meningkat.", "50–75% murid menunjukkan minat, antusiasme, atau kesediaan mencoba yang meningkat.", "Lebih dari 75% murid menunjukkan minat/kepercayaan diri yang meningkat secara konsisten dan didukung catatan."]}, {"no": 10, "indikator": "Kolaborasi guru dalam pembelajaran Bahasa Inggris", "rubrik": ["Tidak ada diskusi/kolaborasi terkait pembelajaran Bahasa Inggris.", "Ada satu kali diskusi informal tanpa tindak lanjut.", "Ada dua kali atau lebih diskusi/berbagi bahan dan strategi pembelajaran.", "Kolaborasi terjadwal dan terdokumentasi; perangkat atau praktik diperbaiki bersama."]}, {"no": 11, "indikator": "Dukungan kepala sekolah/komunitas belajar", "rubrik": ["Tidak ada dukungan yang teridentifikasi.", "Dukungan terbatas pada persetujuan umum.", "Ada dukungan konkret seperti waktu kolaborasi, supervisi, atau akses media.", "Dukungan berkelanjutan, ditindaklanjuti, dan dimanfaatkan untuk memperbaiki pembelajaran."]}, {"no": 12, "indikator": "Pemanfaatan hasil asesmen untuk perbaikan", "rubrik": ["Hasil asesmen tidak dianalisis atau digunakan.", "Hasil asesmen dicatat tetapi tindak lanjut belum jelas.", "Guru menggunakan hasil asesmen untuk menentukan penguatan/pengayaan.", "Data awal dan lanjutan dibandingkan; keputusan pembelajaran dan perbaikannya terdokumentasi."]}], "kelompok": {"1": "A. Keberlanjutan Praktik Guru | Responden: guru (diverifikasi kepala sekolah/pengawas)", "4": "B. Perubahan pada Murid | Responden: guru (dengan bukti hasil kerja/catatan), dapat dicek oleh kepala sekolah/pengawas | Bandingkan dengan kondisi murid sebelum guru menerapkan PKGSD MBI", "10": "C. Perubahan pada Budaya Sekolah | Responden: kepala sekolah/pengawas"}, "label": "LEVEL 4 — RESULTS: Perubahan pada Guru, Murid, dan Budaya Sekolah", "deskripsi": "Bukti perubahan pada praktik guru, murid, dan budaya sekolah. Skor 3–4 wajib disertai bukti."}}

        PKGSD_JSON, true);



        $jabatan = old('jabatan_penilai', $pkgsdMbi->jabatan_penilai ?? 'Peserta PKGSD MBI');



        $identityFields = [

            ['nama_guru', 'Nama Guru', 'text', true, 'Masukkan nama guru'],

            ['nama_sekolah', 'Nama Sekolah', 'text', true, 'Masukkan nama sekolah'],

            ['kelas_fase', 'Kelas / Fase', 'text', false, 'Contoh: Kelas IV / Fase B'],

            ['topik_materi', 'Topik / Materi', 'text', false, 'Masukkan topik atau materi'],

        ];

    @endphp



    <div class="space-y-6">



        {{-- Header --}}

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <nav class="flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('instrumen.index') }}" class="hover:text-blue-600">PKGSD MBI</a>
                    <span class="text-slate-300">/</span>
                    <span class="font-medium text-slate-700">Edit Pengisian</span>

                </nav>



                <h1 class="mt-2 text-2xl font-bold text-slate-800">Edit Pengisian PKGSD MBI</h1>

                <p class="mt-1 text-sm text-slate-500">Perbarui biodata dan penilaian yang sudah tersimpan.</p>

            </div>



           <a href="{{ route('pkgsd-mbi.show', $pkgsdMbi) }}"
    class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
    Kembali ke Hasil Pengisian
</a>

        </div>



        {{-- Petunjuk dan progres --}}

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_280px]">

                <div class="border-l-4 border-blue-600 p-5 sm:p-6">

                    <h2 class="text-lg font-bold text-slate-900">Petunjuk pengisian</h2>



                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm leading-6 text-slate-600">

                        <li>Pilih skor yang deskripsinya paling sesuai dengan bukti, bukan kesan umum. Jika ragu antara dua

                            skor, pilih yang lebih rendah.</li>

                        <li>Skor 3 dan 4 sah hanya jika disertai bukti. Tanpa bukti, skor diturunkan menjadi paling tinggi

                            2.</li>

                        <li>Setiap indikator dinilai berdasarkan deskripsinya sendiri, bukan karena indikator lain bernilai

                            baik.</li>

                        <li>Proporsi murid: kurang dari separuh = &lt;50%; separuh hingga tiga perempat = 50–75%; hampir

                            semua / lebih dari tiga perempat = &gt;75%.</li>

                        <li>Kode TD (Level 3) dipakai bila indikator tidak ada kesempatan diamati. Alasan TD tidak wajib diisi. TD tidak

                            dihitung dalam rerata. Skor 1 hanya jika perilaku tidak muncul padahal ada kesempatan.</li>

                        <li>Peserta mengisi Level 1–4. Rekan sejawat dan atasan mengisi Level 3–4.</li>

                    </ul>



                    <p class="mt-3 text-xs text-slate-500">

                        Kategori rerata: 3,50–4,00 Sangat Baik; 2,75–3,49 Baik; 2,00–2,74 Cukup;

                        1,00–1,99 Perlu pendampingan intensif.

                    </p>

                </div>



                <div class="border-t border-slate-200 bg-slate-50/70 p-5 sm:p-6 lg:border-l lg:border-t-0">

                    <div class="flex items-center justify-between">

                        <span class="text-xs font-semibold text-slate-500">Progres pengisian</span>

                        <span id="pkgsd-progress-percent" class="text-xs font-bold text-blue-600">0%</span>

                    </div>



                    <div class="mt-2 h-2 overflow-hidden rounded-full bg-slate-200">

                        <div id="pkgsd-progress-bar" class="h-full rounded-full bg-blue-600 transition-all"

                            style="width:0%"></div>

                    </div>



                    <div class="mt-2 flex items-center justify-between">

                        <span id="pkgsd-progress-text" class="text-sm font-bold text-slate-900">0 / 0 butir</span>

                        <span class="text-xs text-slate-400">Penilaian</span>

                    </div>



                    <div class="mt-5 border-t border-slate-200 pt-4">

                        <p class="text-xs font-medium text-slate-500">Skor sementara</p>

                        <p id="pkgsd-score-text" class="mt-1 text-sm font-bold text-slate-900">Belum ada penilaian</p>

                    </div>

                </div>

            </div>

        </div>



        {{-- Validasi --}}

        @if ($errors->any())

            <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4">

                <p class="text-sm font-bold text-red-800">Periksa kembali isian berikut:</p>

                <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-700">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif



        <form action="{{ route('pkgsd-mbi.update', $pkgsdMbi) }}" method="POST" class="space-y-6" id="pkgsd-form">

            @csrf
            @method('PUT')



            {{-- A. Biodata --}}

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">

                    <h2 class="text-lg font-bold text-slate-800">A. Biodata</h2>

                    <p class="text-sm text-slate-500">Informasi guru dan konteks pembelajaran yang dinilai.</p>

                </div>



                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2">

                    @foreach ($identityFields as [$name, $label, $type, $required, $placeholder])

                        <div>

                            <label for="{{ $name }}" class="mb-2 block text-sm font-semibold text-slate-700">

                                {{ $label }}

                                @if ($required)

                                    <span class="text-red-500">*</span>

                                @endif

                            </label>



                            <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name, $pkgsdMbi->{$name} ?? '') }}"

                                @required($required) placeholder="{{ $placeholder }}"

                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">



                            @error($name)

                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>

                            @enderror

                        </div>

                    @endforeach

                </div>

            </section>



            {{-- B. Identitas Pemonev --}}

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">

                    <h2 class="text-lg font-bold text-slate-800">B. Identitas Pemonev</h2>

                    <p class="text-sm text-slate-500">Jabatan pemonev menentukan level yang perlu diisi.</p>

                </div>



                <div class="grid grid-cols-1 gap-4 p-5 md:grid-cols-2">

                    <div>

                        <label for="nama_petugas_monev" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Nama Petugas Monev <span class="text-red-500">*</span>

                        </label>

                        <input id="nama_petugas_monev" name="nama_petugas_monev" required

                            value="{{ old('nama_petugas_monev', $pkgsdMbi->nama_petugas_monev) }}"

                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        @error('nama_petugas_monev')

                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>

                        @enderror

                    </div>



                    <div>

                        <label for="jabatan_penilai" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Jabatan Pemonev <span class="text-red-500">*</span>

                        </label>

                        <select id="jabatan_penilai" name="jabatan_penilai" required

                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                            <option value="">-- Pilih jabatan --</option>

                            <option value="Peserta PKGSD MBI" @selected($jabatan === 'Peserta PKGSD MBI')>Peserta PKGSD MBI

                            </option>

                            <option value="Rekan sejawat" @selected($jabatan === 'Rekan sejawat')>Rekan sejawat</option>

                            <option value="Atasan langsung/Kepala Sekolah" @selected($jabatan === 'Atasan langsung/Kepala Sekolah')>Atasan langsung/Kepala Sekolah</option>

                        </select>

                        @error('jabatan_penilai')

                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>

                        @enderror

                    </div>



                    <div>

                        <label for="tanggal_monev" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Tanggal Monev <span class="text-red-500">*</span>

                        </label>

                        <input id="tanggal_monev" name="tanggal_monev" type="date" required

                            value="{{ old('tanggal_monev', $pkgsdMbi->tanggal_monev?->format('Y-m-d') ?? now()->format('Y-m-d')) }}"

                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        @error('tanggal_monev')

                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>

                        @enderror

                    </div>



                    <div>

                        <label for="sumber_data_bukti" class="mb-1.5 block text-sm font-semibold text-slate-700">

                            Sumber Data / Bukti

                        </label>

                        <textarea id="sumber_data_bukti" name="sumber_data_bukti" rows="2"

                            placeholder="Tuliskan sumber data atau dokumen pendukung"

                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('sumber_data_bukti', $pkgsdMbi->sumber_data_bukti) }}</textarea>

                        @error('sumber_data_bukti')

                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>

                        @enderror

                    </div>

                </div>

            </section>



            {{-- C. Metadata Observasi (Level 3) --}}

            <section data-pkgsd-level="3" id="pkgsd-observasi-meta"

                class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">

                    <h2 class="text-lg font-bold text-slate-800">C. Metadata Observasi (Level 3)</h2>

                </div>



                <div class="grid grid-cols-1 gap-5 p-6 md:grid-cols-2 lg:grid-cols-4">

                    <div>

                        <label for="tanggal_observasi" class="mb-2 block text-sm font-semibold text-slate-700">

                            Tanggal Observasi

                        </label>

                        <input id="tanggal_observasi" name="tanggal_observasi" type="date"

                            value="{{ old('tanggal_observasi') }}"

                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">

                    </div>



                    <div>

                        <label for="durasi_pembelajaran" class="mb-2 block text-sm font-semibold text-slate-700">

                            Durasi Pembelajaran

                        </label>

                        <input id="durasi_pembelajaran" name="durasi_pembelajaran" type="text"

                            value="{{ old('durasi_pembelajaran') }}" placeholder="Contoh: 2 x 35 menit"

                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">

                    </div>



                    <div>

                        <label for="jumlah_murid_hadir" class="mb-2 block text-sm font-semibold text-slate-700">

                            Jumlah Murid Hadir

                        </label>

                        <input id="jumlah_murid_hadir" name="jumlah_murid_hadir" type="number" min="0"

                            value="{{ old('jumlah_murid_hadir') }}"

                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">

                    </div>



                    <div>

                        <label for="observasi_ke" class="mb-2 block text-sm font-semibold text-slate-700">

                            Observasi Ke-

                        </label>

                        <input id="observasi_ke" name="observasi_ke" type="number" min="1" value="{{ old('observasi_ke') }}"

                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">

                    </div>

                </div>

            </section>



            {{-- Level 1–4 --}}

            @foreach ($levelData as $levelKey => $level)

                <section data-pkgsd-level="{{ $levelKey }}"

                    class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">

                        <h2 class="text-lg font-bold text-slate-800">{{ $level['label'] }}</h2>

                        @if (!empty($level['deskripsi']))

                            <p class="mt-1 text-sm text-slate-500">{{ $level['deskripsi'] }}</p>

                        @endif

                    </div>



                    @if ((string) $levelKey === '1')

                        {{-- LEVEL 1: FORMAT TABEL --}}

                        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

                            <p class="mb-2 text-xs font-semibold text-slate-600">Keterangan skor</p>

                            <div class="flex flex-wrap gap-2 text-xs text-slate-600">

                                @foreach (['1' => 'Kurang', '2' => 'Cukup', '3' => 'Baik', '4' => 'Sangat Baik'] as $angka => $labelSkor)

                                    <span class="rounded-lg border border-slate-200 bg-white px-3 py-2">

                                        <strong>{{ $angka }}.</strong> {{ $labelSkor }}

                                    </span>

                                @endforeach

                            </div>

                        </div>



                        <div class="overflow-x-auto">

                            <table class="w-full min-w-[760px] text-left text-sm">

                                <thead class="border-b border-slate-200 bg-slate-50 text-slate-600">

                                    <tr>

                                        <th class="w-14 px-3 py-3">No</th>

                                        <th class="px-4 py-3">Pernyataan / Indikator</th>

                                        @foreach ([1, 2, 3, 4] as $skor)

                                            <th class="w-14 px-3 py-3 text-center">{{ $skor }}</th>

                                        @endforeach

                                    </tr>

                                </thead>



                                @foreach ($level['indikator'] as $indikator)

                                    <tbody>

                                        @if (isset($level['kelompok'][(string) $indikator['no']]))

                                            <tr class="bg-blue-50">

                                                <td colspan="6" class="px-4 py-3 font-bold text-blue-900">

                                                    {{ $level['kelompok'][(string) $indikator['no']] }}

                                                </td>

                                            </tr>

                                        @endif



                                        <tr class="border-b border-slate-100">

                                            <td class="px-3 py-4 font-semibold text-slate-700">{{ $indikator['no'] }}</td>

                                            <td class="px-4 py-4 leading-6 text-slate-700">{{ $indikator['indikator'] }}</td>



                                            @foreach ([1, 2, 3, 4] as $skor)

                                                <td class="px-3 py-4 text-center align-top">

                                                    <label class="inline-flex cursor-pointer items-center justify-center">

                                                        <input type="radio" name="level_1_jawaban[{{ $indikator['no'] }}][skor]"

                                                            value="{{ $skor }}" @checked((string) old("level_1_jawaban.{$indikator['no']}.skor", data_get($pkgsdMbi->level_1_jawaban ?? [], $indikator['no'].'.skor')) === (string) $skor)

                                                            class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"

                                                            title="Skor {{ $skor }} — {{ $indikator['rubrik'][$skor - 1] }}"

                                                            aria-label="Skor {{ $skor }} — {{ $indikator['rubrik'][$skor - 1] }}">

                                                    </label>

                                                </td>

                                            @endforeach

                                        </tr>

                                    </tbody>

                                @endforeach

                            </table>

                        </div>
                    @else
                        {{-- LEVEL 2–4: FORMAT KARTU DENGAN DESKRIPSI RUBRIK --}}
                        <div class="divide-y divide-slate-100">
                            @foreach ($level['indikator'] as $indikator)
                                @php $no = $indikator['no']; @endphp
                                @if (isset($level['kelompok'][(string) $no]))

                                    <div class="bg-blue-50 px-5 py-3 text-sm font-bold text-blue-900">

                                        {{ $level['kelompok'][(string) $no] }}

                                    </div>

                                @endif



                                <div class="p-5 sm:p-6" data-pkgsd-item>

                                    <div class="mb-4">

                                        <p class="text-xs font-bold uppercase tracking-wide text-slate-400">

                                            Indikator {{ $no }}

                                        </p>

                                        <p class="mt-1 text-sm font-semibold leading-6 text-slate-800">

                                            {{ $indikator['indikator'] }}

                                        </p>

                                    </div>



                                    <div class="grid grid-cols-1 gap-3 md:grid-cols-2">

                                        @foreach ($indikator['rubrik'] as $idx => $rubrik)

                                            <label

                                                class="flex cursor-pointer items-start gap-3 rounded-xl border border-slate-200 p-4 transition hover:border-blue-300 hover:bg-blue-50 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50">

                                                <input type="radio" name="level_{{ $levelKey }}_jawaban[{{ $no }}][skor]"

                                                    value="{{ $idx + 1 }}" @checked((string) old("level_{$levelKey}_jawaban.{$no}.skor", data_get($pkgsdMbi->{"level_{$levelKey}_jawaban"} ?? [], $no.'.skor')) === (string) ($idx + 1))

                                                    class="mt-1 h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500">

                                                <span class="text-sm leading-6 text-slate-700">

                                                    <strong class="block text-slate-900">Skor {{ $idx + 1 }}</strong>

                                                    {{ $rubrik }}

                                                </span>

                                            </label>

                                        @endforeach



                                        @if ((string) $levelKey === '3')

                                            <label

                                                class="flex cursor-pointer items-start gap-3 rounded-xl border border-dashed border-slate-300 p-4 transition hover:border-amber-300 hover:bg-amber-50 has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50 md:col-span-2">

                                                <input type="radio" name="level_3_jawaban[{{ $no }}][skor]" value="TD"

                                                    @checked(old("level_3_jawaban.{$no}.skor", data_get($pkgsdMbi->level_3_jawaban ?? [], $no.'.skor')) === 'TD')

                                                    class="mt-1 h-4 w-4 shrink-0 text-amber-600 focus:ring-amber-500">

                                                <span class="text-sm leading-6 text-slate-700">

                                                    <strong class="block text-slate-900">TD</strong>

                                                    Tidak ada kesempatan diamati (tidak dihitung dalam rerata; alasan bersifat opsional).

                                                </span>

                                            </label>

                                        @endif

                                    </div>



                                    {{-- Bukti --}}

                                    @if (in_array((string) $levelKey, ['3', '4']))

                                        <div class="mt-4 grid grid-cols-1 gap-3 md:grid-cols-2">

                                            <div>

                                                <label class="mb-1 block text-xs font-semibold text-slate-600">

                                                    {{ $levelKey === '3' ? 'Bukti / catatan observasi' : 'Bukti yang dilampirkan' }}

                                                </label>

                                                <textarea data-pkgsd-evidence="{{ $levelKey }}-{{ $no }}"
                                                    name="level_{{ $levelKey }}_jawaban[{{ $no }}][bukti]" rows="2"
                                                    placeholder="{{ $levelKey === '3' ? 'Catatan hasil observasi (wajib untuk skor 3–4)' : 'RPP, jurnal, foto, hasil kerja murid, notulen, atau catatan supervisi (wajib untuk skor 3–4)' }}"
                                                    class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old("level_{$levelKey}_jawaban.{$no}.bukti", data_get($pkgsdMbi->{"level_{$levelKey}_jawaban"} ?? [], $no.'.bukti')) }}</textarea>
                                                @error("level_{$levelKey}_jawaban.{$no}.bukti")
                                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                                @enderror

                                            </div>



                                            @if ((string) $levelKey === '3')

                                                <div class="td-reason" data-reason-for="{{ $no }}" hidden>

                                                    <label class="mb-1 block text-xs font-semibold text-slate-600">

                                                        Alasan TD (opsional)

                                                    </label>

                                                    <textarea name="level_3_jawaban[{{ $no }}][alasan_td]" rows="2"

                                                        placeholder="Jelaskan mengapa indikator tidak dapat diamati"

                                                        class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old("level_3_jawaban.{$no}.alasan_td", data_get($pkgsdMbi->level_3_jawaban ?? [], $no.'.alasan_td')) }}</textarea>

                                                </div>

                                            @endif

                                        </div>

                                    @endif

                                </div>

                            @endforeach

                        </div>

                    @endif

                </section>

            @endforeach



            {{-- Tombol aksi --}}

            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a href="{{ route('pkgsd-mbi.index') }}"

                    class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">

                    Batal

                </a>

                <button type="submit"

                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>



    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const role = document.getElementById('jabatan_penilai');

            const form = document.getElementById('pkgsd-form');

            const levelCards = document.querySelectorAll('[data-pkgsd-level]');



            function updateForm() {

                const allLevels = role.value === 'Peserta PKGSD MBI';



                levelCards.forEach(card => {

                    const level = card.dataset.pkgsdLevel;

                    const active = allLevels || level === '3' || level === '4';



                    card.hidden = !active;



                    card.querySelectorAll('input, textarea, select').forEach(el => {

                        el.disabled = !active;



                        if (!active && el.type === 'radio') {

                            el.checked = false;

                        }

                    });

                });



                updateTD();

                updateProgress();

            }



            function updateTD() {
                // Bukti wajib ketika skor Level 3 atau Level 4 adalah 3/4.
                ['3', '4'].forEach(level => {
                    document.querySelectorAll('[data-pkgsd-level="' + level + '"] [data-pkgsd-item]').forEach(item => {
                        const checkedScore = item.querySelector('input[type="radio"][name*="[skor]"]:checked');
                        const evidence = item.querySelector('[data-pkgsd-evidence]');
                        if (evidence) {
                            const needsEvidence = !!checkedScore && ['3', '4'].includes(checkedScore.value);
                            evidence.required = needsEvidence;
                            evidence.setAttribute('aria-required', needsEvidence ? 'true' : 'false');
                        }
                    });
                });

                document.querySelectorAll('.td-reason').forEach(box => {
                    const nomor = box.dataset.reasonFor;
                    const card = box.closest('[data-pkgsd-level]');
                    const checked = form.querySelector(
                        'input[type="radio"][name="level_3_jawaban[' + nomor + '][skor]"]:checked'
                    );
                    const show = !!checked && checked.value === 'TD' && !card.hidden;
                    const textarea = box.querySelector('textarea');
                    box.hidden = !show;
                    textarea.disabled = !show;
                    textarea.required = false;
                });
            }

            function updateProgress() {

                const activeRadios = [...form.querySelectorAll('input[type="radio"][name*="_jawaban"]')]

                    .filter(el => !el.disabled);



                const names = [...new Set(activeRadios.map(el => el.name))];

                const checked = names.filter(name =>

                    form.querySelector('input[type="radio"][name="' + CSS.escape(name) + '"]:checked')

                );



                let totalScore = 0;

                let scoreCount = 0;



                checked.forEach(name => {

                    const el = form.querySelector('input[type="radio"][name="' + CSS.escape(name) + '"]:checked');



                    if (el.value !== 'TD') {

                        totalScore += Number(el.value);

                        scoreCount++;

                    }

                });



                const percent = names.length ? Math.round(checked.length / names.length * 100) : 0;



                document.getElementById('pkgsd-progress-percent').textContent = percent + '%';

                document.getElementById('pkgsd-progress-bar').style.width = percent + '%';

                document.getElementById('pkgsd-progress-text').textContent = checked.length + ' / ' + names.length + ' butir';

                document.getElementById('pkgsd-score-text').textContent = scoreCount

                    ? totalScore + ' poin dari ' + scoreCount + ' indikator berskor'

                    : 'Belum ada penilaian';

            }



            role.addEventListener('change', updateForm);

            form.querySelectorAll('input[type="radio"]').forEach(el => {

                el.addEventListener('change', function () {

                    updateTD();

                    updateProgress();

                });

            });



            updateForm();

        });

    </script>

@endsection