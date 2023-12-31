<?php

class FrontPage {
    
    //zawartos body main page
    public function __construct() {
        ?>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container px-4 px-lg-5">
                        <a class="navbar-brand" href="index.html">Ogród pełen żab</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Strona główna</a></li>
                                <li class="nav-item"><a class="nav-link" href="register.php">Zarejestruj się</a></li>
                                <li class="nav-item"><a class="nav-link" href="login.php">Zaloguj się</a></li>
                            </ul>

                        </div>
                    </div>
                </nav>
                <!-- Header-->
                <header class="bg-dark py-5" style="background-image: url('img/clovers.jpg')">
                    <div class="container px-4 px-lg-5 my-5">
                        <div class="text-center text-white">
                            <h1 class="display-4 fw-bolder">Blog o roślinach</h1>
                            <p class="lead fw-normal text-white-50 mb-0">Co tydzień nowy artykuł</p>
                        </div>
                    </div>
                </header>
                <!-- Section-->
                <section class="py-5">
                    <div class="container px-4 px-lg-5 mt-5">
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Nowy artykuł!</div>
                                    <img class="card-img-top" src="img/op.png" alt="oplatwa" />
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <h5 class="fw-bolder">Oplątwa</h5>
                                            Roślina bez korzeni.
                                        </div>
                                    </div>
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="https://pl.wikipedia.org/wiki/Opl%C4%85twa">Dowiedz się więcej...</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <img class="card-img-top" src="img/lawenda.png" alt="lawenda" />
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <h5 class="fw-bolder">Lawenda</h5>
                                            Wiecznie zielony krzew na bezsenność.
                                        </div>
                                    </div>
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="https://pl.wikipedia.org/wiki/Lawenda">Dowiedz się więcej...</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <img class="card-img-top" src="img/fiolek.png" alt="..." />
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <h5 class="fw-bolder">Fiołek Afrykański</h5>
                                            Czy jest wymagający?
                                        </div>
                                    </div>
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="https://pl.wikipedia.org/wiki/Fio%C5%82ek">Dowiedz się więcej...</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <img class="card-img-top" src="img/wez.jpg" alt="..." />
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <h5 class="fw-bolder">Sansewieria</h5>
                                            Profesjonalny oczyszczacz powietrza.
                                        </div>
                                    </div>
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="https://pl.wikipedia.org/wiki/Sansewieria">Dowiedz się więcej...</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <img class="card-img-top" src="img/grubosz.png" alt="..." />
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <h5 class="fw-bolder">Grubosz Jajowaty</h5>
                                            Drzewko szczęścia - sukulent na szczęście.
                                        </div>
                                    </div>
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="https://pl.wikipedia.org/wiki/Grubosz_jajowaty">Dowiedz się więcej...</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <img class="card-img-top" src="img/Blus.png" alt="..." />
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <h5 class="fw-bolder">Bluszcz</h5>
                                            Pospolita, urocza roślina do mieszkań.
                                        </div>
                                    </div>
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="https://pl.wikipedia.org/wiki/Bluszcz">Dowiedz się więcej...</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <img class="card-img-top" src="img/ziel.png" alt="..." />
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <h5 class="fw-bolder">Zielistka</h5>
                                            Najmniej wymagający przyjaciel.
                                        </div>
                                    </div>
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="https://pl.wikipedia.org/wiki/Zielistka">Dowiedz się więcej...</a></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col mb-5">
                                <div class="card h-100">
                                    <img class="card-img-top" src="img/nast.jpg" alt="..." />
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <h5 class="fw-bolder">Nasturcja</h5>
                                            Jadalna piękność.
                                        </div>
                                    </div>
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="https://pl.wikipedia.org/wiki/Nasturcja_wi%C4%99ksza">Dowiedz się więcej...</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Footer-->
                <footer class="py-5 bg-dark">
                    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Nina Krawczak 2022</p></div>
                </footer>
                <!-- Bootstrap core JS-->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <?php
    }

}
