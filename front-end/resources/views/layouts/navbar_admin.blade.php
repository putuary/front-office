<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Resto Randu</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/admin/pesanan">Pesanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/transaksi" tabindex="-1" aria-disabled="true">Transaksi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/riwayat" tabindex="-1" aria-disabled="true">Riwayat</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-fill"></i>
            </a>
            <ul class="dropdown-menu">
              <li class="dropdown-item">{{ auth()->user()->name }}</li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <form action="/admin/logout" method="post">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="bi bi-arrow-right-square"></i> Log out</button>
                </form>

              </li>
            </ul>
          </li>

        </ul>
      </div>
    </div>
  </nav>
</header>