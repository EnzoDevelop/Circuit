<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../css/navBar.css" />
    <title>Projet Circuit</title>
  </head>
  <body>
    <div class="navigation">
      <ul>
        <li class="active"> 
          <a href="#">
            <span class="icon"><i class="fa-solid fa-house"></i></span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon"><i class="fa-regular fa-user"></i></span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon"><i class="fa-solid fa-ranking-star"></i></span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon"><i class="fa-solid fa-stopwatch"></i></ion-icon></span>
          </a>
        </li>
        <li>
          <a href="#">
            <span class="icon"><i class="fa-solid fa-gear"></i></span>
          </a>
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
