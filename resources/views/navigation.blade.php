<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
          <a class="navbar-brand" href="home">ScrumApp</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="addGroep">Groep aanmaken</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="addLes">Les aanmaken</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="register">Gebruiker toevoegen</a>
              </li>
            </ul>
            <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Logout</button>
            </form>
          </div>
        </div>
    </nav>