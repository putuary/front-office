<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Resto Randu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Katalog </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="/makanan">Foods</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/minuman">Drinks</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/dessert">Dessert</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/keranjang/2">Keranjang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/riwayat" tabindex="-1" aria-disabled="true">Riwayat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/fasilitas" tabindex="-1" aria-disabled="true">Fasilitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/feedback" tabindex="-1" aria-disabled="true">Feedback</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/meja" tabindex="-1" aria-disabled="true"><span class="iconify" data-icon="ic:baseline-table-restaurant" style="color: #699bf7;"></span> Meja <span id="meja"></span></div> </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script> document.getElementById("meja").innerHTML=window.localStorage.getItem('no_meja')</script>
</header>