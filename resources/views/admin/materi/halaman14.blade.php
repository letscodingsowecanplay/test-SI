@extends('layouts.master')

@section('content')

    <div class="card bg-coklat">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Pengukuran</h4>
        </div>
        <div class="card-body">
            <button onclick="playSound('ayo-belajar')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white" title="Dengarkan">
                🔊
            </button>
            <audio id="audio-ayo-belajar" src="{{ asset('sounds/materi/ayo-belajar.mp3') }}"></audio>
            <ul class="list-group list-group-flush">
                

                <li class="list-group-item bg-transparent">
                    <p class="mt-2">
                        Kemungkinan Perbedaan Pengukuran pada Suatu Benda dengan Satuan Tidak Baku.
                    </p>

                    <p class="mt-2">                    
                        Ketika kita mengukur suatu benda menggunakan satuan tidak baku, hasilnya bisa berbeda tergantung pada alat atau benda yang digunakan sebagai satuan ukur. Hal ini terjadi karena satuan tidak baku tidak memiliki ukuran yang tetap seperti satuan baku (misalnya meter atau sentimeter).
                    </p>

                    <p class="mt-2">                      
                        Sebagai contoh, jika kita mengukur tinggi sebuah buku menggunakan stik es krim, hasilnya mungkin 3 stik es krim. Namun, jika kita mengukurnya dengan pensil, hasilnya bisa berbeda, misalnya 2 pensil. Hal ini terjadi karena panjang stik es krim dan pensil tidak sama—stik es krim lebih pendek dibandingkan pensil, sehingga diperlukan lebih banyak stik es krim untuk mengukur tinggi buku tersebut.
                    </p>
                    <p class="mt-2">
                        Perbedaan pengukuran ini menunjukkan bahwa satuan tidak baku bersifat relatif dan bisa berubah tergantung pada benda yang digunakan untuk mengukur.     
                    </p>
                </li>
            </ul>

            {{-- Gambar --}}
            <div class="row text-center my-4">
                <div class="d-flex justify-content-center my-4">
                    <img src="{{ asset('images/materi/perbedaan-hasil-ukur.png') }}" 
                    alt="Gambar Penggaris" 
                    class="rounded shadow" 
                    style="display: block; margin: 0 auto; width: 300px; height: 300px; object-fit: cover;">
                </div>
            </div>

        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.materi.halaman13') }}" class="btn btn-secondary">← Sebelumnya</a>
            <a href="{{ route('admin.materi.halaman15') }}" class="btn btn-primary">Selanjutnya →</a>
        </div>
    </div>
    <br>
@endsection

@section('scripts')
<script>
    function playSound(id) {
        // pause all audio
        document.querySelectorAll('audio').forEach(audio => {
            audio.pause();
            audio.currentTime = 0;
        });

        const audio = document.getElementById(`audio-${id}`);
        if (audio) {
            audio.play();
        }
    }
</script>
@endsection
