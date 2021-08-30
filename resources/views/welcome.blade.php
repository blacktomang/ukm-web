@section('title', 'Beranda' )
@extends('layouts.web')
@section('navbar')
<a class="navbar-brand" href="#">
    <img src="{{asset('logo.png')}}" alt="" height="30px" width="30px">
</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Beranda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#product">Produk UKM</a>
        <li class="nav-item">
            <a class="nav-link" href="#">Tentang</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('login.index')}}">Gabung</a>
        </li>
    </ul>
    @endsection
    @section('main-content')
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="2000">
                <img src="{{asset('dummy/index.jpeg')}}" class="d-block w-100 h-100" alt="slide 1">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="{{asset('dummy/index1.jpeg')}}" class="d-block w-100 h-100" alt="slide 2">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="{{asset('dummy/index2.jpeg')}}" class="d-block w-100 h-100" alt="slide 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container d-flex flex-column align-items-center mt-5">
        <div class="d-flex flex-column align-items-center">
            <h2>Penggagas UKM Desa Tombolo</h2>
            <p class="text-center w-75">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus perspiciatis magni
                dolorem veritatis dolor quisquam molestias sed incidunt voluptate sapiente.</p>
        </div>
        <div class="row">
            <div class="col-lg">
                <div class="text-center card  border-0 flex-column d-flex align-items-center">
                    <img src="{{asset('dummy/avatar.png')}}" alt="" height="70px" width="70px">
                    <p class="qoute">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas velit pariatur
                        obcaecati perferendis! Aliquid, corporis sit autem voluptate numquam omnis.</p>
                    <p class="name">Lorem, ipsum.</p>

                </div>
            </div>
            <div class="col-lg">
                <div class="text-center card  border-0 flex-column d-flex align-items-center">
                    <img src="{{asset('dummy/avatar.png')}}" alt="" height="70px" width="70px">
                    <p class="qoute">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas velit pariatur
                        obcaecati perferendis! Aliquid, corporis sit autem voluptate numquam omnis.</p>
                    <p class="name">Lorem, ipsum.</p>
                </div>
            </div>
            <div class="col-lg">
                <div class="text-center card  border-0 flex-column d-flex align-items-center">
                    <img src="{{asset('dummy/avatar.png')}}" alt="" height="70px" width="70px">
                    <p class="qoute">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas velit pariatur
                        obcaecati perferendis! Aliquid, corporis sit autem voluptate numquam omnis.</p>
                    <p class="name">Lorem, ipsum.</p>
                </div>
            </div>
        </div>
        <div class="container d-flex flex-column align-items-center mt-5" id="product">
            <div class="d-flex flex-column align-items-center">
                <h2>Product UKM</h2>
            </div>
        <div class="row mt-2">
            <div class="col-lg">
                <div class="card  border-0" title="Klik untuk melihat detail produk">
                    <div class="card-body p-4 mb-3">
                        <img src="{{asset('dummy/tisu.png')}}" alt="" class="img-fluid d-block mx-auto mb-3">
                        <h5> <a href="#" class="text-dark">Awesome product</a></h5>
                       <div class="d-flex mb-2">
                           <div class="d-flex align-items-center"><i class='bx bxs-star' style="color: #f5d442"></i> <span style="font-size:.85rem; color:#5a5a5a">4.5 | Dilihat 12</span></div>
                       </div>
                    <a href="#" class="button detailButton">Rp 100.000.00</a> </div>
                    <a data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" title="Detail" href="https://wa.me/6281217297131?text=Saya%20tertarik%20dengan%20properti%20" target="_blank"
                  class="button buyButton" style="cursor: pointer"> <i class='bx bx-info-circle' ></i></a>  
                </div>
            </div>
            <div class="col-lg">
                <div class="card  border-0" title="Klik untuk melihat detail produk">
                    <div class="card-body p-4 mb-3">
                        <img src="{{asset('dummy/tisu.png')}}" alt="" class="img-fluid d-block mx-auto mb-3">
                        <h5> <a href="#" class="text-dark">Awesome product</a></h5>
                       <div class="d-flex mb-2">
                           <div class="d-flex align-items-center"><i class='bx bxs-star' style="color: #f5d442"></i> <span style="font-size:.85rem; color:#5a5a5a">4.5 | Dilihat 12</span></div>
                       </div>
                      
                   
                    <a href="#" class="button detailButton">Rp 100.000.00</a> </div>
                    <a data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" title="Detail" href="https://wa.me/6281217297131?text=Saya%20tertarik%20dengan%20properti%20" target="_blank"
                  class="button buyButton" style="cursor: pointer"> <i class='bx bx-info-circle' ></i></a>  
                </div>
            </div>
            <div class="col-lg">
                <div class="card  border-0" title="Klik untuk melihat detail produk">
                    <div class="card-body p-4 mb-3">
                        <img src="{{asset('dummy/tisu.png')}}" alt="" class="img-fluid d-block mx-auto mb-3">
                        <h5> <a href="#" class="text-dark">Awesome product</a></h5>
                       <div class="d-flex mb-2">
                           <div class="d-flex align-items-center"><i class='bx bxs-star' style="color: #f5d442"></i> <span style="font-size:.85rem; color:#5a5a5a">4.5 | Dilihat 12</span></div>
                           <div class="d-flex align-items-center"> <p></p></div>
                       </div>
                    </div>
                     <a href="#" class="button detailButton">Rp 100.000.00</a>
                    <a data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" title="Detail" href="https://wa.me/6281217297131?text=Saya%20tertarik%20dengan%20properti%20" target="_blank"
                  class="button buyButton" style="cursor: pointer"> <i class='bx bx-info-circle' ></i></a>  
                </div>
            </div>
        </div>
        <div class="container d-flex flex-column align-items-center mt-5">
    </div>
</div>
</div>
@endsection