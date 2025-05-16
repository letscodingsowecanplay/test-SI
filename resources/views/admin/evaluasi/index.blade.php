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
    <div class="modal-content" style="background-color: pink;">
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
            soal: "Urutan miniatur rumah banjar dari yang paling tinggi adalah ....",
            pilihan: ["Anno 1925 - Bubungan Tinggi - Gajah Manyusu", "Bubungan Tinggi - Anno 1925 - Gajah Manyusu", "Gajah Manyusu - Bubungan Tinggi - Anno 1925"],
            audio: "/audio/soal1.mp3"
        },
        {
            id: 2,
            soal: "Urutan tas kerajinan khas Kalimantan dari yang digantung paling rendah adalah ....",
            pilihan: ["Tas anyaman hitam - Tas anyaman putih - Tas ecoprint", "Tas ecoprint - Tas anyaman putih - Tas anyaman Hitam", "Tas anyaman putih - Tas anyaman hitam - Tas ecoprint"],
            audio: "/audio/soal2.mp3"
        },
        {
            id: 3,
            soal: "Urutan kerajinan fiber glass patung dayak dimulai dari yang paling panjang adalah ....",
            pilihan: ["b-c-a", "b-a-c", "c-a-b"],
            audio: "/audio/soal2.mp3"
        },
        {
            id: 4,
            soal: "Urutan vas bunga akar keladi dimulai dari yang paling pendek adalah ....",
            pilihan: ["a-c-b", "c-b-a", "a-b-c"],
            audio: "/audio/soal2.mp3"
        },
        {
            id: 5,
            soal: "Urutan kain sasirangan dimulai dari yang paling panjang adalah ....",
            pilihan: ["a-b-c", "c-b-a", "a-c-b"],
            audio: "/audio/soal2.mp3"
        },
        {
            id: 6,
            soal: "Pertanyaan ke-6",
            pilihan: ["Jawaban A", "Jawaban B", "Jawaban C", "Jawaban D"],
            audio: "/audio/soal2.mp3"
        },
        {
            id: 7,
            soal: "Pertanyaan ke-7",
            pilihan: ["Jawaban A", "Jawaban B", "Jawaban C", "Jawaban D"],
            audio: "/audio/soal2.mp3"
        },
        {
            id: 8,
            soal: "Pertanyaan ke-8",
            pilihan: ["Jawaban A", "Jawaban B", "Jawaban C", "Jawaban D"],
            audio: "/audio/soal2.mp3"
        },
        {
            id: 9,
            soal: "Pertanyaan ke-9",
            pilihan: ["Jawaban A", "Jawaban B", "Jawaban C", "Jawaban D"],
            audio: "/audio/soal2.mp3"
        },
        {
            id: 10,
            soal: "Pertanyaan ke-10",
            pilihan: ["Jawaban A", "Jawaban B", "Jawaban C", "Jawaban D"],
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
                <button onclick="playSound('audio${data.id}')" class="btn btn-sm btn-outline-dark text-white ms-3" title="Dengarkan kalimat ini">🔊</button>
                <audio id="audio${data.id}" src="${data.audio}"></audio>
            </div>
            <form id="form-soal">
        `;

        html += `
        <div class="mt-3">
            <img src="/images/kuis1/gambarKuis${data.id}.png" 
                 alt="Gambar Kuis 1 Soal ${data.id}" 
                 style="width: 600px; height: 300px; object-fit: cover;" 
                 class="rounded shadow">
        </div>
        <br>
        `;

        data.pilihan.forEach((opsi, idx) => {
            const huruf = String.fromCharCode(65 + idx); // A, B, C, D
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
        // Kumpulkan semua jawaban dengan key sebagai nomor soal
        const jawabanFinal = {};
        soalList.forEach(soal => {
            // Cek apakah user menjawab soal ini
            if (jawabanUser.hasOwnProperty(soal.id.toString())) {
                jawabanFinal[soal.id.toString()] = jawabanUser[soal.id.toString()];
            } else {
                jawabanFinal[soal.id.toString()] = null; // Tandai soal belum dijawab
            }
        });

        console.log('Jawaban yang dikirim:', jawabanFinal);

        // Validasi apakah semua soal dijawab
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
            // Isi konten modal
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
                        ? 'Selamat, anda lulus Kuis 1, silahkan melanjutkan ke materi berikutnya'
                        : 'Maaf, anda belum lulus. Silahkan ulangi kuis.'}
                </p>
            `;

            hasilFooter.innerHTML = data.skor_persen >= 70 
                ? `<button class="btn btn-success" id="lanjutMateri">Lanjut Materi</button>` 
                : `<button class="btn btn-warning" id="ulangiKuis">Ulangi Kuis</button>`;

            // Tampilkan modal
            const modalEl = document.getElementById('hasilModal');
            if (modalEl) {
                const modal = new bootstrap.Modal(modalEl);
                modal.show();
            }

            // Tambahkan event listener untuk tombol di modal
            document.getElementById('lanjutMateri')?.addEventListener('click', () => {
                window.location.href = "{{ route('admin.materi.halaman5') }}";
            });

            document.getElementById('ulangiKuis')?.addEventListener('click', () => {
                window.location.href = "{{ route('admin.evaluasi.index') }}";
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
