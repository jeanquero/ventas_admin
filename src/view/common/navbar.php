<nav class="navbar navbar-expand navbar-dark bg-dark" id="navbar">
  <button type="button" id="sidebarCollapse" class="btn btn-dark">
    <i class="fa fa-align-justify"></i>
  </button>
  <button
    class="navbar-toggler"
    type="button"
    data-toggle="collapse"
    data-target="#navbarNav"
    aria-controls="navbarNav"
    aria-expanded="false"
    aria-label="Toggle navigation"
  >
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link"
           id="logout"
          >Logout <span class="sr-only">(current)</span></a
        >
      </li>
    </ul>
  </div>
</nav>
<style>
    #navbar{
        min-height: 55px;
    }
</style>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('logout').addEventListener('click',()=>{
        Swal.fire({
            title: 'Esta seguro que desea cerrar sesión?',
            showCancelButton: true,
            confirmButtonText: 'Continuar',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                localStorage.clear();
                window.location.replace('http://ventas_admin.test/src/view/login');
            }
        })
    })
</script>
