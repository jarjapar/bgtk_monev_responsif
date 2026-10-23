@extends('layouts.app')

@section('title', 'Pengisian Instrumen Matematika GEMBIRA')
@section('page-title', 'Pengisian Instrumen Matematika GEMBIRA')

@section('content')
    @php
        $levelData = json_decode(<<<'GEMBIRA_JSON'
{"1":{"label":"LEVEL 1 – REACTION","deskripsi":"","indikator":[{"no":1,"indikator":"Kesesuaian program kegiatan dengan tujuan pelatihan","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":2,"indikator":"Kesesuain bahan ajar dengan struktur program","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":3,"indikator":"Kesesuaian alokasi materi dengan bobot materi","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":4,"indikator":"Relevansi materi dengan kebutuhan peserta  pelatihan dalam mendukung pelaksanaan tugas pendidik","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":5,"indikator":"Manfaat materi pelatihan dalam meningkatkan kompetensi peserta","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":6,"indikator":"Kesiapan dan ketersediaan sarana kegiatan [audio visual, LCD/laptop, papan putih, pelantang, spidol, penghapus].","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":7,"indikator":"Kenyamanan ruang kegiatan [ventilasi udara/AC, pencahayaan].","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":8,"indikator":"Kebersihan ruang kelas.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":9,"indikator":"Ketersediaan sarana ibadah.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":10,"indikator":"Ketersediaan akses internet","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":11,"indikator":"Fasilitator memfasilitasi dan mendampingi proses pembelajaran peserta.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":12,"indikator":"Fasilitator  menggunakan bahasa yang menghargai dan menghormati di dalam berkomunikasi dengan peserta.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":13,"indikator":"Fasilitator  memulai dan mengakhiri pembelajaran tepat waktu.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":14,"indikator":"Fasilitator   mampu menyampaikan materi dengan jelas dan tepat, sehingga peserta dapat memahami pembelajaran dengan baik.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":15,"indikator":"Kemudahan dalam mengakses LMS Pembelajaran","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":16,"indikator":"Kemudahan dalam membaca materi/video yang ada di LMS","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":17,"indikator":"Kemudahan dalam mengikuti alur LMS","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":18,"indikator":"Kemudahan dalam pembelajaran di LMS","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":19,"indikator":"Kemudahan dalam berdiskusi di LMS","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":20,"indikator":"Kemudahan dalam mengumpulkan tugas di LMS","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":21,"indikator":"Kelengkapan dokumen/kit bahan kegiatan [materi, LMS, ATK]","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":22,"indikator":"Kualitas tampilan bahan tayang kegiatan.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":23,"indikator":"Keterbacaan materi dan bahan tayang kegiatan.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":24,"indikator":"Ketersediaan ilustrasi dan contoh pada bahan pembelajaran kegiatan.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":25,"indikator":"Kesesuaian alokasi waktu pelaksanaan kegiatan dengan tujuan dan sasaran program kegiatan.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":26,"indikator":"Ketepatan alokasi waktu untuk menyelesaikan setiap tagihan pembelajaran.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":27,"indikator":"Kecukupan menu yang mendukung pemenuhan gizi.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":28,"indikator":"Variasi hidangan/konsumsi.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":29,"indikator":"Ketepatan waktu penyediaan konsumsi.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]}],"kelompok":{"1":"Program dan Materi","6":"Sarana dan Prasarana Penunjang Kegiatan","11":"Fasilitator","15":"Akses LMS","21":"Bahan Kegiatan","25":"Jangka Waktu Pelaksanaan Kegiatan","27":"Layanan Menu"}},"2":{"label":"LEVEL 2 — LEARNING: Kemampuan Guru Merancang Pembelajaran (Review RPP)","deskripsi":"Penilai membaca RPP yang disusun guru setelah mengikuti kegiatan, lalu menilai setiap indikator dengan rubrik 1–4. Kolom Bukti diisi nomor halaman atau kutipan singkat dari RPP.","indikator":[{"no":1,"indikator":"RPP memuat kegiatan yang menggali pengetahuan dan pengalaman awal murid sebelum konsep baru diperkenalkan.","rubrik":["Tidak ada kegiatan menggali pengetahuan awal; pembelajaran langsung dimulai dengan materi baru.","Ada kegiatan pembuka, tetapi bersifat umum (misalnya “apakah kalian masih ingat pelajaran kemarin?”) dan tidak menggali kemampuan matematika yang relevan.","Ada kegiatan yang menggali pengetahuan awal yang relevan dengan konsep, menggunakan satu cara (pertanyaan atau aktivitas konkret).","Ada kegiatan menggali pengetahuan awal dengan lebih dari satu cara (pertanyaan dan aktivitas konkret) serta rencana tindak lanjut jika pengetahuan awal murid berbeda-beda."]},{"no":2,"indikator":"RPP menggunakan konteks nyata yang dekat dengan kehidupan murid.","rubrik":["Tidak ada konteks; soal dan kegiatan hanya berupa angka atau simbol.","Ada konteks, tetapi jauh dari pengalaman murid atau hanya berfungsi sebagai hiasan cerita yang tidak diperlukan untuk memahami konsep.","Ada konteks nyata yang relevan dengan pengalaman murid dan digunakan dalam kegiatan inti.","Konteks sangat dekat dengan kehidupan murid (termasuk lingkungan atau budaya setempat), digunakan sepanjang pembelajaran, dan menjadi dasar murid membangun konsep."]},{"no":3,"indikator":"RPP memuat pertanyaan pemantik yang dituliskan dengan jelas.","rubrik":["Tidak ada pertanyaan pemantik.","Pertanyaan pemantik ada, tetapi tertutup (jawabannya benar/salah atau satu kata) sehingga tidak mendorong murid berpikir.","Ada pertanyaan pemantik terbuka yang relevan dengan tujuan pembelajaran, tetapi belum disertai perkiraan jawaban murid atau pertanyaan lanjutan.","Ada pertanyaan pemantik terbuka yang relevan, disertai perkiraan jawaban murid dan pertanyaan lanjutan untuk memperdalam berpikir."]},{"no":4,"indikator":"RPP memuat kegiatan pembuka yang dirancang untuk memunculkan rasa ingin tahu murid.","rubrik":["Tidak ada kegiatan yang dirancang memancing rasa ingin tahu; pembuka hanya berupa penyampaian tujuan atau materi.","Ada pembuka yang menarik (cerita, benda, atau gambar), tetapi tidak berkaitan dengan konsep yang akan dipelajari.","Ada pembuka (cerita, benda, masalah, atau teka-teki) yang berkaitan dengan konsep dan memancing murid untuk bertanya atau menebak.","Pembuka berkaitan erat dengan konsep, memancing murid bertanya atau menebak, dan terhubung langsung ke kegiatan berikutnya sehingga rasa ingin tahu dipertahankan."]},{"no":5,"indikator":"RPP menyajikan konsep secara bertahap, dari pengalaman konkret ke gambar/representasi, lalu ke simbol.","rubrik":["Konsep langsung diberikan dalam bentuk rumus, aturan, atau simbol tanpa langkah membangun konsep.","Ada penyajian bertahap, tetapi urutannya kurang runtut atau langsung melompat ke simbol tanpa pengalaman konkret.","Urutan runtut dari pengalaman konkret ke simbol, tetapi hubungan antartahap belum dijelaskan.","Urutan runtut dari konkret ke gambar/representasi lalu ke simbol, dengan hubungan antartahap dituliskan jelas (misalnya melalui pertanyaan penghubung)."]},{"no":6,"indikator":"RPP menghubungkan konsep baru dengan konsep atau pengalaman yang sudah dimiliki murid.","rubrik":["Tidak ada keterkaitan dengan konsep atau pengalaman sebelumnya.","Keterkaitan disebutkan secara umum (misalnya “mengingat kembali”) tanpa menyebut konsep yang spesifik.","Keterkaitan dengan satu konsep atau pengalaman sebelumnya disebutkan secara spesifik.","Keterkaitan dengan konsep sebelumnya dan konteks lain dituliskan secara spesifik dan digunakan dalam kegiatan (misalnya murid diminta menghubungkan)."]},{"no":7,"indikator":"RPP memuat media atau alat bantu yang membantu murid memahami konsep.","rubrik":["Tidak ada media atau alat bantu.","Media disebutkan, tetapi hanya untuk menarik perhatian atau tanpa penjelasan cara penggunaannya.","Media dijelaskan cara penggunaannya dan relevan dengan konsep.","Media dijelaskan cara penggunaannya, dapat dimanipulasi langsung oleh murid, dan jelas membantu membangun konsep."]},{"no":8,"indikator":"RPP menekankan pemahaman konsep, bukan hafalan atau prosedur semata.","rubrik":["Kegiatan hanya meminta murid menghafal fakta, rumus, atau prosedur.","Sebagian besar kegiatan berupa hafalan atau latihan prosedur; pemahaman hanya disinggung.","Kegiatan seimbang antara prosedur dan pemahaman, dengan pertanyaan “mengapa” atau “bagaimana” pada sebagian kegiatan.","Kegiatan utama meminta murid menjelaskan alasan, membandingkan, atau menunjukkan konsep dengan cara sendiri; prosedur muncul sebagai hasil pemahaman."]},{"no":9,"indikator":"Konsep, contoh, dan istilah matematika dalam RPP benar.","rubrik":["Ada kesalahan konsep matematika yang dapat menimbulkan miskonsepsi pada murid.","Ada ketidaktepatan kecil pada istilah, contoh, atau notasi, tetapi tidak menimbulkan miskonsepsi mendasar.","Konsep, contoh, istilah, dan notasi benar dan sesuai dengan fase murid.","Konsep, contoh, istilah, dan notasi benar dan sesuai dengan fase murid, serta RPP mengantisipasi miskonsepsi yang mungkin muncul."]},{"no":10,"indikator":"RPP memuat aktivitas yang membuat murid terlibat aktif (melakukan, mengamati, berbicara, atau membuat sesuatu).","rubrik":["Murid hanya mendengarkan dan mencatat.","Murid terlibat aktif hanya pada sebagian kecil kegiatan (misalnya menjawab pertanyaan guru).","Murid terlibat aktif pada kegiatan inti dengan melakukan sesuatu (menyusun, mengukur, menggambar, atau berdiskusi).","Murid terlibat aktif pada hampir seluruh kegiatan, dan peran guru direncanakan sebagai fasilitator, bukan penyampai utama."]},{"no":11,"indikator":"RPP memuat aktivitas yang mengajak murid mengeksplorasi, mencoba, atau menemukan sendiri.","rubrik":["Tidak ada eksplorasi; murid hanya mengerjakan latihan soal.","Eksplorasi sangat terbatas; langkah dan jawaban sudah ditentukan guru.","Ada kegiatan yang meminta murid mencoba atau menemukan pola/ide dengan panduan guru.","Ada tantangan terbuka yang meminta murid mencoba, membandingkan cara, dan menemukan sendiri ide atau pola dengan panduan seperlunya."]},{"no":12,"indikator":"RPP memuat aktivitas yang mendorong kerja sama murid.","rubrik":["Seluruh kegiatan dikerjakan secara individu.","Ada kerja kelompok, tetapi tugas dapat dikerjakan oleh satu orang dan tidak ada pembagian peran.","Ada kerja berpasangan atau kelompok dengan tugas yang memerlukan kerja sama.","Ada kerja kelompok dengan peran atau tugas yang jelas, dan murid berbagi serta membandingkan hasil dengan kelompok lain."]},{"no":13,"indikator":"RPP memuat aktivitas yang melatih penalaran matematis murid (menduga, menjelaskan, membandingkan, atau memberi alasan).","rubrik":["Tidak ada kegiatan yang meminta alasan atau penjelasan; murid hanya diminta jawaban akhir.","Penalaran hanya muncul sebagai pertanyaan “mengapa?” singkat tanpa kegiatan khusus.","Ada kegiatan yang meminta murid menjelaskan atau membandingkan cara penyelesaian.","Ada kegiatan yang meminta murid menduga, menjelaskan, dan membenarkan idenya menggunakan benda, gambar, atau kata-kata."]},{"no":14,"indikator":"Tugas dan aktivitas dalam RPP sesuai dengan tujuan pembelajaran.","rubrik":["Sebagian besar tugas tidak berkaitan dengan tujuan pembelajaran.","Sebagian tugas berkaitan dengan tujuan, tetapi ada tugas inti yang tidak mengarah ke tujuan.","Seluruh tugas berkaitan dengan tujuan, tetapi belum jelas bagaimana hasil tugas menunjukkan tujuan tercapai.","Seluruh tugas berkaitan dengan tujuan, dan ada indikator atau penjelasan bagaimana hasil tugas menunjukkan tujuan tercapai."]},{"no":15,"indikator":"RPP memuat unsur yang dirancang membuat belajar terasa menggembirakan (misalnya permainan, lagu, gerak, cerita, atau tantangan).","rubrik":["Tidak ada unsur yang dirancang untuk membuat belajar menyenangkan.","Ada unsur menyenangkan (misalnya permainan atau lagu), tetapi terpisah dari konsep dan hanya berfungsi sebagai selingan.","Ada unsur menyenangkan yang terkait langsung dengan konsep dan tujuan pembelajaran.","Unsur menyenangkan terintegrasi pada beberapa tahap dan menjadi sarana murid memahami konsep."]},{"no":16,"indikator":"RPP memberi ruang bagi beragam jawaban dan cara penyelesaian murid.","rubrik":["Hanya ada satu jawaban dan satu cara penyelesaian yang dianggap benar.","Kemungkinan jawaban lain disebutkan, tetapi tidak ada rencana cara menanggapinya.","RPP menyatakan murid boleh memakai cara berbeda dan mencantumkan cara menanggapinya.","RPP mencantumkan perkiraan beberapa cara atau jawaban murid (termasuk yang keliru) beserta rencana guru menanggapi masing-masing."]},{"no":17,"indikator":"RPP memuat pertanyaan lanjutan (probing) untuk menggali cara berpikir murid.","rubrik":["Tidak ada pertanyaan lanjutan.","Ada pertanyaan lanjutan yang bersifat umum (misalnya “mengapa?”) tanpa dituliskan secara konkret.","Ada beberapa pertanyaan lanjutan yang dituliskan dan relevan dengan konsep.","Ada rangkaian pertanyaan lanjutan bertingkat (cara, alasan, lalu pengembangan) yang dikaitkan dengan perkiraan jawaban murid."]},{"no":18,"indikator":"RPP merencanakan tanggapan guru yang membangun terhadap jawaban murid.","rubrik":["Tidak ada rencana tanggapan; jawaban murid langsung dinilai benar atau salah.","Tanggapan terbatas pada pujian atau koreksi langsung.","Ada rencana tanggapan yang membimbing murid memperbaiki sendiri jawabannya (misalnya pertanyaan penuntun).","Ada rencana tanggapan yang membimbing murid dan memanfaatkan jawaban keliru sebagai bahan belajar bersama."]},{"no":19,"indikator":"RPP memuat rencana diferensiasi bagi murid dengan kemampuan atau kebutuhan berbeda.","rubrik":["Tidak ada rencana diferensiasi.","Diferensiasi hanya disebut secara umum (misalnya “disesuaikan dengan kebutuhan murid”) tanpa uraian.","Ada rencana konkret untuk satu kelompok murid (yang perlu bantuan atau yang perlu tantangan).","Ada rencana konkret bagi murid yang perlu bantuan maupun yang perlu tantangan, termasuk perbedaan tugas, media, atau dukungan."]},{"no":20,"indikator":"RPP memuat kegiatan refleksi bagi murid.","rubrik":["Tidak ada kegiatan refleksi.","Refleksi dilakukan oleh guru (guru merangkum) tanpa melibatkan murid.","Ada refleksi dengan pertanyaan bagi murid (misalnya “apa yang kamu pelajari?”), tetapi bersifat umum.","Ada refleksi dengan pertanyaan spesifik yang mengajak murid menyadari apa yang dipelajari, bagaimana caranya, dan perasaannya, serta direncanakan bagaimana guru memakai hasilnya."]},{"no":21,"indikator":"RPP memuat penguatan konsep matematika di akhir pembelajaran.","rubrik":["Tidak ada penguatan konsep.","Penguatan berupa pengulangan rumus atau ringkasan guru tanpa kaitan dengan pengalaman murid.","Penguatan menegaskan konsep utama dengan merujuk pada hasil kegiatan murid.","Penguatan menegaskan konsep utama, merujuk pada hasil penemuan murid, dan meluruskan kemungkinan miskonsepsi."]},{"no":22,"indikator":"RPP memuat bentuk apresiasi terhadap proses belajar murid, bukan hanya hasil.","rubrik":["Tidak ada apresiasi.","Apresiasi bersifat umum (misalnya tepuk tangan untuk semua) atau hanya untuk jawaban yang benar.","Apresiasi ditujukan pada usaha atau cara berpikir murid.","Apresiasi ditujukan secara spesifik pada usaha dan cara berpikir murid, dengan bentuk beragam (lisan, tulisan, atau simbol) dan direncanakan untuk semua murid."]},{"no":23,"indikator":"RPP memuat penutup yang menyimpulkan pembelajaran bersama murid.","rubrik":["Tidak ada penutup.","Penutup berupa kesimpulan yang disampaikan sendiri oleh guru.","Penutup memuat kesimpulan yang disusun bersama murid (guru bertanya, murid menyimpulkan).","Penutup memuat kesimpulan yang disusun bersama murid dan mengaitkannya dengan pembelajaran berikutnya atau kehidupan sehari-hari."]}],"kelompok":{"1":"Tahap 1: Gali dan Eksplorasi","5":"Tahap 2: Muat Konten","10":"Tahap 3: Buat Aktivitas","16":"Tahap 4: Ikuti Pemikiran Murid","20":"Tahap 5: Rayakan dan Akhiri"}},"3":{"label":"LEVEL 3 — BEHAVIOR: Penerapan GEMBIRA di Kelas (Observasi Pembelajaran)","deskripsi":"","indikator":[{"no":1,"indikator":"Guru menggali pengetahuan dan pengalaman awal murid sebelum memperkenalkan konsep baru.","rubrik":["Guru langsung menyampaikan materi baru tanpa menanyakan atau mengamati pengetahuan awal murid.","Guru mengajukan satu atau dua pertanyaan umum (misalnya “masih ingat?”) lalu melanjutkan tanpa memakai jawaban murid.","Guru mengajukan beberapa pertanyaan atau memberi aktivitas yang menggali pengetahuan awal yang relevan, dan mendengarkan jawaban murid.","Guru menggali pengetahuan awal dengan lebih dari satu cara (pertanyaan dan aktivitas konkret) dan menyesuaikan kegiatan berikutnya berdasarkan jawaban murid."]},{"no":2,"indikator":"Guru menggunakan konteks nyata yang dekat dengan kehidupan murid.","rubrik":["Pembelajaran hanya memakai angka dan simbol tanpa konteks.","Konteks digunakan, tetapi tidak dikenal murid atau tidak diperlukan untuk memahami soal.","Konteks dikenal murid dan digunakan dalam kegiatan inti.","Konteks dekat dengan kehidupan murid, digunakan sepanjang pembelajaran, dan murid menyebutkan contoh dari pengalaman mereka sendiri."]},{"no":3,"indikator":"Guru mengajukan pertanyaan pemantik yang mendorong murid berpikir.","rubrik":["Guru tidak mengajukan pertanyaan yang mendorong murid berpikir.","Hampir semua pertanyaan guru bersifat tertutup (jawaban singkat benar/salah).","Guru mengajukan beberapa pertanyaan terbuka, tetapi sebagian besar pertanyaan lainnya tertutup.","Sebagian besar pertanyaan guru terbuka, dan murid memberi jawaban lebih dari satu kata atau menyertakan alasan."]},{"no":4,"indikator":"Guru membangun rasa ingin tahu murid.","rubrik":["Tidak ada murid yang bertanya, menebak, atau mencoba atas inisiatif sendiri; murid menunggu instruksi.","Kurang dari separuh murid bertanya, menebak, atau mencoba atas inisiatif sendiri.","Separuh hingga tiga perempat murid bertanya, menebak, atau mencoba atas inisiatif sendiri.","Hampir semua murid (lebih dari tiga perempat) bertanya, menebak, atau mencoba atas inisiatif sendiri tanpa harus diminta berulang kali."]},{"no":5,"indikator":"Guru membangun konsep secara bertahap dari pengalaman konkret.","rubrik":["Guru langsung memberikan rumus, aturan, atau cara penyelesaian, lalu murid berlatih.","Guru menjelaskan konsep tahap demi tahap, tetapi tanpa benda atau gambar sehingga urutannya melompat ke simbol.","Guru menyajikan konsep dari benda atau pengalaman konkret ke simbol dengan urutan runtut, tetapi murid lebih banyak menerima penjelasan.","Murid membangun konsep melalui pengalaman konkret, gambar/representasi, lalu simbol, dan hubungan antartahap diungkapkan murid atau dimunculkan lewat pertanyaan guru."]},{"no":6,"indikator":"Guru menghubungkan konsep baru dengan konsep atau pengalaman sebelumnya.","rubrik":["Guru tidak menghubungkan konsep dengan pembelajaran atau pengalaman sebelumnya.","Guru menyebut keterkaitan sekilas (misalnya “kemarin kita sudah belajar”) tanpa memakainya dalam kegiatan.","Guru menghubungkan konsep baru dengan satu konsep atau pengalaman sebelumnya secara spesifik dan memakainya dalam kegiatan.","Guru dan murid menghubungkan konsep baru dengan beberapa konsep atau konteks lain, dan murid dapat menyebutkan keterkaitannya."]},{"no":7,"indikator":"Guru menggunakan media atau alat bantu untuk membantu murid memahami konsep.","rubrik":["Tidak ada media atau alat bantu.","Media ada, tetapi hanya dipakai guru sebagai peraga atau tidak berkaitan dengan konsep.","Media dipakai murid dan membantu mereka mengerjakan tugas.","Murid memanipulasi media sendiri, dan media membantu mereka menjelaskan atau menemukan konsep."]},{"no":8,"indikator":"Guru menekankan pemahaman konsep, bukan hafalan atau prosedur semata.","rubrik":["Kegiatan didominasi menghafal fakta atau rumus dan mengulang prosedur.","Sebagian besar kegiatan berupa prosedur; pertanyaan “mengapa” hampir tidak muncul.","Kegiatan seimbang antara prosedur dan pemahaman; beberapa kali murid diminta menjelaskan alasan.","Sebagian besar kegiatan meminta murid menjelaskan, membandingkan, atau menunjukkan konsep dengan cara sendiri."]},{"no":9,"indikator":"Guru menyampaikan konsep matematika dengan benar.","rubrik":["Guru menyampaikan atau membenarkan konsep yang keliru sehingga berpotensi menimbulkan miskonsepsi.","Ada ketidaktepatan kecil pada istilah atau contoh yang tidak dikoreksi.","Konsep, istilah, dan contoh yang disampaikan guru benar.","Konsep, istilah, dan contoh benar, dan guru mengenali serta meluruskan miskonsepsi murid yang muncul."]},{"no":10,"indikator":"Murid terlibat aktif dalam kegiatan pembelajaran (melakukan, berbicara, atau membuat sesuatu).","rubrik":["Hampir sepanjang waktu murid hanya mendengarkan atau menyalin.","Kurang dari separuh murid terlibat aktif pada kegiatan inti.","Separuh hingga tiga perempat murid terlibat aktif pada kegiatan inti.","Hampir semua murid (lebih dari tiga perempat) terlibat aktif pada hampir seluruh kegiatan inti."]},{"no":11,"indikator":"Aktivitas mengajak murid mengeksplorasi, mencoba, atau menemukan sendiri.","rubrik":["Aktivitas berupa latihan soal rutin dengan langkah yang sudah ditentukan.","Ada sedikit kesempatan mencoba, tetapi langkah dan jawaban sudah diarahkan guru.","Murid mencoba dan menemukan pola atau ide dengan bimbingan guru.","Murid menyelidiki masalah terbuka, mencoba lebih dari satu cara, dan menemukan sendiri ide atau pola dengan bimbingan seperlunya."]},{"no":12,"indikator":"Murid bekerja sama dalam menyelesaikan tugas.","rubrik":["Murid bekerja sendiri sepanjang pembelajaran.","Murid duduk berkelompok, tetapi bekerja sendiri-sendiri atau hanya satu murid yang mengerjakan.","Sebagian besar murid saling berbicara dan berbagi untuk menyelesaikan tugas bersama.","Hampir semua murid berperan dalam kelompok (membagi tugas dan saling menjelaskan), dan kelompok membandingkan hasil."]},{"no":13,"indikator":"Kegiatan melatih penalaran matematis murid.","rubrik":["Murid hanya menyebut jawaban akhir.","Beberapa murid memberi alasan sederhana setelah diminta guru, tetapi tidak dikembangkan.","Sebagian besar murid yang ditanya dapat menjelaskan cara atau alasannya dengan kata-kata, gambar, atau benda.","Murid menduga, menjelaskan, dan membenarkan idenya, serta menanggapi ide teman."]},{"no":14,"indikator":"Aktivitas murid sesuai dengan tujuan pembelajaran.","rubrik":["Aktivitas yang dilakukan murid tidak mengarah pada tujuan pembelajaran.","Sebagian aktivitas mengarah pada tujuan, tetapi aktivitas inti melenceng.","Seluruh aktivitas mengarah pada tujuan pembelajaran.","Seluruh aktivitas mengarah pada tujuan pembelajaran, dan guru memeriksa (melalui pertanyaan atau hasil kerja) apakah tujuan tercapai."]},{"no":15,"indikator":"Suasana belajar terasa menggembirakan bagi murid (tampak dari ekspresi dan perilaku murid).","rubrik":["Sebagian besar murid tampak pasif, tegang, atau tidak tertarik (misalnya diam, menunduk, atau melamun).","Beberapa murid tampak senang pada bagian tertentu (permainan atau lagu), tetapi kembali pasif saat mengerjakan konsep.","Sebagian besar murid tampak senang dan bersemangat (tersenyum, tertawa, atau bersuara antusias) selama sebagian besar kegiatan.","Hampir semua murid tampak senang dan bersemangat sepanjang pembelajaran, termasuk saat mengerjakan tugas matematika (bukan hanya saat selingan)."]},{"no":16,"indikator":"Guru memberi ruang bagi beragam jawaban dan cara penyelesaian murid.","rubrik":["Guru mengabaikan jawaban murid atau langsung menyalahkannya.","Guru hanya menerima satu jawaban atau satu cara yang dianggap benar.","Guru menerima dan menanggapi beberapa jawaban atau cara yang berbeda.","Guru mengundang jawaban dan cara yang berbeda, menampilkan beberapa di antaranya, dan membandingkannya bersama murid."]},{"no":17,"indikator":"Guru mengajukan pertanyaan lanjutan (probing) untuk menggali cara berpikir murid.","rubrik":["Guru tidak mengajukan pertanyaan lanjutan setelah murid menjawab.","Guru mengajukan pertanyaan lanjutan 1–2 kali selama pembelajaran.","Guru mengajukan pertanyaan lanjutan 3–4 kali, kepada murid yang berbeda.","Guru mengajukan pertanyaan lanjutan 5 kali atau lebih, bertingkat (cara, alasan, lalu pengembangan), kepada murid yang berbeda-beda."]},{"no":18,"indikator":"Guru menanggapi jawaban murid secara membangun.","rubrik":["Guru langsung mengoreksi atau memberi jawaban benar ketika murid keliru.","Guru memberi tanggapan umum (pujian atau “salah”) tanpa membimbing murid.","Guru membimbing murid memperbaiki jawabannya dengan pertanyaan penuntun.","Guru membimbing murid memperbaiki jawabannya dan memanfaatkan jawaban keliru sebagai bahan belajar bagi seluruh kelas."]},{"no":19,"indikator":"Guru mengakomodasi perbedaan kemampuan dan kebutuhan murid (diferensiasi).","rubrik":["Seluruh murid mengerjakan tugas yang sama dengan bantuan yang sama.","Guru membantu murid tertentu hanya jika murid meminta.","Guru secara sengaja memberi bantuan atau tantangan berbeda kepada satu kelompok murid (yang perlu bantuan atau yang cepat selesai).","Guru secara sengaja menyesuaikan tugas, media, atau bantuan bagi murid yang perlu bantuan maupun yang perlu tantangan."]},{"no":20,"indikator":"Murid melakukan refleksi pembelajaran.","rubrik":["Tidak ada kegiatan refleksi.","Hanya guru yang merangkum atau menilai pembelajaran.","Kurang dari separuh murid menyampaikan apa yang dipelajari atau dirasakan.","Sebagian besar murid menyampaikan (lisan, tulisan, atau gambar) apa yang dipelajari, bagaimana caranya, dan perasaannya."]},{"no":21,"indikator":"Guru memperkuat konsep matematika di akhir pembelajaran.","rubrik":["Guru tidak menegaskan konsep utama.","Guru mengulang rumus atau ringkasan tanpa mengaitkannya dengan kegiatan murid.","Guru menegaskan konsep utama dengan merujuk pada hasil kerja murid.","Guru menegaskan konsep utama dengan merujuk pada hasil kerja murid, meluruskan miskonsepsi yang muncul, dan murid dapat menyebutkan konsep utama dengan kata-katanya sendiri."]},{"no":22,"indikator":"Guru mengapresiasi proses belajar murid, bukan hanya hasil.","rubrik":["Tidak ada apresiasi.","Apresiasi bersifat umum (misalnya “bagus”) atau hanya untuk jawaban yang benar.","Guru mengapresiasi usaha atau cara berpikir murid secara spesifik kepada beberapa murid.","Guru mengapresiasi usaha dan cara berpikir murid secara spesifik kepada sedikitnya lima murid yang berbeda, termasuk murid yang belum berhasil."]},{"no":23,"indikator":"Guru menutup pembelajaran dengan menyimpulkan bersama murid.","rubrik":["Pembelajaran berakhir tanpa penutup (misalnya waktu habis).","Guru menyampaikan kesimpulan sendiri.","Guru menyusun kesimpulan bersama murid melalui tanya jawab.","Guru menyusun kesimpulan bersama murid dan mengaitkannya dengan pembelajaran berikutnya atau kehidupan sehari-hari murid."]}],"kelompok":{"1":"Tahap 1: Gali dan Eksplorasi","5":"Tahap 2: Muat Konten","10":"Tahap 3: Buat Aktivitas","16":"Tahap 4: Ikuti Pemikiran Murid","20":"Tahap 5: Rayakan dan Akhiri"}},"4":{"label":"LEVEL 4 — RESULTS: Perubahan pada Guru, Murid, dan Budaya Sekolah","deskripsi":"","indikator":[{"no":1,"indikator":"Guru menerapkan alur pembelajaran GEMBIRA di kelasnya setelah mengikuti kegiatan.","rubrik":["Guru tidak pernah menerapkan alur GEMBIRA dalam pembelajaran.","Guru menerapkan alur GEMBIRA sebanyak 1 kali.","Guru menerapkan alur GEMBIRA sebanyak 2–3 kali.","Guru menerapkan alur GEMBIRA sebanyak 4 kali atau lebih, atau pada sebagian besar pertemuan matematika."]},{"no":2,"indikator":"Guru menyusun sendiri perangkat pembelajaran bernuansa GEMBIRA.","rubrik":["Guru tidak menyusun perangkat pembelajaran bernuansa GEMBIRA.","Guru menyusun perangkat dengan menyalin hampir seluruhnya dari contoh pelatihan.","Guru menyusun perangkat sendiri dengan menyesuaikan contoh pelatihan untuk kelas dan murid yang diajarnya.","Guru menyusun perangkat sendiri untuk materi baru yang tidak ada dalam contoh pelatihan."]},{"no":3,"indikator":"Guru membagikan praktik GEMBIRA kepada guru lain.","rubrik":["Guru tidak pernah membagikan praktik GEMBIRA kepada guru lain.","Guru bercerita tentang praktik GEMBIRA kepada rekan secara informal.","Guru membagikan praktik GEMBIRA dalam satu forum (misalnya KKG atau rapat guru).","Guru membagikan praktik GEMBIRA dalam forum dan memperagakannya kepada rekan (misalnya kelas terbuka atau saling mengamati)."]},{"no":4,"indikator":"Kemampuan numerasi murid: menyelesaikan masalah matematika kontekstual.","rubrik":["Tidak ada murid yang kini mampu menyelesaikan masalah matematika kontekstual (cerita sehari-hari atau benda nyata) yang sebelumnya sulit mereka selesaikan (tidak ada perubahan dibandingkan sebelumnya).","Kurang dari separuh murid kini mampu menyelesaikan masalah matematika kontekstual (cerita sehari-hari atau benda nyata) yang sebelumnya sulit mereka selesaikan.","Separuh hingga tiga perempat murid kini mampu menyelesaikan masalah matematika kontekstual (cerita sehari-hari atau benda nyata) yang sebelumnya sulit mereka selesaikan.","Lebih dari tiga perempat murid kini mampu menyelesaikan masalah matematika kontekstual (cerita sehari-hari atau benda nyata) yang sebelumnya sulit mereka selesaikan."]},{"no":5,"indikator":"Keaktifan murid dalam pembelajaran matematika.","rubrik":["Tidak ada murid yang kini terlibat aktif dalam pembelajaran matematika (mencoba, bertanya, menjawab, atau mengerjakan tugas tanpa harus selalu diminta) (tidak ada perubahan dibandingkan sebelumnya).","Kurang dari separuh murid kini terlibat aktif dalam pembelajaran matematika (mencoba, bertanya, menjawab, atau mengerjakan tugas tanpa harus selalu diminta).","Separuh hingga tiga perempat murid kini terlibat aktif dalam pembelajaran matematika (mencoba, bertanya, menjawab, atau mengerjakan tugas tanpa harus selalu diminta).","Lebih dari tiga perempat murid kini terlibat aktif dalam pembelajaran matematika (mencoba, bertanya, menjawab, atau mengerjakan tugas tanpa harus selalu diminta)."]},{"no":6,"indikator":"Keberanian murid menyampaikan pendapat.","rubrik":["Tidak ada murid yang kini berani menyampaikan pendapat atau jawabannya di depan teman, termasuk ketika belum yakin benar (tidak ada perubahan dibandingkan sebelumnya).","Kurang dari separuh murid kini berani menyampaikan pendapat atau jawabannya di depan teman, termasuk ketika belum yakin benar.","Separuh hingga tiga perempat murid kini berani menyampaikan pendapat atau jawabannya di depan teman, termasuk ketika belum yakin benar.","Lebih dari tiga perempat murid kini berani menyampaikan pendapat atau jawabannya di depan teman, termasuk ketika belum yakin benar."]},{"no":7,"indikator":"Kemampuan murid menjelaskan cara berpikirnya.","rubrik":["Tidak ada murid yang kini mampu menjelaskan cara berpikirnya dengan kata-kata, gambar, atau benda (tidak ada perubahan dibandingkan sebelumnya).","Kurang dari separuh murid kini mampu menjelaskan cara berpikirnya dengan kata-kata, gambar, atau benda.","Separuh hingga tiga perempat murid kini mampu menjelaskan cara berpikirnya dengan kata-kata, gambar, atau benda.","Lebih dari tiga perempat murid kini mampu menjelaskan cara berpikirnya dengan kata-kata, gambar, atau benda."]},{"no":8,"indikator":"Minat murid terhadap pembelajaran matematika.","rubrik":["Tidak ada murid yang kini menunjukkan minat yang lebih tinggi pada matematika (tampak senang, meminta kegiatan matematika lagi, atau tidak menghindarinya) (tidak ada perubahan dibandingkan sebelumnya).","Kurang dari separuh murid kini menunjukkan minat yang lebih tinggi pada matematika (tampak senang, meminta kegiatan matematika lagi, atau tidak menghindarinya).","Separuh hingga tiga perempat murid kini menunjukkan minat yang lebih tinggi pada matematika (tampak senang, meminta kegiatan matematika lagi, atau tidak menghindarinya).","Lebih dari tiga perempat murid kini menunjukkan minat yang lebih tinggi pada matematika (tampak senang, meminta kegiatan matematika lagi, atau tidak menghindarinya)."]},{"no":9,"indikator":"Guru di sekolah berdiskusi atau merencanakan pembelajaran matematika bersama (KKG, komunitas belajar, atau diskusi terjadwal).","rubrik":["Tidak ada pertemuan guru yang membahas pembelajaran matematika.","Ada 1 kali pertemuan yang membahas pembelajaran matematika.","Ada 2 kali pertemuan yang membahas pembelajaran matematika.","Ada 3 kali pertemuan atau lebih (sekitar sebulan sekali) dan terdapat daftar hadir atau catatan hasil pertemuan."]},{"no":10,"indikator":"Guru terbiasa melakukan refleksi pembelajaran.","rubrik":["Guru tidak melakukan refleksi pembelajaran.","Guru sesekali melakukan refleksi, secara individu, dan tidak terdokumentasi.","Guru melakukan refleksi secara rutin (sedikitnya sebulan sekali) dan terdokumentasi (jurnal atau catatan).","Guru melakukan refleksi secara rutin dan terdokumentasi, serta ada contoh hasil refleksi yang dipakai memperbaiki pembelajaran berikutnya."]},{"no":11,"indikator":"Pembelajaran berbasis numerasi dan berpusat pada murid mulai diterapkan oleh guru lain di sekolah.","rubrik":["Tidak ada guru di sekolah yang menerapkan pembelajaran berbasis numerasi dan berpusat pada murid.","Hanya guru peserta kegiatan yang menerapkannya.","Guru peserta dan sedikitnya satu guru lain (bukan peserta) menerapkannya.","Guru peserta dan lebih dari separuh guru kelas/matematika lain di sekolah menerapkannya, tampak pada catatan supervisi atau perangkat ajar."]}],"kelompok":{"1":"A. Keberlanjutan Praktik Guru │ Responden: guru (diverifikasi kepala sekolah/pengawas)","4":"B. Perubahan pada Murid │ Responden: guru (dengan bukti hasil kerja/catatan), dapat dicek oleh kepala sekolah/pengawas │ Bandingkan dengan kondisi murid sebelum guru menerapkan GEMBIRA","9":"C. Perubahan pada Budaya Sekolah │ Responden: kepala sekolah/pengawas"}}}
GEMBIRA_JSON, true);

        $jabatan = old('jabatan_penilai', 'Peserta Matematika GEMBIRA');

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
                    <a href="{{ route('instrumen.index') }}" class="hover:text-blue-600">Instrumen</a>
                    <span class="text-slate-300">/</span>
                    <span class="font-medium text-slate-700">Matematika GEMBIRA</span>
                </nav>

                <h1 class="mt-2 text-2xl font-bold text-slate-800">Instrumen Monitoring dan Evaluasi Matematika GEMBIRA</h1>
                <p class="mt-1 text-sm text-slate-500">Model Kirkpatrick — biodata dan penilaian Level 1–4.</p>
            </div>

            <a href="{{ route('instrumen.index') }}"
                class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
                Kembali
            </a>
        </div>

        {{-- Petunjuk dan progres --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_280px]">
                <div class="border-l-4 border-blue-600 p-5 sm:p-6">
                    <h2 class="text-lg font-bold text-slate-900">Petunjuk pengisian</h2>

                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        Pilih skor yang paling sesuai dengan bukti. Skor 3 atau 4 pada Level 2, 3, dan 4 harus
                        didukung bukti sesuai petunjuk instrumen.
                    </p>

                    <p class="mt-2 text-xs text-slate-500">
                        Kategori rerata: 3,50–4,00 Sangat Baik; 2,75–3,49 Baik; 2,00–2,74 Cukup;
                        1,00–1,99 Perlu pendampingan intensif.
                    </p>
                </div>

                <div class="border-t border-slate-200 bg-slate-50/70 p-5 sm:p-6 lg:border-l lg:border-t-0">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-500">Progres pengisian</span>
                        <span id="gembira-progress-percent" class="text-xs font-bold text-blue-600">0%</span>
                    </div>

                    <div class="mt-2 h-2 overflow-hidden rounded-full bg-slate-200">
                        <div id="gembira-progress-bar" class="h-full rounded-full bg-blue-600 transition-all"
                            style="width:0%"></div>
                    </div>

                    <div class="mt-2 flex items-center justify-between">
                        <span id="gembira-progress-text" class="text-sm font-bold text-slate-900">0 / 0 butir</span>
                        <span class="text-xs text-slate-400">Penilaian</span>
                    </div>

                    <div class="mt-5 border-t border-slate-200 pt-4">
                        <p class="text-xs font-medium text-slate-500">Skor sementara</p>
                        <p id="gembira-score-text" class="mt-1 text-sm font-bold text-slate-900">Belum ada penilaian</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Validasi --}}
        @if ($errors->any())
            <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4">
                <p class="text-sm font-bold text-red-800">Periksa kembali pengisian berikut:</p>
                <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('gembira.store') }}" method="POST" class="space-y-6" id="gembira-form">
            @csrf

            {{-- A. Identitas Guru dan Sekolah --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <h2 class="text-lg font-bold text-slate-800">A. Identitas Guru dan Sekolah</h2>
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

                            <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}"
                                value="{{ old($name) }}" @required($required)
                                placeholder="{{ $placeholder }}"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                            @error($name)
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- B. Identitas Responden dan Petugas Monev --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <h2 class="text-lg font-bold text-slate-800">B. Identitas Responden dan Petugas Monev</h2>
                    <p class="text-sm text-slate-500">Jenis responden menentukan level yang perlu diisi.</p>
                </div>

                <div class="grid grid-cols-1 gap-4 p-5 md:grid-cols-2">
                    <div>
                        <label for="nama_petugas_monev" class="mb-1.5 block text-sm font-semibold text-slate-700">
                            Nama Petugas Monev <span class="text-red-500">*</span>
                        </label>
                        <input id="nama_petugas_monev" name="nama_petugas_monev" required
                            value="{{ old('nama_petugas_monev') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                        @error('nama_petugas_monev')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jabatan_penilai" class="mb-1.5 block text-sm font-semibold text-slate-700">
                            Jabatan Penilai <span class="text-red-500">*</span>
                        </label>
                        <select id="jabatan_penilai" name="jabatan_penilai" required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                            <option value="">Pilih jabatan penilai</option>
                            <option value="Peserta Matematika GEMBIRA" @selected($jabatan === 'Peserta Matematika GEMBIRA')>
                                Peserta Matematika GEMBIRA
                            </option>
                            <option value="Rekan sejawat" @selected($jabatan === 'Rekan sejawat')>
                                Rekan sejawat
                            </option>
                            <option value="Atasan langsung/Kepala Sekolah" @selected($jabatan === 'Atasan langsung/Kepala Sekolah')>
                                Atasan langsung/Kepala Sekolah
                            </option>
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
                            value="{{ old('tanggal_monev', date('Y-m-d')) }}"
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
                            placeholder="Tuliskan sumber data atau bukti"
                            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('sumber_data_bukti') }}</textarea>
                        @error('sumber_data_bukti')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- C. Metadata Observasi (Level 3) --}}
            <section data-gembira-level="3" id="gembira-observasi-meta"
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
                        <input id="durasi_pembelajaran" name="durasi_pembelajaran"
                            value="{{ old('durasi_pembelajaran') }}"
                            placeholder="Contoh: 2 x 35 menit"
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
                        <input id="observasi_ke" name="observasi_ke" type="number" min="1"
                            value="{{ old('observasi_ke') }}"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm">
                    </div>
                </div>
            </section>

            {{-- Level 1–4 --}}
            @foreach ($levelData as $levelKey => $level)
                <section data-gembira-level="{{ $levelKey }}"
                    class="gembira-level-card overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                        <h2 class="text-lg font-bold text-slate-800">
                            {{ $level['label'] }}
                        </h2>
                        @if (!empty($level['deskripsi']))
                            <p class="mt-1 text-sm text-slate-500">
                                {{ $level['deskripsi'] }}
                            </p>
                        @endif
                    </div>

                    @if ((string) $levelKey === '1')
                        {{-- LEVEL 1: FORMAT TABEL SEPERTI TENDIK --}}
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
                                            <td class="px-3 py-4 font-semibold text-slate-700">
                                                {{ $indikator['no'] }}
                                            </td>
                                            <td class="px-4 py-4 leading-6 text-slate-700">
                                                {{ $indikator['indikator'] }}
                                                <span class="text-red-500">*</span>
                                            </td>

                                            @foreach ([1, 2, 3, 4] as $skor)
                                                <td class="px-3 py-4 text-center align-top">
                                                    <label class="inline-flex cursor-pointer items-center justify-center">
                                                        <input type="radio"
                                                            name="level_1_jawaban[{{ $indikator['no'] }}][skor]"
                                                            value="{{ $skor }}"
                                                            required
                                                            @checked(old("level_1_jawaban.{$indikator['no']}.skor") == $skor)
                                                            class="h-4 w-4 border-slate-300 text-blue-600 focus:ring-blue-500"
                                                            title="Skor {{ $skor }} — {{ $indikator['rubrik'][$skor - 1] }}"
                                                aria-label="Skor {{ $skor }}">
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
                                @if (isset($level['kelompok'][(string) $indikator['no']]))
                                    <div class="bg-blue-50 px-5 py-3 text-sm font-bold text-blue-900">
                                        {{ $level['kelompok'][(string) $indikator['no']] }}
                                    </div>
                                @endif

                                <div class="p-5 sm:p-6" data-gembira-item>
                                    <div class="mb-4">
                                        <p class="text-xs font-bold uppercase tracking-wide text-slate-400">
                                            Indikator {{ $indikator['no'] }}
                                        </p>
                                        <p class="mt-1 text-sm font-semibold leading-6 text-slate-800">
                                            {{ $indikator['indikator'] }}
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                                        @foreach ($indikator['rubrik'] as $idx => $rubrik)
                                            <label
                                                class="flex cursor-pointer items-start gap-3 rounded-xl border border-slate-200 p-4 transition hover:border-blue-300 hover:bg-blue-50">
                                                <input type="radio"
                                                    name="level_{{ $levelKey }}_jawaban[{{ $indikator['no'] }}][skor]"
                                                    value="{{ $idx + 1 }}"
                                                            required
                                                    @checked(old("level_{$levelKey}_jawaban.{$indikator['no']}.skor") == $idx + 1)
                                                    class="mt-1 h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500">
                                                <span class="text-sm leading-6 text-slate-700">
                                                    <strong class="block text-slate-900">Skor {{ $idx + 1 }}</strong>
                                                    {{ $rubrik }}
                                                </span>
                                            </label>
                                        @endforeach

                                    </div>

                                    @if (in_array((string) $levelKey, ['2', '3', '4']))
                                        <div class="mt-4 grid grid-cols-1 gap-3 md:grid-cols-2">
                                            <div>
                                                <label class="mb-1 block text-xs font-semibold text-slate-600">
                                                    {{ $levelKey === '2' ? 'Bukti dalam RPP (halaman/kutipan)' : ($levelKey === '3' ? 'Bukti / catatan observasi' : 'Bukti yang dilampirkan') }}
                                                </label>
                                                <textarea name="level_{{ $levelKey }}_jawaban[{{ $indikator['no'] }}][bukti]" rows="2"
                                                    placeholder="Tuliskan bukti pendukung"
                                                    class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old("level_{$levelKey}_jawaban.{$indikator['no']}.bukti") }}</textarea>
                                            </div>

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
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                    Simpan Pengisian
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const role = document.getElementById('jabatan_penilai');
            const form = document.getElementById('gembira-form');
            const levelCards = document.querySelectorAll('[data-gembira-level]');

            function updateForm() {
                const allLevels = role.value === 'Peserta Matematika GEMBIRA';

                levelCards.forEach(card => {
                    const level = card.dataset.gembiraLevel;
                    const active = allLevels || level === '3' || level === '4';

                    card.hidden = !active;

                    card.querySelectorAll('input, textarea, select').forEach(el => {
                        el.disabled = !active;

                        if (!active && el.type === 'radio') {
                            el.checked = false;
                        }
                    });
                });

                updateProgress();
            }

            function updateProgress() {
                const activeRadios = [...form.querySelectorAll('input[type="radio"][name*="_jawaban"]')]
                    .filter(el => !el.disabled);

                const groups = new Map();
                activeRadios.forEach(el => {
                    if (!groups.has(el.name)) {
                        groups.set(el.name, el);
                    }
                });

                const names = [...groups.keys()];
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

                document.getElementById('gembira-progress-percent').textContent = percent + '%';
                document.getElementById('gembira-progress-bar').style.width = percent + '%';
                document.getElementById('gembira-progress-text').textContent = checked.length + ' / ' + names.length + ' butir';
                document.getElementById('gembira-score-text').textContent = scoreCount
                    ? totalScore + ' poin dari ' + scoreCount + ' indikator berskor'
                    : 'Belum ada penilaian';
            }

            role.addEventListener('change', updateForm);
            form.querySelectorAll('input[type="radio"]').forEach(el => el.addEventListener('change', updateProgress));

            updateForm();
        });
    </script>
@endsection