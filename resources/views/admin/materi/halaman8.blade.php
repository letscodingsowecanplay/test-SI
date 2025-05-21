@extends('layouts.master')

@section('content')

    <div class="card bg-coklat">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Pengukuran</h4>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                

                <li class="list-group-item bg-transparent">

                    <p class="mt-2">
                        Kita bandingkan kain sasirangan a, b, dan c.
                        <button onclick="playSound('paragraf-belajar')" class="btn btn-sm btn-outline-dark ms-2 bg-coklapbet text-white" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-paragraf-belajar" src="{{ asset('sounds/materi/paragraf-belajar.mp3') }}"></audio>
                    </p>
                </li>
            </ul>

            {{-- Gambar --}}
            <div class="row text-center my-4">
                <div class="d-flex justify-content-center my-4">
                    <img src="{{ asset('images/materi/susunan-sasi.png') }}" 
                    alt="Gambar Penggaris" 
                    class="rounded shadow" 
                    style="display: block; margin: 0 auto; width: 600px; height: 300px; object-fit: cover;">
                </div>
            </div>

            <ul class="list-group list-group-flush">
                
                <li class="list-group-item bg-transparent">
                    <button onclick="playSound('paragraf-belajar')" class="btn btn-sm btn-outline-dark ms-2 bg-coklapbet text-white" title="Dengarkan">
                        🔊
                    </button>
                    <audio id="audio-paragraf-belajar" src="{{ asset('sounds/materi/paragraf-belajar.mp3') }}"></audio>
                    <p class="mt-2">
                        Kain sasirangan a lebih pendek dari kain sasirangan b.<br>
                        kain sasirangan b lebih pendek dari kain sasirangan c.<br>
                        kain sasirangan a lebih pendek dari kain sasirangan b dan c.<br>
                        kain sasirangan a paling pendek.
                    </p>

                    <p class="mt-2">
                        Kain sasirangan c lebih panjang dari kain sasirangan b.<br>
                        kain sasirangan c lebih panjang dari kain sasirangan a.<br>
                        kain sasirangan c lebih panjang dari kain sasirangan b dan a.<br>
                        kain sasirangan c paling panjang.
                    </p>
                    <p class="mt-2">
                        Kita dapat membandingkan panjang benda.<br>
                        Kita menggunakan kata:<br>
                        • lebih panjang<br>
                        • lebih pendek<br>
                        • paling panjang<br>
                        • paling pendek
                    </p>
                    
                </li>
            </ul>

        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.materi.halaman7') }}" class="btn btn-secondary">← Sebelumnya</a>
            <a href="{{ route('admin.materi.halaman9') }}" class="btn btn-primary">Selanjutnya →</a>
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
