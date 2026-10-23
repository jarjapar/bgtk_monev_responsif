@extends('layouts.app')

@section('title', 'Detail Matematika GEMBIRA')
@section('page-title', 'Detail Matematika GEMBIRA')

@section('content')
    @php
        /*
        |--------------------------------------------------------------------------
        | Data instrumen (sama dengan form create/edit)
        |--------------------------------------------------------------------------
        */
        $levelData = json_decode(<<<'GEMBIRA_JSON'
                        {"1":{"label":"LEVEL 1 – REACTION","deskripsi":"","indikator":[{"no":1,"indikator":"Kesesuaian program kegiatan dengan tujuan pelatihan","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":2,"indikator":"Kesesuain bahan ajar dengan struktur program","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":3,"indikator":"Kesesuaian alokasi materi dengan bobot materi","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":4,"indikator":"Relevansi materi dengan kebutuhan peserta  pelatihan dalam mendukung pelaksanaan tugas pendidik","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":5,"indikator":"Manfaat materi pelatihan dalam meningkatkan kompetensi peserta","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":6,"indikator":"Kesiapan dan ketersediaan sarana kegiatan [audio visual, LCD/laptop, papan putih, pelantang, spidol, penghapus].","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":7,"indikator":"Kenyamanan ruang kegiatan [ventilasi udara/AC, pencahayaan].","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":8,"indikator":"Kebersihan ruang kelas.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":9,"indikator":"Ketersediaan sarana ibadah.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":10,"indikator":"Ketersediaan akses internet","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":11,"indikator":"Fasilitator memfasilitasi dan mendampingi proses pembelajaran peserta.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":12,"indikator":"Fasilitator  menggunakan bahasa yang menghargai dan menghormati di dalam berkomunikasi dengan peserta.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":13,"indikator":"Fasilitator  memulai dan mengakhiri pembelajaran tepat waktu.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":14,"indikator":"Fasilitator   mampu menyampaikan materi dengan jelas dan tepat, sehingga peserta dapat memahami pembelajaran dengan baik.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":15,"indikator":"Kemudahan dalam mengakses LMS Pembelajaran","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":16,"indikator":"Kemudahan dalam membaca materi/video yang ada di LMS","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":17,"indikator":"Kemudahan dalam mengikuti alur LMS","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":18,"indikator":"Kemudahan dalam pembelajaran di LMS","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":19,"indikator":"Kemudahan dalam berdiskusi di LMS","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":20,"indikator":"Kemudahan dalam mengumpulkan tugas di LMS","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":21,"indikator":"Kelengkapan dokumen/kit bahan kegiatan [materi, LMS, ATK]","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":22,"indikator":"Kualitas tampilan bahan tayang kegiatan.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":23,"indikator":"Keterbacaan materi dan bahan tayang kegiatan.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":24,"indikator":"Ketersediaan ilustrasi dan contoh pada bahan pembelajaran kegiatan.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":25,"indikator":"Kesesuaian alokasi waktu pelaksanaan kegiatan dengan tujuan dan sasaran program kegiatan.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":26,"indikator":"Ketepatan alokasi waktu untuk menyelesaikan setiap tagihan pembelajaran.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":27,"indikator":"Kecukupan menu yang mendukung pemenuhan gizi.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":28,"indikator":"Variasi hidangan/konsumsi.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]},{"no":29,"indikator":"Ketepatan waktu penyediaan konsumsi.","rubrik":["Kurang","Cukup","Baik","Sangat Baik"]}],"kelompok":{"1":"Program dan Materi","6":"Sarana dan Prasarana Penunjang Kegiatan","11":"Fasilitator","15":"Akses LMS","21":"Bahan Kegiatan","25":"Jangka Waktu Pelaksanaan Kegiatan","27":"Layanan Menu"}},"2":{"label":"LEVEL 2 — LEARNING: Kemampuan Guru Merancang Pembelajaran (Review RPP)","deskripsi":"Penilai membaca RPP yang disusun guru setelah mengikuti kegiatan, lalu menilai setiap indikator dengan rubrik 1–4. Kolom Bukti diisi nomor halaman atau kutipan singkat dari RPP.","indikator":[{"no":1,"indikator":"RPP memuat kegiatan yang menggali pengetahuan dan pengalaman awal murid sebelum konsep baru diperkenalkan.","rubrik":["Tidak ada kegiatan menggali pengetahuan awal; pembelajaran langsung dimulai dengan materi baru.","Ada kegiatan pembuka, tetapi bersifat umum (misalnya “apakah kalian masih ingat pelajaran kemarin?”) dan tidak menggali kemampuan matematika yang relevan.","Ada kegiatan yang menggali pengetahuan awal yang relevan dengan konsep, menggunakan satu cara (pertanyaan atau aktivitas konkret).","Ada kegiatan menggali pengetahuan awal dengan lebih dari satu cara (pertanyaan dan aktivitas konkret) serta rencana tindak lanjut jika pengetahuan awal murid berbeda-beda."]},{"no":2,"indikator":"RPP menggunakan konteks nyata yang dekat dengan kehidupan murid.","rubrik":["Tidak ada konteks; soal dan kegiatan hanya berupa angka atau simbol.","Ada konteks, tetapi jauh dari pengalaman murid atau hanya berfungsi sebagai hiasan cerita yang tidak diperlukan untuk memahami konsep.","Ada konteks nyata yang relevan dengan pengalaman murid dan digunakan dalam kegiatan inti.","Konteks sangat dekat dengan kehidupan murid (termasuk lingkungan atau budaya setempat), digunakan sepanjang pembelajaran, dan menjadi dasar murid membangun konsep."]},{"no":3,"indikator":"RPP memuat pertanyaan pemantik yang dituliskan dengan jelas.","rubrik":["Tidak ada pertanyaan pemantik.","Pertanyaan pemantik ada, tetapi tertutup (jawabannya benar/salah atau satu kata) sehingga tidak mendorong murid berpikir.","Ada pertanyaan pemantik terbuka yang relevan dengan tujuan pembelajaran, tetapi belum disertai perkiraan jawaban murid atau pertanyaan lanjutan.","Ada pertanyaan pemantik terbuka yang relevan, disertai perkiraan jawaban murid dan pertanyaan lanjutan untuk memperdalam berpikir."]},{"no":4,"indikator":"RPP memuat kegiatan pembuka yang dirancang untuk memunculkan rasa ingin tahu murid.","rubrik":["Tidak ada kegiatan yang dirancang memancing rasa ingin tahu; pembuka hanya berupa penyampaian tujuan atau materi.","Ada pembuka yang menarik (cerita, benda, atau gambar), tetapi tidak berkaitan dengan konsep yang akan dipelajari.","Ada pembuka (cerita, benda, masalah, atau teka-teki) yang berkaitan dengan konsep dan memancing murid untuk bertanya atau menebak.","Pembuka berkaitan erat dengan konsep, memancing murid bertanya atau menebak, dan terhubung langsung ke kegiatan berikutnya sehingga rasa ingin tahu dipertahankan."]},{"no":5,"indikator":"RPP menyajikan konsep secara bertahap, dari pengalaman konkret ke gambar/representasi, lalu ke simbol.","rubrik":["Konsep langsung diberikan dalam bentuk rumus, aturan, atau simbol tanpa langkah membangun konsep.","Ada penyajian bertahap, tetapi urutannya kurang runtut atau langsung melompat ke simbol tanpa pengalaman konkret.","Urutan runtut dari pengalaman konkret ke simbol, tetapi hubungan antartahap belum dijelaskan.","Urutan runtut dari konkret ke gambar/representasi lalu ke simbol, dengan hubungan antartahap dituliskan jelas (misalnya melalui pertanyaan penghubung)."]},{"no":6,"indikator":"RPP menghubungkan konsep baru dengan konsep atau pengalaman yang sudah dimiliki murid.","rubrik":["Tidak ada keterkaitan dengan konsep atau pengalaman sebelumnya.","Keterkaitan disebutkan secara umum (misalnya “mengingat kembali”) tanpa menyebut konsep yang spesifik.","Keterkaitan dengan satu konsep atau pengalaman sebelumnya disebutkan secara spesifik.","Keterkaitan dengan konsep sebelumnya dan konteks lain dituliskan secara spesifik dan digunakan dalam kegiatan (misalnya murid diminta menghubungkan)."]},{"no":7,"indikator":"RPP memuat media atau alat bantu yang membantu murid memahami konsep.","rubrik":["Tidak ada media atau alat bantu.","Media disebutkan, tetapi hanya untuk menarik perhatian atau tanpa penjelasan cara penggunaannya.","Media dijelaskan cara penggunaannya dan relevan dengan konsep.","Media dijelaskan cara penggunaannya, dapat dimanipulasi langsung oleh murid, dan jelas membantu membangun konsep."]},{"no":8,"indikator":"RPP menekankan pemahaman konsep, bukan hafalan atau prosedur semata.","rubrik":["Kegiatan hanya meminta murid menghafal fakta, rumus, atau prosedur.","Sebagian besar kegiatan berupa hafalan atau latihan prosedur; pemahaman hanya disinggung.","Kegiatan seimbang antara prosedur dan pemahaman, dengan pertanyaan “mengapa” atau “bagaimana” pada sebagian kegiatan.","Kegiatan utama meminta murid menjelaskan alasan, membandingkan, atau menunjukkan konsep dengan cara sendiri; prosedur muncul sebagai hasil pemahaman."]},{"no":9,"indikator":"Konsep, contoh, dan istilah matematika dalam RPP benar.","rubrik":["Ada kesalahan konsep matematika yang dapat menimbulkan miskonsepsi pada murid.","Ada ketidaktepatan kecil pada istilah, contoh, atau notasi, tetapi tidak menimbulkan miskonsepsi mendasar.","Konsep, contoh, istilah, dan notasi benar dan sesuai dengan fase murid.","Konsep, contoh, istilah, dan notasi benar dan sesuai dengan fase murid, serta RPP mengantisipasi miskonsepsi yang mungkin muncul."]},{"no":10,"indikator":"RPP memuat aktivitas yang membuat murid terlibat aktif (melakukan, mengamati, berbicara, atau membuat sesuatu).","rubrik":["Murid hanya mendengarkan dan mencatat.","Murid terlibat aktif hanya pada sebagian kecil kegiatan (misalnya menjawab pertanyaan guru).","Murid terlibat aktif pada kegiatan inti dengan melakukan sesuatu (menyusun, mengukur, menggambar, atau berdiskusi).","Murid terlibat aktif pada hampir seluruh kegiatan, dan peran guru direncanakan sebagai fasilitator, bukan penyampai utama."]},{"no":11,"indikator":"RPP memuat aktivitas yang mengajak murid mengeksplorasi, mencoba, atau menemukan sendiri.","rubrik":["Tidak ada eksplorasi; murid hanya mengerjakan latihan soal.","Eksplorasi sangat terbatas; langkah dan jawaban sudah ditentukan guru.","Ada kegiatan yang meminta murid mencoba atau menemukan pola/ide dengan panduan guru.","Ada tantangan terbuka yang meminta murid mencoba, membandingkan cara, dan menemukan sendiri ide atau pola dengan panduan seperlunya."]},{"no":12,"indikator":"RPP memuat aktivitas yang mendorong kerja sama murid.","rubrik":["Seluruh kegiatan dikerjakan secara individu.","Ada kerja kelompok, tetapi tugas dapat dikerjakan oleh satu orang dan tidak ada pembagian peran.","Ada kerja berpasangan atau kelompok dengan tugas yang memerlukan kerja sama.","Ada kerja kelompok dengan peran atau tugas yang jelas, dan murid berbagi serta membandingkan hasil dengan kelompok lain."]},{"no":13,"indikator":"RPP memuat aktivitas yang melatih penalaran matematis murid (menduga, menjelaskan, membandingkan, atau memberi alasan).","rubrik":["Tidak ada kegiatan yang meminta alasan atau penjelasan; murid hanya diminta jawaban akhir.","Penalaran hanya muncul sebagai pertanyaan “mengapa?” singkat tanpa kegiatan khusus.","Ada kegiatan yang meminta murid menjelaskan atau membandingkan cara penyelesaian.","Ada kegiatan yang meminta murid menduga, menjelaskan, dan membenarkan idenya menggunakan benda, gambar, atau kata-kata."]},{"no":14,"indikator":"Tugas dan aktivitas dalam RPP sesuai dengan tujuan pembelajaran.","rubrik":["Sebagian besar tugas tidak berkaitan dengan tujuan pembelajaran.","Sebagian tugas berkaitan dengan tujuan, tetapi ada tugas inti yang tidak mengarah ke tujuan.","Seluruh tugas berkaitan dengan tujuan, tetapi belum jelas bagaimana hasil tugas menunjukkan tujuan tercapai.","Seluruh tugas berkaitan dengan tujuan, dan ada indikator atau penjelasan bagaimana hasil tugas menunjukkan tujuan tercapai."]},{"no":15,"indikator":"RPP memuat unsur yang dirancang membuat belajar terasa menggembirakan (misalnya permainan, lagu, gerak, cerita, atau tantangan).","rubrik":["Tidak ada unsur yang dirancang untuk membuat belajar menyenangkan.","Ada unsur menyenangkan (misalnya permainan atau lagu), tetapi terpisah dari konsep dan hanya berfungsi sebagai selingan.","Ada unsur menyenangkan yang terkait langsung dengan konsep dan tujuan pembelajaran.","Unsur menyenangkan terintegrasi pada beberapa tahap dan menjadi sarana murid memahami konsep."]},{"no":16,"indikator":"RPP memberi ruang bagi beragam jawaban dan cara penyelesaian murid.","rubrik":["Hanya ada satu jawaban dan satu cara penyelesaian yang dianggap benar.","Kemungkinan jawaban lain disebutkan, tetapi tidak ada rencana cara menanggapinya.","RPP menyatakan murid boleh memakai cara berbeda dan mencantumkan cara menanggapinya.","RPP mencantumkan perkiraan beberapa cara atau jawaban murid (termasuk yang keliru) beserta rencana guru menanggapi masing-masing."]},{"no":17,"indikator":"RPP memuat pertanyaan lanjutan (probing) untuk menggali cara berpikir murid.","rubrik":["Tidak ada pertanyaan lanjutan.","Ada pertanyaan lanjutan yang bersifat umum (misalnya “mengapa?”) tanpa dituliskan secara konkret.","Ada beberapa pertanyaan lanjutan yang dituliskan dan relevan dengan konsep.","Ada rangkaian pertanyaan lanjutan bertingkat (cara, alasan, lalu pengembangan) yang dikaitkan dengan perkiraan jawaban murid."]},{"no":18,"indikator":"RPP merencanakan tanggapan guru yang membangun terhadap jawaban murid.","rubrik":["Tidak ada rencana tanggapan; jawaban murid langsung dinilai benar atau salah.","Tanggapan terbatas pada pujian atau koreksi langsung.","Ada rencana tanggapan yang membimbing murid memperbaiki sendiri jawabannya (misalnya pertanyaan penuntun).","Ada rencana tanggapan yang membimbing murid dan memanfaatkan jawaban keliru sebagai bahan belajar bersama."]},{"no":19,"indikator":"RPP memuat rencana diferensiasi bagi murid dengan kemampuan atau kebutuhan berbeda.","rubrik":["Tidak ada rencana diferensiasi.","Diferensiasi hanya disebut secara umum (misalnya “disesuaikan dengan kebutuhan murid”) tanpa uraian.","Ada rencana konkret untuk satu kelompok murid (yang perlu bantuan atau yang perlu tantangan).","Ada rencana konkret bagi murid yang perlu bantuan maupun yang perlu tantangan, termasuk perbedaan tugas, media, atau dukungan."]},{"no":20,"indikator":"RPP memuat kegiatan refleksi bagi murid.","rubrik":["Tidak ada kegiatan refleksi.","Refleksi dilakukan oleh guru (guru merangkum) tanpa melibatkan murid.","Ada refleksi dengan pertanyaan bagi murid (misalnya “apa yang kamu pelajari?”), tetapi bersifat umum.","Ada refleksi dengan pertanyaan spesifik yang mengajak murid menyadari apa yang dipelajari, bagaimana caranya, dan perasaannya, serta direncanakan bagaimana guru memakai hasilnya."]},{"no":21,"indikator":"RPP memuat penguatan konsep matematika di akhir pembelajaran.","rubrik":["Tidak ada penguatan konsep.","Penguatan berupa pengulangan rumus atau ringkasan guru tanpa kaitan dengan pengalaman murid.","Penguatan menegaskan konsep utama dengan merujuk pada hasil kegiatan murid.","Penguatan menegaskan konsep utama, merujuk pada hasil penemuan murid, dan meluruskan kemungkinan miskonsepsi."]},{"no":22,"indikator":"RPP memuat bentuk apresiasi terhadap proses belajar murid, bukan hanya hasil.","rubrik":["Tidak ada apresiasi.","Apresiasi bersifat umum (misalnya tepuk tangan untuk semua) atau hanya untuk jawaban yang benar.","Apresiasi ditujukan pada usaha atau cara berpikir murid.","Apresiasi ditujukan secara spesifik pada usaha dan cara berpikir murid, dengan bentuk beragam (lisan, tulisan, atau simbol) dan direncanakan untuk semua murid."]},{"no":23,"indikator":"RPP memuat penutup yang menyimpulkan pembelajaran bersama murid.","rubrik":["Tidak ada penutup.","Penutup berupa kesimpulan yang disampaikan sendiri oleh guru.","Penutup memuat kesimpulan yang disusun bersama murid (guru bertanya, murid menyimpulkan).","Penutup memuat kesimpulan yang disusun bersama murid dan mengaitkannya dengan pembelajaran berikutnya atau kehidupan sehari-hari."]}],"kelompok":{"1":"Tahap 1: Gali dan Eksplorasi","5":"Tahap 2: Muat Konten","10":"Tahap 3: Buat Aktivitas","16":"Tahap 4: Ikuti Pemikiran Murid","20":"Tahap 5: Rayakan dan Akhiri"}},"3":{"label":"LEVEL 3 — BEHAVIOR: Penerapan GEMBIRA di Kelas (Observasi Pembelajaran)","deskripsi":"","indikator":[{"no":1,"indikator":"Guru menggali pengetahuan dan pengalaman awal murid sebelum memperkenalkan konsep baru.","rubrik":["Guru langsung menyampaikan materi baru tanpa menanyakan atau mengamati pengetahuan awal murid.","Guru mengajukan satu atau dua pertanyaan umum (misalnya “masih ingat?”) lalu melanjutkan tanpa memakai jawaban murid.","Guru mengajukan beberapa pertanyaan atau memberi aktivitas yang menggali pengetahuan awal yang relevan, dan mendengarkan jawaban murid.","Guru menggali pengetahuan awal dengan lebih dari satu cara (pertanyaan dan aktivitas konkret) dan menyesuaikan kegiatan berikutnya berdasarkan jawaban murid."]},{"no":2,"indikator":"Guru menggunakan konteks nyata yang dekat dengan kehidupan murid.","rubrik":["Pembelajaran hanya memakai angka dan simbol tanpa konteks.","Konteks digunakan, tetapi tidak dikenal murid atau tidak diperlukan untuk memahami soal.","Konteks dikenal murid dan digunakan dalam kegiatan inti.","Konteks dekat dengan kehidupan murid, digunakan sepanjang pembelajaran, dan murid menyebutkan contoh dari pengalaman mereka sendiri."]},{"no":3,"indikator":"Guru mengajukan pertanyaan pemantik yang mendorong murid berpikir.","rubrik":["Guru tidak mengajukan pertanyaan yang mendorong murid berpikir.","Hampir semua pertanyaan guru bersifat tertutup (jawaban singkat benar/salah).","Guru mengajukan beberapa pertanyaan terbuka, tetapi sebagian besar pertanyaan lainnya tertutup.","Sebagian besar pertanyaan guru terbuka, dan murid memberi jawaban lebih dari satu kata atau menyertakan alasan."]},{"no":4,"indikator":"Guru membangun rasa ingin tahu murid.","rubrik":["Tidak ada murid yang bertanya, menebak, atau mencoba atas inisiatif sendiri; murid menunggu instruksi.","Kurang dari separuh murid bertanya, menebak, atau mencoba atas inisiatif sendiri.","Separuh hingga tiga perempat murid bertanya, menebak, atau mencoba atas inisiatif sendiri.","Hampir semua murid (lebih dari tiga perempat) bertanya, menebak, atau mencoba atas inisiatif sendiri tanpa harus diminta berulang kali."]},{"no":5,"indikator":"Guru membangun konsep secara bertahap dari pengalaman konkret.","rubrik":["Guru langsung memberikan rumus, aturan, atau cara penyelesaian, lalu murid berlatih.","Guru menjelaskan konsep tahap demi tahap, tetapi tanpa benda atau gambar sehingga urutannya melompat ke simbol.","Guru menyajikan konsep dari benda atau pengalaman konkret ke simbol dengan urutan runtut, tetapi murid lebih banyak menerima penjelasan.","Murid membangun konsep melalui pengalaman konkret, gambar/representasi, lalu simbol, dan hubungan antartahap diungkapkan murid atau dimunculkan lewat pertanyaan guru."]},{"no":6,"indikator":"Guru menghubungkan konsep baru dengan konsep atau pengalaman sebelumnya.","rubrik":["Guru tidak menghubungkan konsep dengan pembelajaran atau pengalaman sebelumnya.","Guru menyebut keterkaitan sekilas (misalnya “kemarin kita sudah belajar”) tanpa memakainya dalam kegiatan.","Guru menghubungkan konsep baru dengan satu konsep atau pengalaman sebelumnya secara spesifik dan memakainya dalam kegiatan.","Guru dan murid menghubungkan konsep baru dengan beberapa konsep atau konteks lain, dan murid dapat menyebutkan keterkaitannya."]},{"no":7,"indikator":"Guru menggunakan media atau alat bantu untuk membantu murid memahami konsep.","rubrik":["Tidak ada media atau alat bantu.","Media ada, tetapi hanya dipakai guru sebagai peraga atau tidak berkaitan dengan konsep.","Media dipakai murid dan membantu mereka mengerjakan tugas.","Murid memanipulasi media sendiri, dan media membantu mereka menjelaskan atau menemukan konsep."]},{"no":8,"indikator":"Guru menekankan pemahaman konsep, bukan hafalan atau prosedur semata.","rubrik":["Kegiatan didominasi menghafal fakta atau rumus dan mengulang prosedur.","Sebagian besar kegiatan berupa prosedur; pertanyaan “mengapa” hampir tidak muncul.","Kegiatan seimbang antara prosedur dan pemahaman; beberapa kali murid diminta menjelaskan alasan.","Sebagian besar kegiatan meminta murid menjelaskan, membandingkan, atau menunjukkan konsep dengan cara sendiri."]},{"no":9,"indikator":"Guru menyampaikan konsep matematika dengan benar.","rubrik":["Guru menyampaikan atau membenarkan konsep yang keliru sehingga berpotensi menimbulkan miskonsepsi.","Ada ketidaktepatan kecil pada istilah atau contoh yang tidak dikoreksi.","Konsep, istilah, dan contoh yang disampaikan guru benar.","Konsep, istilah, dan contoh benar, dan guru mengenali serta meluruskan miskonsepsi murid yang muncul."]},{"no":10,"indikator":"Murid terlibat aktif dalam kegiatan pembelajaran (melakukan, berbicara, atau membuat sesuatu).","rubrik":["Hampir sepanjang waktu murid hanya mendengarkan atau menyalin.","Kurang dari separuh murid terlibat aktif pada kegiatan inti.","Separuh hingga tiga perempat murid terlibat aktif pada kegiatan inti.","Hampir semua murid (lebih dari tiga perempat) terlibat aktif pada hampir seluruh kegiatan inti."]},{"no":11,"indikator":"Aktivitas mengajak murid mengeksplorasi, mencoba, atau menemukan sendiri.","rubrik":["Aktivitas berupa latihan soal rutin dengan langkah yang sudah ditentukan.","Ada sedikit kesempatan mencoba, tetapi langkah dan jawaban sudah diarahkan guru.","Murid mencoba dan menemukan pola atau ide dengan bimbingan guru.","Murid menyelidiki masalah terbuka, mencoba lebih dari satu cara, dan menemukan sendiri ide atau pola dengan bimbingan seperlunya."]},{"no":12,"indikator":"Murid bekerja sama dalam menyelesaikan tugas.","rubrik":["Murid bekerja sendiri sepanjang pembelajaran.","Murid duduk berkelompok, tetapi bekerja sendiri-sendiri atau hanya satu murid yang mengerjakan.","Sebagian besar murid saling berbicara dan berbagi untuk menyelesaikan tugas bersama.","Hampir semua murid berperan dalam kelompok (membagi tugas dan saling menjelaskan), dan kelompok membandingkan hasil."]},{"no":13,"indikator":"Kegiatan melatih penalaran matematis murid.","rubrik":["Murid hanya menyebut jawaban akhir.","Beberapa murid memberi alasan sederhana setelah diminta guru, tetapi tidak dikembangkan.","Sebagian besar murid yang ditanya dapat menjelaskan cara atau alasannya dengan kata-kata, gambar, atau benda.","Murid menduga, menjelaskan, dan membenarkan idenya, serta menanggapi ide teman."]},{"no":14,"indikator":"Aktivitas murid sesuai dengan tujuan pembelajaran.","rubrik":["Aktivitas yang dilakukan murid tidak mengarah pada tujuan pembelajaran.","Sebagian aktivitas mengarah pada tujuan, tetapi aktivitas inti melenceng.","Seluruh aktivitas mengarah pada tujuan pembelajaran.","Seluruh aktivitas mengarah pada tujuan pembelajaran, dan guru memeriksa (melalui pertanyaan atau hasil kerja) apakah tujuan tercapai."]},{"no":15,"indikator":"Suasana belajar terasa menggembirakan bagi murid (tampak dari ekspresi dan perilaku murid).","rubrik":["Sebagian besar murid tampak pasif, tegang, atau tidak tertarik (misalnya diam, menunduk, atau melamun).","Beberapa murid tampak senang pada bagian tertentu (permainan atau lagu), tetapi kembali pasif saat mengerjakan konsep.","Sebagian besar murid tampak senang dan bersemangat (tersenyum, tertawa, atau bersuara antusias) selama sebagian besar kegiatan.","Hampir semua murid tampak senang dan bersemangat sepanjang pembelajaran, termasuk saat mengerjakan tugas matematika (bukan hanya saat selingan)."]},{"no":16,"indikator":"Guru memberi ruang bagi beragam jawaban dan cara penyelesaian murid.","rubrik":["Guru mengabaikan jawaban murid atau langsung menyalahkannya.","Guru hanya menerima satu jawaban atau satu cara yang dianggap benar.","Guru menerima dan menanggapi beberapa jawaban atau cara yang berbeda.","Guru mengundang jawaban dan cara yang berbeda, menampilkan beberapa di antaranya, dan membandingkannya bersama murid."]},{"no":17,"indikator":"Guru mengajukan pertanyaan lanjutan (probing) untuk menggali cara berpikir murid.","rubrik":["Guru tidak mengajukan pertanyaan lanjutan setelah murid menjawab.","Guru mengajukan pertanyaan lanjutan 1–2 kali selama pembelajaran.","Guru mengajukan pertanyaan lanjutan 3–4 kali, kepada murid yang berbeda.","Guru mengajukan pertanyaan lanjutan 5 kali atau lebih, bertingkat (cara, alasan, lalu pengembangan), kepada murid yang berbeda-beda."]},{"no":18,"indikator":"Guru menanggapi jawaban murid secara membangun.","rubrik":["Guru langsung mengoreksi atau memberi jawaban benar ketika murid keliru.","Guru memberi tanggapan umum (pujian atau “salah”) tanpa membimbing murid.","Guru membimbing murid memperbaiki jawabannya dengan pertanyaan penuntun.","Guru membimbing murid memperbaiki jawabannya dan memanfaatkan jawaban keliru sebagai bahan belajar bagi seluruh kelas."]},{"no":19,"indikator":"Guru mengakomodasi perbedaan kemampuan dan kebutuhan murid (diferensiasi).","rubrik":["Seluruh murid mengerjakan tugas yang sama dengan bantuan yang sama.","Guru membantu murid tertentu hanya jika murid meminta.","Guru secara sengaja memberi bantuan atau tantangan berbeda kepada satu kelompok murid (yang perlu bantuan atau yang cepat selesai).","Guru secara sengaja menyesuaikan tugas, media, atau bantuan bagi murid yang perlu bantuan maupun yang perlu tantangan."]},{"no":20,"indikator":"Murid melakukan refleksi pembelajaran.","rubrik":["Tidak ada kegiatan refleksi.","Hanya guru yang merangkum atau menilai pembelajaran.","Kurang dari separuh murid menyampaikan apa yang dipelajari atau dirasakan.","Sebagian besar murid menyampaikan (lisan, tulisan, atau gambar) apa yang dipelajari, bagaimana caranya, dan perasaannya."]},{"no":21,"indikator":"Guru memperkuat konsep matematika di akhir pembelajaran.","rubrik":["Guru tidak menegaskan konsep utama.","Guru mengulang rumus atau ringkasan tanpa mengaitkannya dengan kegiatan murid.","Guru menegaskan konsep utama dengan merujuk pada hasil kerja murid.","Guru menegaskan konsep utama dengan merujuk pada hasil kerja murid, meluruskan miskonsepsi yang muncul, dan murid dapat menyebutkan konsep utama dengan kata-katanya sendiri."]},{"no":22,"indikator":"Guru mengapresiasi proses belajar murid, bukan hanya hasil.","rubrik":["Tidak ada apresiasi.","Apresiasi bersifat umum (misalnya “bagus”) atau hanya untuk jawaban yang benar.","Guru mengapresiasi usaha atau cara berpikir murid secara spesifik kepada beberapa murid.","Guru mengapresiasi usaha dan cara berpikir murid secara spesifik kepada sedikitnya lima murid yang berbeda, termasuk murid yang belum berhasil."]},{"no":23,"indikator":"Guru menutup pembelajaran dengan menyimpulkan bersama murid.","rubrik":["Pembelajaran berakhir tanpa penutup (misalnya waktu habis).","Guru menyampaikan kesimpulan sendiri.","Guru menyusun kesimpulan bersama murid melalui tanya jawab.","Guru menyusun kesimpulan bersama murid dan mengaitkannya dengan pembelajaran berikutnya atau kehidupan sehari-hari murid."]}],"kelompok":{"1":"Tahap 1: Gali dan Eksplorasi","5":"Tahap 2: Muat Konten","10":"Tahap 3: Buat Aktivitas","16":"Tahap 4: Ikuti Pemikiran Murid","20":"Tahap 5: Rayakan dan Akhiri"}},"4":{"label":"LEVEL 4 — RESULTS: Perubahan pada Guru, Murid, dan Budaya Sekolah","deskripsi":"","indikator":[{"no":1,"indikator":"Guru menerapkan alur pembelajaran GEMBIRA di kelasnya setelah mengikuti kegiatan.","rubrik":["Guru tidak pernah menerapkan alur GEMBIRA dalam pembelajaran.","Guru menerapkan alur GEMBIRA sebanyak 1 kali.","Guru menerapkan alur GEMBIRA sebanyak 2–3 kali.","Guru menerapkan alur GEMBIRA sebanyak 4 kali atau lebih, atau pada sebagian besar pertemuan matematika."]},{"no":2,"indikator":"Guru menyusun sendiri perangkat pembelajaran bernuansa GEMBIRA.","rubrik":["Guru tidak menyusun perangkat pembelajaran bernuansa GEMBIRA.","Guru menyusun perangkat dengan menyalin hampir seluruhnya dari contoh pelatihan.","Guru menyusun perangkat sendiri dengan menyesuaikan contoh pelatihan untuk kelas dan murid yang diajarnya.","Guru menyusun perangkat sendiri untuk materi baru yang tidak ada dalam contoh pelatihan."]},{"no":3,"indikator":"Guru membagikan praktik GEMBIRA kepada guru lain.","rubrik":["Guru tidak pernah membagikan praktik GEMBIRA kepada guru lain.","Guru bercerita tentang praktik GEMBIRA kepada rekan secara informal.","Guru membagikan praktik GEMBIRA dalam satu forum (misalnya KKG atau rapat guru).","Guru membagikan praktik GEMBIRA dalam forum dan memperagakannya kepada rekan (misalnya kelas terbuka atau saling mengamati)."]},{"no":4,"indikator":"Kemampuan numerasi murid: menyelesaikan masalah matematika kontekstual.","rubrik":["Tidak ada murid yang kini mampu menyelesaikan masalah matematika kontekstual (cerita sehari-hari atau benda nyata) yang sebelumnya sulit mereka selesaikan (tidak ada perubahan dibandingkan sebelumnya).","Kurang dari separuh murid kini mampu menyelesaikan masalah matematika kontekstual (cerita sehari-hari atau benda nyata) yang sebelumnya sulit mereka selesaikan.","Separuh hingga tiga perempat murid kini mampu menyelesaikan masalah matematika kontekstual (cerita sehari-hari atau benda nyata) yang sebelumnya sulit mereka selesaikan.","Lebih dari tiga perempat murid kini mampu menyelesaikan masalah matematika kontekstual (cerita sehari-hari atau benda nyata) yang sebelumnya sulit mereka selesaikan."]},{"no":5,"indikator":"Keaktifan murid dalam pembelajaran matematika.","rubrik":["Tidak ada murid yang kini terlibat aktif dalam pembelajaran matematika (mencoba, bertanya, menjawab, atau mengerjakan tugas tanpa harus selalu diminta) (tidak ada perubahan dibandingkan sebelumnya).","Kurang dari separuh murid kini terlibat aktif dalam pembelajaran matematika (mencoba, bertanya, menjawab, atau mengerjakan tugas tanpa harus selalu diminta).","Separuh hingga tiga perempat murid kini terlibat aktif dalam pembelajaran matematika (mencoba, bertanya, menjawab, atau mengerjakan tugas tanpa harus selalu diminta).","Lebih dari tiga perempat murid kini terlibat aktif dalam pembelajaran matematika (mencoba, bertanya, menjawab, atau mengerjakan tugas tanpa harus selalu diminta)."]},{"no":6,"indikator":"Keberanian murid menyampaikan pendapat.","rubrik":["Tidak ada murid yang kini berani menyampaikan pendapat atau jawabannya di depan teman, termasuk ketika belum yakin benar (tidak ada perubahan dibandingkan sebelumnya).","Kurang dari separuh murid kini berani menyampaikan pendapat atau jawabannya di depan teman, termasuk ketika belum yakin benar.","Separuh hingga tiga perempat murid kini berani menyampaikan pendapat atau jawabannya di depan teman, termasuk ketika belum yakin benar.","Lebih dari tiga perempat murid kini berani menyampaikan pendapat atau jawabannya di depan teman, termasuk ketika belum yakin benar."]},{"no":7,"indikator":"Kemampuan murid menjelaskan cara berpikirnya.","rubrik":["Tidak ada murid yang kini mampu menjelaskan cara berpikirnya dengan kata-kata, gambar, atau benda (tidak ada perubahan dibandingkan sebelumnya).","Kurang dari separuh murid kini mampu menjelaskan cara berpikirnya dengan kata-kata, gambar, atau benda.","Separuh hingga tiga perempat murid kini mampu menjelaskan cara berpikirnya dengan kata-kata, gambar, atau benda.","Lebih dari tiga perempat murid kini mampu menjelaskan cara berpikirnya dengan kata-kata, gambar, atau benda."]},{"no":8,"indikator":"Minat murid terhadap pembelajaran matematika.","rubrik":["Tidak ada murid yang kini menunjukkan minat yang lebih tinggi pada matematika (tampak senang, meminta kegiatan matematika lagi, atau tidak menghindarinya) (tidak ada perubahan dibandingkan sebelumnya).","Kurang dari separuh murid kini menunjukkan minat yang lebih tinggi pada matematika (tampak senang, meminta kegiatan matematika lagi, atau tidak menghindarinya).","Separuh hingga tiga perempat murid kini menunjukkan minat yang lebih tinggi pada matematika (tampak senang, meminta kegiatan matematika lagi, atau tidak menghindarinya).","Lebih dari tiga perempat murid kini menunjukkan minat yang lebih tinggi pada matematika (tampak senang, meminta kegiatan matematika lagi, atau tidak menghindarinya)."]},{"no":9,"indikator":"Guru di sekolah berdiskusi atau merencanakan pembelajaran matematika bersama (KKG, komunitas belajar, atau diskusi terjadwal).","rubrik":["Tidak ada pertemuan guru yang membahas pembelajaran matematika.","Ada 1 kali pertemuan yang membahas pembelajaran matematika.","Ada 2 kali pertemuan yang membahas pembelajaran matematika.","Ada 3 kali pertemuan atau lebih (sekitar sebulan sekali) dan terdapat daftar hadir atau catatan hasil pertemuan."]},{"no":10,"indikator":"Guru terbiasa melakukan refleksi pembelajaran.","rubrik":["Guru tidak melakukan refleksi pembelajaran.","Guru sesekali melakukan refleksi, secara individu, dan tidak terdokumentasi.","Guru melakukan refleksi secara rutin (sedikitnya sebulan sekali) dan terdokumentasi (jurnal atau catatan).","Guru melakukan refleksi secara rutin dan terdokumentasi, serta ada contoh hasil refleksi yang dipakai memperbaiki pembelajaran berikutnya."]},{"no":11,"indikator":"Pembelajaran berbasis numerasi dan berpusat pada murid mulai diterapkan oleh guru lain di sekolah.","rubrik":["Tidak ada guru di sekolah yang menerapkan pembelajaran berbasis numerasi dan berpusat pada murid.","Hanya guru peserta kegiatan yang menerapkannya.","Guru peserta dan sedikitnya satu guru lain (bukan peserta) menerapkannya.","Guru peserta dan lebih dari separuh guru kelas/matematika lain di sekolah menerapkannya, tampak pada catatan supervisi atau perangkat ajar."]}],"kelompok":{"1":"A. Keberlanjutan Praktik Guru │ Responden: guru (diverifikasi kepala sekolah/pengawas)","4":"B. Perubahan pada Murid │ Responden: guru (dengan bukti hasil kerja/catatan), dapat dicek oleh kepala sekolah/pengawas │ Bandingkan dengan kondisi murid sebelum guru menerapkan GEMBIRA","9":"C. Perubahan pada Budaya Sekolah │ Responden: kepala sekolah/pengawas"}}}
                        GEMBIRA_JSON, true);

        $levelLabel = [
            1 => 'Level 1 — Reaction',
            2 => 'Level 2 — Learning',
            3 => 'Level 3 — Behavior',
            4 => 'Level 4 — Results',
        ];

        // Deskripsi level diambil dari judul instrumen (bagian setelah titik dua), bila ada.
        $levelDeskripsi = [];
        foreach ($levelLabel as $lv => $teks) {
            $judulPanjang = $levelData[(string) $lv]['label'] ?? '';
            $levelDeskripsi[$lv] = str_contains($judulPanjang, ': ')
                ? \Illuminate\Support\Str::after($judulPanjang, ': ')
                : '';
        }

        /*
        |--------------------------------------------------------------------------
        | Level yang berlaku berdasarkan jabatan penilai
        |--------------------------------------------------------------------------
        | Peserta Matematika GEMBIRA : Level 1, 2, 3, 4
        | Penilai lainnya            : Level 3 dan 4
        */
        $jabatanPenilai = $gembira->jabatan_penilai;
        $isPeserta = blank($jabatanPenilai) || $jabatanPenilai === 'Peserta Matematika GEMBIRA';
        $levelAktif = $isPeserta ? [1, 2, 3, 4] : [3, 4];

        /*
        |--------------------------------------------------------------------------
        | Rekap jawaban per level
        |--------------------------------------------------------------------------
        */
        $rekap = [];

        foreach ($levelAktif as $lv) {
            $raw = $gembira->{'level_' . $lv . '_jawaban'} ?? [];

            if (is_string($raw)) {
                $raw = json_decode($raw, true);
            }

            $raw = is_array($raw) ? $raw : [];

            $daftarIndikator = $levelData[(string) $lv]['indikator'] ?? [];
            $skorLevel = 0;
            $terisi = 0;
            $jumlahTd = 0;
            $baris = [];

            foreach ($daftarIndikator as $ind) {
                $item = $raw[$ind['no']] ?? $raw['indikator_' . $ind['no']] ?? null;

                if (is_array($item)) {
                    $nilai = $item['skor'] ?? $item['jawaban'] ?? null;
                    $bukti = $item['bukti'] ?? $item['catatan'] ?? null;
                    $alasan = $item['alasan_td'] ?? null;
                } else {
                    $nilai = $item;
                    $bukti = null;
                    $alasan = null;
                }

                $isTd = $nilai === 'TD';

                if ($isTd) {
                    $jumlahTd++;
                } elseif (is_numeric($nilai)) {
                    $skorLevel += (int) $nilai;
                    $terisi++;
                }

                $baris[$ind['no']] = [
                    'nilai' => $nilai,
                    'bukti' => $bukti,
                    'alasan' => $alasan,
                    'isTd' => $isTd,
                ];
            }

            $jumlahIndikator = count($daftarIndikator);
            $maksimum = ($jumlahIndikator - $jumlahTd) * 4;

            $rekap[$lv] = [
                'skor' => $skorLevel,
                'terisi' => $terisi,
                'td' => $jumlahTd,
                'total' => $jumlahIndikator,
                'max' => $maksimum,
                'rerata' => $terisi > 0 ? $skorLevel / $terisi : 0,
                'persen' => $maksimum > 0 ? ($skorLevel / $maksimum) * 100 : 0,
                'baris' => $baris,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Total, nilai akhir, dan predikat
        |--------------------------------------------------------------------------
        */
        $totalSkor = (int) collect($rekap)->sum('skor');
        $skorMaksimum = (int) collect($rekap)->sum('max');
        $terisiTotal = (int) collect($rekap)->sum('terisi');
        $tdTotal = (int) collect($rekap)->sum('td');
        $indikatorBerlaku = (int) collect($rekap)->sum('total') - $tdTotal;

        $rerataKeseluruhan = $terisiTotal > 0 ? $totalSkor / $terisiTotal : 0;
        $nilaiAkhir = $skorMaksimum > 0 ? ($totalSkor / $skorMaksimum) * 100 : 0;

        if ($terisiTotal === 0) {
            $predikat = '-';
        } elseif ($rerataKeseluruhan >= 3.5) {
            $predikat = 'Sangat Baik';
        } elseif ($rerataKeseluruhan >= 2.75) {
            $predikat = 'Baik';
        } elseif ($rerataKeseluruhan >= 2.0) {
            $predikat = 'Cukup';
        } else {
            $predikat = 'Perlu pendampingan intensif';
        }

        $predikatClass = match ($predikat) {
            'Sangat Baik' => 'bg-emerald-100 text-emerald-700',
            'Baik' => 'bg-blue-100 text-blue-700',
            'Cukup' => 'bg-amber-100 text-amber-700',
            '-' => 'bg-slate-100 text-slate-700',
            default => 'bg-red-100 text-red-700',
        };

        $status = $gembira->status ?? 'Draft';
    @endphp

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('gembira.index') }}" class="transition hover:text-blue-600">
                        Instrumen Pemantauan
                    </a>
                    <span>/</span>
                    <span>Matematika GEMBIRA</span>
                </div>

                <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                    Hasil Penilaian Matematika GEMBIRA
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Informasi biodata dan hasil penilaian Matematika GEMBIRA.
                </p>
            </div>

            <div class="no-print flex flex-wrap items-center gap-3">
                <a href="{{ route('instrumen.index') }}"
                    class="inline-flex h-12 items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-6 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kembali
                </a>

                <a href="{{ route('gembira.edit', $gembira) }}"
                    class="inline-flex h-12 items-center justify-center rounded-xl px-6 text-sm font-semibold text-white shadow-sm transition"
                    style="background-color: #f97316;" onmouseover="this.style.backgroundColor='#ea580c'"
                    onmouseout="this.style.backgroundColor='#f97316'">
                    Edit Pengisian
                </a>
                <a href="{{ route('gembira.cetak', $gembira) }}" target="_blank"
                    class="rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-emerald-700">
                    Cetak Hasil
                </a>
            </div>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Ringkasan hasil --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

            {{-- Total Skor --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-slate-500">Total Skor</p>

                <div class="mt-2 flex items-end gap-2">
                    <span class="text-3xl font-bold text-slate-900">{{ $totalSkor }}</span>
                    <span class="pb-1 text-sm text-slate-500">/ {{ $skorMaksimum }}</span>
                </div>

                <p class="mt-2 text-xs text-slate-500">
                    Akumulasi {{ $indikatorBerlaku }} indikator sesuai jabatan penilai.
                </p>
            </div>

            {{-- Nilai Akhir --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-slate-500">Nilai Akhir</p>

                <div class="mt-2">
                    <span class="text-3xl font-bold text-blue-600">
                        {{ number_format($nilaiAkhir, 2, ',', '.') }}
                    </span>
                    <span class="text-sm font-semibold text-slate-500">%</span>
                </div>

                <p class="mt-2 text-xs text-slate-500">
                    Persentase berdasarkan skor maksimum indikator yang berlaku.
                </p>
            </div>

            {{-- Predikat --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-slate-500">Predikat</p>

                <div class="mt-2">
                    <span class="inline-flex rounded-full px-3 py-1.5 text-sm font-bold {{ $predikatClass }}">
                        {{ $predikat }}
                    </span>
                </div>

                <p class="mt-2 text-xs text-slate-500">
                    Rerata skor {{ number_format($rerataKeseluruhan, 2, ',', '.') }} dari skala 1–4.
                </p>
            </div>
        </div>

        {{-- A. Identitas Guru dan Sekolah --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-800">A. Identitas Guru dan Sekolah</h2>
                <p class="mt-1 text-sm text-slate-500">Informasi guru dan konteks pembelajaran yang dinilai.</p>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-6 md:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Guru</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $gembira->nama_guru ?: '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Sekolah</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $gembira->nama_sekolah ?: '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Kelas / Fase</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $gembira->kelas_fase ?: '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Topik / Materi</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $gembira->topik_materi ?: '-' }}</p>
                </div>
            </div>
        </section>

        {{-- B. Identitas Responden dan Petugas Monev --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                <h2 class="text-lg font-bold text-slate-800">B. Identitas Responden dan Petugas Monev</h2>
                <p class="mt-1 text-sm text-slate-500">Jabatan penilai menentukan level yang berlaku.</p>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-6 md:grid-cols-2">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Nama Petugas Monev</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $gembira->nama_petugas_monev ?: '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Jabatan Penilai</p>
                    <p class="mt-1 font-semibold text-slate-800">{{ $jabatanPenilai ?: '-' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Tanggal Monev</p>
                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $gembira->tanggal_monev?->format('d-m-Y') ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Status Pengisian</p>
                    <div class="mt-1">
                        <span
                            class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $status === 'Selesai' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                            {{ $status }}
                        </span>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Sumber Data / Bukti</p>
                    <p class="mt-1 whitespace-pre-line font-semibold text-slate-800">
                        {{ $gembira->sumber_data_bukti ?: '-' }}
                    </p>
                </div>
            </div>
        </section>

        {{-- C. Informasi Observasi (Level 3) --}}
        @if (
                $gembira->tanggal_observasi ||
                $gembira->durasi_pembelajaran ||
                $gembira->jumlah_murid_hadir !== null ||
                $gembira->observasi_ke !== null
            )
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                    <h2 class="text-lg font-bold text-slate-800">C. Informasi Observasi</h2>
                    <p class="mt-1 text-sm text-slate-500">Metadata observasi pembelajaran (Level 3).</p>
                </div>

                <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-6 md:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Tanggal Observasi</p>
                        <p class="mt-1 font-semibold text-slate-800">
                            {{ $gembira->tanggal_observasi?->format('d-m-Y') ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Durasi Pembelajaran</p>
                        <p class="mt-1 font-semibold text-slate-800">{{ $gembira->durasi_pembelajaran ?: '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Jumlah Murid Hadir</p>
                        <p class="mt-1 font-semibold text-slate-800">{{ $gembira->jumlah_murid_hadir ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Observasi Ke-</p>
                        <p class="mt-1 font-semibold text-slate-800">{{ $gembira->observasi_ke ?? '-' }}</p>
                    </div>
                </div>
            </section>
        @endif

        @if ($terisiTotal === 0 && $tdTotal === 0)
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-6 text-center">
                <p class="font-semibold text-slate-700">Belum ada jawaban penilaian tersimpan.</p>
                <p class="mt-1 text-sm text-slate-500">
                    Data yang tersimpan saat ini mungkin baru berupa biodata.
                </p>
            </div>
        @else
            {{-- Rekap per level --}}
            <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-5">
                    <h2 class="text-lg font-bold text-slate-900">Rekapitulasi Berdasarkan Level</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Ringkasan skor untuk level evaluasi yang berlaku bagi
                        {{ $isPeserta ? 'peserta Matematika GEMBIRA (Level 1–4)' : 'jabatan penilai ini (Level 3 dan 4)' }}.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-4 p-6 md:grid-cols-2 {{ count($levelAktif) === 4 ? 'xl:grid-cols-4' : '' }}">
                    @foreach ($levelAktif as $lv)
                        @php $r = $rekap[$lv]; @endphp

                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-sm font-bold text-slate-800">{{ $levelLabel[$lv] }}</p>
                            <p class="mt-1 text-xs leading-5 text-slate-500">
                                {{ $levelDeskripsi[$lv] ?: $r['terisi'] . ' dari ' . $r['total'] . ' indikator terisi.' }}
                            </p>

                            <div class="mt-4 flex items-end justify-between gap-3">
                                <div>
                                    <span class="text-2xl font-bold text-blue-600">{{ $r['skor'] }}</span>
                                    <span class="text-xs text-slate-500">/ {{ $r['max'] }}</span>
                                </div>

                                <span class="text-sm font-bold text-slate-700">
                                    {{ number_format($r['persen'], 2, ',', '.') }}%
                                </span>
                            </div>

                            <div class="mt-3 h-2 overflow-hidden rounded-full bg-slate-200">
                                <div class="h-full rounded-full bg-blue-600" style="width: {{ min($r['persen'], 100) }}%"></div>
                            </div>

                            <p class="mt-2 text-xs text-slate-500">
                                Rerata {{ number_format($r['rerata'], 2, ',', '.') }}
                                · {{ $r['terisi'] }}/{{ $r['total'] }} indikator terisi
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Detail indikator per level --}}
            @foreach ($levelAktif as $lv)
                @php
                    $r = $rekap[$lv];
                    $levelInfo = $levelData[(string) $lv];
                    $adaBukti = in_array($lv, [2, 3, 4], true);
                @endphp

                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-200 px-6 py-5">
                        <h2 class="text-lg font-bold text-slate-900">{{ $levelLabel[$lv] }}</h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Detail penilaian {{ $r['total'] }} indikator
                            @if ($levelDeskripsi[$lv])
                                — {{ $levelDeskripsi[$lv] }}
                            @endif
                        </p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full {{ $adaBukti ? 'min-w-[800px]' : 'min-w-[600px]' }} text-left text-sm">
                            <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                                <tr>
                                    <th class="px-6 py-4 font-bold">No.</th>
                                    <th class="px-6 py-4 font-bold">Indikator</th>
                                    @if ($adaBukti)
                                        <th class="px-6 py-4 font-bold">Bukti / Catatan</th>
                                    @endif
                                    <th class="px-6 py-4 text-center font-bold">Skor</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">
                                @foreach ($levelInfo['indikator'] as $ind)
                                    @if (isset($levelInfo['kelompok'][(string) $ind['no']]))
                                        <tr class="bg-blue-50">
                                            <td colspan="{{ $adaBukti ? 4 : 3 }}" class="px-6 py-3 text-sm font-bold text-blue-900">
                                                {{ $levelInfo['kelompok'][(string) $ind['no']] }}
                                            </td>
                                        </tr>
                                    @endif

                                    @php $b = $r['baris'][$ind['no']]; @endphp

                                    <tr class="transition hover:bg-slate-50">
                                        <td class="whitespace-nowrap px-6 py-4 align-top font-semibold text-slate-500">
                                            {{ $ind['no'] }}
                                        </td>

                                        <td class="px-6 py-4 align-top leading-6 text-slate-700">
                                            {{ $ind['indikator'] }}
                                        </td>

                                        @if ($adaBukti)
                                            <td class="whitespace-pre-line px-6 py-4 align-top leading-6 text-slate-600">
                                                {{ $b['bukti'] ?: ($b['alasan'] ?: '-') }}
                                            </td>
                                        @endif

                                        <td class="px-6 py-4 text-center align-top">
                                            @if ($b['isTd'])
                                                <span
                                                    class="inline-flex h-9 items-center justify-center rounded-full bg-amber-100 px-3 text-xs font-bold text-amber-800">
                                                    TD
                                                </span>
                                            @elseif (is_numeric($b['nilai']))
                                                <span
                                                    class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-blue-600 font-bold text-white">
                                                    {{ $b['nilai'] }}
                                                </span>
                                            @else
                                                <span class="text-slate-400">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
@endsection