<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
@include('front.include.header')

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  layout-without-menu">
        <div class="layout-container">
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('front.include.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-6">
                                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Home /</span> Double Standart Room</h4>
                            </div>
                            <div class="col-6 text-end">
                                <a href="/list-room" class="btn btn-primary">Kembali</a>
                            </div>
                        </div>
                        <!-- Layout Demo -->
                        <div class="row mb-5">
                            <div class="col-md-12 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                 <!-- Bootstrap crossfade carousel -->
                                                 <div id="carouselExample-cf" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
                                                    <ol class="carousel-indicators">
                                                      <li data-bs-target="#carouselExample-cf" data-bs-slide-to="0" class="active"></li>
                                                      <li data-bs-target="#carouselExample-cf" data-bs-slide-to="1"></li>
                                                      <li data-bs-target="#carouselExample-cf" data-bs-slide-to="2"></li>
                                                    </ol>
                                                    <div class="carousel-inner">
                                                      <div class="carousel-item active">
                                                        <img class="d-block w-100" src="../assets/img/elements/kamar.jpg" alt="First slide" />
                                                      </div>
                                                      <div class="carousel-item">
                                                        <img class="d-block w-100" src="../assets/img/elements/kamar.jpg" alt="Second slide" />
                                                      </div>
                                                      <div class="carousel-item">
                                                        <img class="d-block w-100" src="../assets/img/elements/kamar.jpg" alt="Third slide" />
                                                      </div>
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carouselExample-cf" role="button" data-bs-slide="prev">
                                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                      <span class="visually-hidden">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExample-cf" role="button" data-bs-slide="next">
                                                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                      <span class="visually-hidden">Next</span>
                                                    </a>
                                                  </div>
                                                {{-- <img class="card-img-top" src="../assets/img/elements/kamar.jpg"
                                                    alt="Card image cap" /> --}}
                                                {{-- <div class="row mt-2">
                                                    <div class="col-6">
                                                        <img class="card-img-top"
                                                            src="../assets/img/elements/kamar.jpg"
                                                            alt="Card image cap" />
                                                    </div>
                                                    <div class="col-6">
                                                        <img class="card-img-top"
                                                            src="../assets/img/elements/kamar.jpg"
                                                            alt="Card image cap" />
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="col-4">
                                                <h3 class="card-title">Double Standart Room</h3>
                                                <h4 class="card-title">Fasilitas</h4>
                                                <ul class="list-unstyled mt-2">
                                                    <li>
                                                        <ul>
                                                        <li>Free Wifi</li>
                                                        <li>Smoking Room</li>
                                                        <li>Wardrobe</li>
                                                        <li>Table Study</li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                                <h4 class="card-title">Fasilitas Kamar Mandi</h4>
                                                <ul class="list-unstyled mt-2">
                                                    <li>
                                                        <ul>
                                                        <li>K. Mandi Dalam</li>
                                                        <li>Shower</li>
                                                        <li>Kloset Duduk</li>
                                                        
                                                        </ul>
                                                    </li>
                                                </ul>
                                                <h4 class="card-title">Peraturan Khusus Kamar Ini</h3>
                                                <ul class="list-unstyled mt-2">
                                                    <li>
                                                        <ul>
                                                        <li>Tipe ini bisa diisi maks. 2 orang/ kamar</li>
                                                        <li>Tidak untuk pasutri</li>
                                                        <li>Tidak boleh bawa anak</li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                                <hr/>
                                                <div class="row">
                                                    <div class="col-6"> <label>Check In</label>
                                                        <input class="form-control" type="date"></div>
                                                    <div class="col-6"> <label>Check Out</label>
                                                        <input class="form-control" type="date"></div>
                                                   
                                                        <div class="card-title mt-2 mb-0">
                                                            <h5 class="m-0 me-2">Rp. 50.000/Hari</h5>
                                                            <small class="text-muted">Stok Kamar Tersedia</small>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="#" type="button" class="btn btn-success">Booking Sekarang</a>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <h3 class="mt-5">Asrama Lainya</h5>
                            <hr/>
                            <div class="col-md-6 col-lg-3 mb-3">
                                <div class="card h-100">
                                    <img class="card-img-top" src="../assets/img/elements/kamar.jpg"
                                        alt="Card image cap" />
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">
                                            Some quick example text to build on the card title and make up the bulk of
                                            the card's content.
                                        </p>
                                        <a href="javascript:void(0)" class="btn btn-outline-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-3">
                                <div class="card h-100">
                                    <img class="card-img-top" src="../assets/img/elements/kamar.jpg"
                                        alt="Card image cap" />
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">
                                            Some quick example text to build on the card title and make up the bulk of
                                            the card's content.
                                        </p>
                                        <a href="javascript:void(0)" class="btn btn-outline-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-3">
                                <div class="card h-100">
                                    <img class="card-img-top" src="../assets/img/elements/kamar.jpg"
                                        alt="Card image cap" />
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">
                                            Some quick example text to build on the card title and make up the bulk of
                                            the card's content.
                                        </p>
                                        <a href="javascript:void(0)" class="btn btn-outline-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 mb-3">
                                <div class="card h-100">
                                    <img class="card-img-top" src="../assets/img/elements/kamar.jpg"
                                        alt="Card image cap" />
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">
                                            Some quick example text to build on the card title and make up the bulk of
                                            the card's content.
                                        </p>
                                        <a href="javascript:void(0)" class="btn btn-outline-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!--/ Order Statistics -->
                        <!--/ Layout Demo -->
                    </div>
                    <!-- / Content -->
                    <!-- Footer -->
                    @include('front.include.footer')
                    <!-- / Footer -->


                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
    </div>
    <!-- / Layout wrapper -->
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>

</html>
