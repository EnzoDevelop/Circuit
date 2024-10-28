<?php // tirée de https://getbootstrap.com/docs/5.2/components/navbar/ ?>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="routeur.php?route=accueil">Accueil</a>
        </li>        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Contributions
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="routeur.php?route=listerContribs">Voir toutes</a></li>
            <li><a class="dropdown-item" href="#">Nada</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Nothing</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="routeur.php?route=listerMembres">Membres</a>
        </li>
      </ul>
      <div class="d-flex">
        <a href="../traitements/logout.php"><button class="btn btn-outline-success">Logout</button></a>
      </div>
    </div>
  </div>
</nav>