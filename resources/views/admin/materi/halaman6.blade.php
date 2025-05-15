@extends('layouts.master')

@section('content')

    <div class="card bg-coklat">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Pengukuran</h4>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                

                <li class="list-group-item bg-transparent">
                    <div class="d-flex align-items-start justify-content-between">
                        <h6 class="fw-bold mb-0">Ayo Belajar</h6>
                        <button onclick="playSound('ayo-belajar')" class="btn btn-sm btn-outline-dark bg-coklapbet text-white" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-ayo-belajar" src="{{ asset('sounds/materi/ayo-belajar.mp3') }}"></audio>
                    </div>

                    <p class="mt-2">
                        Membandingkan ukuran berarti melihat perbedaan antara dua atau lebih benda berdasarkan panjang, pendek, tinggi, atau rendahnya. Dengan membandingkan, kita bisa mengetahui mana benda yang lebih panjang, lebih pendek, lebih tinggi, atau lebih rendah.  Perhatikan contoh berikut.
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
                    <img src="{{ asset('images/materi/susunan-foto-banjar.png') }}" 
                    alt="Gambar Penggaris" 
                    class="rounded shadow" 
                    style="display: block; margin: 0 auto; width: 600px; height: 300px; object-fit: cover;">
                </div>
            </div>

            <ul class="list-group list-group-flush">
                

                <li class="list-group-item bg-transparent">

                    <p class="mt-2">
                        Kita akan membandingkan tinggi lukisan khas kalimantan yang digantung yaitu c dan d.
                        <button onclick="playSound('paragraf-belajar')" class="btn btn-sm btn-outline-dark ms-2 bg-coklapbet text-white" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-paragraf-belajar" src="{{ asset('sounds/materi/paragraf-belajar.mp3') }}"></audio>
                    </p>

                    <p class="mt-2">
                        Lukisan c lebih tinggi dari lukisan d.
                        <button onclick="playSound('paragraf-belajar')" class="btn btn-sm btn-outline-dark ms-2 bg-coklapbet text-white" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-paragraf-belajar" src="{{ asset('sounds/materi/paragraf-belajar.mp3') }}"></audio>
                    </p>
                    <p class="mt-2">
                        Lukisan d lebih rendah dari lukisan c.
                        <button onclick="playSound('paragraf-belajar')" class="btn btn-sm btn-outline-dark ms-2 bg-coklapbet text-white" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-paragraf-belajar" src="{{ asset('sounds/materi/paragraf-belajar.mp3') }}"></audio>
                    </p>
                    <p class="mt-2">
                        Kita dapat membandingkan tinggi dua benda.
                        Kita menggunakan kata:<br>
                        • lebih tinggi<br>
                        • lebih rendah
                        <button onclick="playSound('paragraf-belajar')" class="btn btn-sm btn-outline-dark ms-2 bg-coklapbet text-white" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-paragraf-belajar" src="{{ asset('sounds/materi/paragraf-belajar.mp3') }}"></audio>
                    </p>
                    <p class="mt-2">
                        Kita akan membandingkan tinggi lukisan b dan c.
                        <button onclick="playSound('paragraf-belajar')" class="btn btn-sm btn-outline-dark ms-2 bg-coklapbet text-white" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-paragraf-belajar" src="{{ asset('sounds/materi/paragraf-belajar.mp3') }}"></audio>
                    </p>
                    <p class="mt-2">
                        Lukisan b sama tinggi dengan lukisan c.
                        <button onclick="playSound('paragraf-belajar')" class="btn btn-sm btn-outline-dark ms-2 bg-coklapbet text-white" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-paragraf-belajar" src="{{ asset('sounds/materi/paragraf-belajar.mp3') }}"></audio>
                    </p>
                    <p class="mt-2">
                        Dua benda ada yang sama tingginya. Kita menggunakan kata sama tinggi untuk membandingkannya.
                        <button onclick="playSound('paragraf-belajar')" class="btn btn-sm btn-outline-dark ms-2 bg-coklapbet text-white" title="Dengarkan">
                            🔊
                        </button>
                        <audio id="audio-paragraf-belajar" src="{{ asset('sounds/materi/paragraf-belajar.mp3') }}"></audio>
                    </p>
                </li>
            </ul>

        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.materi.halaman5') }}" class="btn btn-secondary">← Sebelumnya</a>
            <a href="{{ route('admin.materi.halaman7') }}" class="btn btn-primary">Selanjutnya →</a>
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
