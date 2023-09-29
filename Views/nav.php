<nav class="navbar navbar-expand-lg bg-transparent">
  <a class="navbar-brand" href="<?= ROOT ?>">
    <img class="logo" src="/Gaan/Midia/svgs/logosite.svg" alt="logo">
  </a>
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?= ROOT ?>">Home</a>
        </li>
        <!-- Menu utente -->
        <?php
        if (isset($_SESSION['user'])) {

          ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="nav-utente" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Utente
          </a>
          <ul class="dropdown-menu dropdown-submenu" aria-labelledby="nav-utente">


            <!-- Submenu dos idosos -->
            <li>
              <a class="dropdown-item nav-link" href="<?= ROOT ?>/idosos">
                  Idosos
                </a>
              </li>
              <!-- Submenu dos familiares -->
              <li>
                <a class="dropdown-item nav-link" href="<?= ROOT ?>/familiares">
                  Familiares
                </a>
              </li>
              <li>
                <a class="dropdown-item nav-link" href="<?= ROOT ?>/idosos/listaEspera">
                  Lista de espera
                </a>
              </li>
              <?php
              if (isset($_SESSION['user'])) {

                ?>
              <li>
                <a class="dropdown-item nav-link" aria-current="page" href="<?= ROOT ?>/Registo">Registar utente</a>
                </li>
                <?php
              }
              ?>
            </ul>
          </li>
          <!-- Link funcionários -->
          <li class="nav-item">
            <a class="nav-link" href="<?= ROOT ?>/funcionarios">Funcionários</a>
          </li>
          <!-- Dropdown menu documentos -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="<?= ROOT ?>/documentos" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Documentos </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item nav-link" href="<?= ROOT ?>/documentos">Ver documentos</a></li>
              <li><a class="dropdown-item nav-link" href="<?= ROOT ?>/documentos/registarDocumento">Registar documentos</a>
              </li>
            </ul>
          </li>
          <?php
        }
        ?>
        <!-- Dropdown menu opções -->
        <?php if (isset($_SESSION['user'])): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="nav-usuario" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
              <?= 'Opções' ?> <!-- Exibe o tipo de usuário -->
            </a>
            <ul class="dropdown-menu" aria-labelledby="nav-usuario">
              <li><a class="dropdown-item nav-link" href="<?= ROOT ?>/perfil">Meu Perfil</a></li>
              <li><a class="dropdown-item nav-link" href="#">Mensagens</a></li>
              <li><a class="dropdown-item nav-link" href="#">Configurações</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item nav-link" href="<?= ROOT ?>/logout">Encerrar Sessão</a></li>
            </ul>
          </li>
        <?php endif; ?>
        <!-- Link API -->
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?= ROOT ?>/apis">API</a>
        </li>
        <!-- Botão de login -->
        <?php
        if (!isset($_SESSION['user'])) {

          ?>
        <li class="nav-item login">
          <a class="nav-link" aria-current="page" href="<?= ROOT ?>/login">Login</a>
          </li>
          <?php
        }
        ?>
      </ul>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>