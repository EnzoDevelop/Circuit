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
        <div class="indicator"><span></span></div>
      </ul>
    </div>
    <script>
        let list = document.querySelectorAll('.navigation li');
        function activeLink(){
            list.forEach((item) =>
            item.classList.remove('active'));
            this.classList.add('active')
        }

        list .forEach((item) =>
        item.addEventListener('click',activeLink))
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  </body>
</html>
