@extends('layouts.app')

@section('background')
    <img src="{{ asset('.images/pozadie_index3.jpg') }}" alt="pozadie_index" class="background-image">
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div id="carouselExampleCaptions" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('.images/karousel_lozka1.jpg') }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Jednotka intenzívnej starostlivosti</h5>
                                <p>Najnovšie vybavená JIS s kvalifikovaným personálom.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('.images/karousel_stomatolog2.jpg') }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Zubná ambulancia</h5>
                                <p>Profesionálna zubná starostlivosť v každej oblasti.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('.images/karousel_lieky3.jpg') }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Lekáreň</h5>
                                <p>Široký sortiment liekov s odborným poradenstvom pre vaše zdravie.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('.images/karousel_graf4.jpg') }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Moderná technológia</h5>
                                <p>Len tie najnovšie technológie pre presnú liečbu.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Naspäť</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Ďalej</span>
                    </button>
                </div>
            </div>

    </div>

    <div id="map"></div>



@endsection
