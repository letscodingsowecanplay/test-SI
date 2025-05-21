@extends('layouts.master-kuis')

@section('content')
<div class="mb-3">
    <strong>Sisa Waktu :</strong> <span id="timer">30:00</span>
</div>

<div class="container-kuis">
    <!-- SOAL -->
    <div class="soal-section">
        <div id="soal-container">
            <!-- Soal dinamis diisi via JS -->
        </div>
    </div>

    <!-- NAVIGASI -->
    <div class="navigasi-section">
        <h5>Nomor Soal</h5>
        <div id="navigasi-nomor"></div>

        <div class="mt-4 text-center">
            <button class="btn btn-secondary btn-nav" onclick="navigasiSoal('prev')">Sebelumnya</button>
            <button class="btn btn-secondary btn-nav" onclick="navigasiSoal('next')">Selanjutnya</button>
            <button class="btn btn-success btn-nav" onclick="submitJawaban()">Selesai</button>
            <a href="{{ route('admin.materi.index') }}" class="btn btn-danger btn-nav">Kembali ke Materi</a>
        </div>
    </div>
</div>

<!-- Modal Hasil Kuis -->
<div class="modal fade" id="hasilModal" tabindex="-1" aria-labelledby="hasilModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-coklap">
      <div class="modal-header">
        <h5 class="modal-title" id="hasilModalLabel">Hasil Kuis 1</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center" id="hasilModalBody">
        <!-- Konten akan diisi lewat JS -->
      </div>
      <div class="modal-footer justify-content-center" id="hasilModalFooter">
        <!-- Tombol akan diisi lewat JS -->
      </div>
    </div>
  </div>
</div>


<script>
    const soalList = [
        {
            id: 1,
            soal: "Jenis pisang yang banyak tumbuh di daerah kalimantan memiliki ukuran paling pendek adalah ....",
            pilihan: ["Pisang mahuli", "Pisang kepok", "Pisang talas"],
            audio: "/audio/soal1.mp3"
        },
        {
            id: 2,
            soal: "Wadai khas kalimantan yang sering hadir disaat ramadhan memiliki ukuran paling panjang adalah .... a. Talas pandan b. Puteri selat c. Semua benar",
            pilihan: ["Talas pandan", "Puteri selat", "Amparan Tatak"],
            audio: "/audio/soal2.mp3"
        },
        {
            id: 3,
            soal: "Utuh ingin membangun jembatan dibelakang halaman rumahnya. Diantara ketiga ukuran kayu ini, kayu yang paling pendek adalah ....",
            pilihan: ["a", "b", "c"],
            audio: "/audio/soal2.mp3"
        },
        {
            id: 4,
            soal: "Urutan brosur museum, buku sejarah, dan buku Sasirangan berdasarkan bentuk yang paling panjang adalah … ",
            pilihan: ["Brosur museum – Buku Sasirangan – Buku sejarah", "Buku sejarah – Buku Sasirangan – Brosur museum", "Buku Sasirangan – Buku sejarah – Brosur museum"],
            audio: "/audio/soal2.mp3"
        },
        {
            id: 5,
            soal: "Tanaman khas Kalimantan memiliki bentuk yang unik dan menarik. Berdasarkan gambar yang ditampilkan, urutan wadah tanaman dari yang memiliki bentuk paling rendah adalah … ",
            pilihan: ["Akar kuning-Bamban-Bangkal", "Bamban-Akar kuning-Bangkal", "Bangkal-Akar kuning-Bamban"],
            audio: "/audio/soal2.mp3"
        },
        {
            id: 6,
            soal: "Museum daerah menampilkan banyak ragam jenis kain yang ada di Kalimantan selama periode tertentu. Berdasarkan gambar, panjang kain tenun adalah .... ",
            pilihan: ["3 stik eskrim", "4 stik eskrim", "5 stik eskrim"],
            audio: "/audio/soal2.mp3"
        },
        {
            id: 7,
            soal: "Ikan diperairan kalimantan memiliki banyak jenis dan rupanya masingmasing. Panjang ikan haruan disamping adalah ....",
            pilihan: ["4 pensil", "3 pensil", "2 pensil"],
            audio: "/audio/soal2.mp3"
        },
        {
            id: 8,
            soal: "Mangga kasturi adalah mangga spesifik yang berasal dari Kalimantan Selatan. Panjang buah mangga kasturi adalah ... penghapus.",
            pilihan: ["2", "3", "4"],
            audio: "/audio/soal2.mp3"
        },
        {
            id: 9,
            soal: "Mengkudu adalah tanaman yang banyak tumbuh di hutan Kalimantan. Panjang buah mengkudu tersebut adalah ... korek api.",
            pilihan: ["3", "4", "5"],
            audio: "/audio/soal2.mp3"
        },
        {
            id: 10,
            soal: "Buku ini merupakan buku yang mengisahkan sejarah Kalimantan dan diterbitkan pada tahun 1922. Lebar buku tersebut adalah …",
            pilihan: ["1 hasta", "1 depa", "1 jengkal"],
            audio: "/audio/soal2.mp3"
        },
        // ... dst hingga 10 soal
    ];

    let indexSoal = 0;
    const jawabanUser = {};

    function tampilkanSoal() {
        const data = soalList[indexSoal];
        let html = `
            <div class="question-title">${data.id}. ${data.soal}
                <button onclick="playSound('audio${data.id}')" class="btn btn-sm btn-outline-dark text-white bg-coklap" title="Dengarkan kalimat ini">🔊</button>
                <audio id="audio${data.id}" src="${data.audio}"></audio>
            </div>
            <form id="form-soal">
        `;

        html += `
        <div class="mt-3">
            <img src="/images/evaluasi/gambarEval${data.id}.png" 
                 alt="Gambar Evaluasi 1 Soal ${data.id}" 
                 style="width: 600px; height: 300px; object-fit: cover;" 
                 class="rounded shadow">
        </div>
        <br>
        `;

        data.pilihan.slice(0, 3).forEach((opsi, idx) => {
            const huruf = String.fromCharCode(65 + idx); // A, B, C
            const checked = jawabanUser[data.id] === huruf ? 'checked' : '';
            html += `
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jawaban" value="${huruf}" id="${huruf}" ${checked}>
                    <label class="form-check-label" for="${huruf}">${opsi}</label>
                </div>
            `;
        });


        html += `</form>`;
        document.getElementById('soal-container').innerHTML = html;

        renderNavigasi();
    }

    function navigasiSoal(mode) {
        const form = document.getElementById('form-soal');
        const selected = form.querySelector('input[name="jawaban"]:checked');
        if (selected) {
            jawabanUser[soalList[indexSoal].id] = selected.value;
        }

        if (mode === 'next' && indexSoal < soalList.length - 1) indexSoal++;
        if (mode === 'prev' && indexSoal > 0) indexSoal--;

        tampilkanSoal();
    }

    function renderNavigasi() {
        const container = document.getElementById('navigasi-nomor');
        container.innerHTML = '';
        soalList.forEach((soal, i) => {
            const active = i === indexSoal ? 'active' : '';
            container.innerHTML += `<button class="btn btn-outline-dark m-1 ${active}" onclick="pindahKeSoal(${i})">${soal.id}</button>`;
        });
    }

    function pindahKeSoal(i) {
        const form = document.getElementById('form-soal');
        const selected = form.querySelector('input[name="jawaban"]:checked');
        if (selected) {
            jawabanUser[soalList[indexSoal].id] = selected.value;
        }

        indexSoal = i;
        tampilkanSoal();
    }

    function submitJawaban() {
    // Simpan jawaban terakhir (yang sedang terlihat di layar)
    const form = document.getElementById('form-soal');
    if (form) {
        const selected = form.querySelector('input[name="jawaban"]:checked');
        if (selected) {
            jawabanUser[soalList[indexSoal].id] = selected.value;
        }
    }

    // Kumpulkan semua jawaban
    const jawabanFinal = {};
    soalList.forEach(soal => {
        const id = soal.id.toString();
        jawabanFinal[id] = jawabanUser[id] ?? null;
    });

    // Cek apakah semua sudah dijawab
    const adaYangBelumDijawab = Object.values(jawabanFinal).some(jawab => jawab === null);
    if (adaYangBelumDijawab) {
        alert("Anda belum menjawab semua soal!");
        return;
    }

    // Kirim data ke server
    fetch('{{ route("admin.evaluasi.simpan") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            jawaban: jawabanFinal
        })
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => { throw err; });
        }
        return response.json();
    })
    .then(data => {
        const hasilBody = document.getElementById('hasilModalBody');
        const hasilFooter = document.getElementById('hasilModalFooter');

        hasilBody.innerHTML = `
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Sekolah:</strong> SD Banjarmasin</p>
            <p><strong>Kelas:</strong> 1</p>
            <p><strong>Nilai Kuis 1:</strong> ${data.skor}</p>
            <p class="text-${data.skor_persen >= 70 ? 'success' : 'danger'} fw-bold">
                ${data.skor_persen >= 70 
                    ? 'Selamat, anda lulus Evaluasi!'
                    : 'Maaf, anda belum lulus. Silahkan ulangi kuis.'}
            </p>
        `;

        if (data.skor_persen >= 70) {
            hasilFooter.innerHTML = `
                <button class="btn btn-secondary" id="selesaiEvaluasi">Selesai</button>
            `;
        } else {
            hasilFooter.innerHTML = `
                <button class="btn btn-warning" id="ulangiKuis">Ulangi Kuis</button>
            `;
        }

        const modalEl = document.getElementById('hasilModal');
        if (modalEl) {
            const modal = new bootstrap.Modal(modalEl);
            modal.show();

            modalEl.querySelector('.btn-close')?.addEventListener('click', () => {
                window.location.href = "{{ route('admin.evaluasi.petunjuk') }}";
            });
        }

            document.getElementById('lanjutMateri')?.addEventListener('click', () => {
                window.location.href = "{{ route('admin.materi.halaman5') }}";
            });

            document.getElementById('ulangiKuis')?.addEventListener('click', () => {
                window.location.href = "{{ route('admin.evaluasi.index') }}";
            });

            document.getElementById('selesaiEvaluasi')?.addEventListener('click', () =>{
                window.location.href = "{{ route('admin.evaluasi.petunjuk') }}";
            });
        })
        .catch(error => {
            console.error('Error details:', error);
            let errorMsg = "Gagal menyimpan jawaban";
            if (error.message) {
                errorMsg += ": " + error.message;
            } else if (error.errors) {
                errorMsg += ": " + JSON.stringify(error.errors);
            }
            alert(errorMsg);
        });
    }

    // Timer
    let waktu = 30 * 60;
    const timerElement = document.getElementById('timer');
    setInterval(() => {
        const menit = Math.floor(waktu / 60);
        const detik = waktu % 60;
        timerElement.innerText = `${menit}:${detik.toString().padStart(2, '0')}`;
        if (waktu > 0) waktu--;
    }, 1000);

    // Start
    tampilkanSoal();
</script>
@endsection
