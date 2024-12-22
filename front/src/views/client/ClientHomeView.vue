<template>
  <div class="base">
    <main>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="head-view">
              <h2>Meus chamados</h2>
              <button class="chamado">
                <i class="fa-regular fa-square-plus"></i> Abrir chamado
              </button>
            </div>
            <hr />
          </div>
          <div class="col-12">
            <div class="head-content">
              <ul>
                <li>
                  <a href="#" class="active">Chamos abertos</a>
                </li>
                <li>
                  <a href="#">Chamos fechados</a>
                </li>
              </ul>
            </div>
            <div class="body-content">
              <ul class="list-group">
                <li class="list-group-item">
                  <div class="title-area">
                    <h3 class="title">Cras justo odio</h3>
                    <div>
                      <h4>01/01/2024 00:00:00</h4>
                      <span class="badge badge-info">
                        <i class="fa-solid fa-headset"></i> Aguardando supporte
                      </span>
                    </div>
                  </div>

                  <div class="badges-area">
                    <span class="badge badge-danger">Urgência</span>
                    <span class="badge badge-info">Tipo</span>
                    <span class="badge badge-warning">Status</span>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="title-area">
                    <h3 class="title">Dapibus ac facilisis in</h3>
                    <div>
                      <h4>01/01/2024 00:00:00</h4>
                      <span class="badge badge-info">
                        <i class="fa-solid fa-headset"></i> Aguardando supporte
                      </span>
                    </div>
                  </div>

                  <div class="badges-area">
                    <span class="badge badge-danger">Urgência</span>
                    <span class="badge badge-info">Tipo</span>
                    <span class="badge badge-warning">Status</span>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="title-area">
                    <h3 class="title">Morbi leo risus</h3>
                    <div>
                      <h4>01/01/2024 00:00:00</h4>
                      <span class="badge badge-success">
                        <i class="fa-solid fa-user"></i> Aguardando cliente
                      </span>
                    </div>
                  </div>

                  <div class="badges-area">
                    <span class="badge badge-danger">Urgência</span>
                    <span class="badge badge-info">Tipo</span>
                    <span class="badge badge-warning">Status</span>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="title-area">
                    <h3 class="title">Porta ac consectetur ac</h3>
                    <div>
                      <h4>01/01/2024 00:00:00</h4>
                      <span class="badge badge-success">
                        <i class="fa-solid fa-user"></i> Aguardando cliente
                      </span>
                    </div>
                  </div>

                  <div class="badges-area">
                    <span class="badge badge-danger">Urgência</span>
                    <span class="badge badge-info">Tipo</span>
                    <span class="badge badge-warning">Status</span>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="title-area">
                    <h3 class="title">Vestibulum at eros</h3>
                    <div>
                      <h4>01/01/2024 00:00:00</h4>
                      <span class="badge badge-info">
                        <i class="fa-solid fa-headset"></i> Aguardando supporte
                      </span>
                    </div>
                  </div>

                  <div class="badges-area">
                    <span class="badge badge-danger">Urgência</span>
                    <span class="badge badge-info">Tipo</span>
                    <span class="badge badge-warning">Status</span>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>


<style scoped>
.base {
  height: 100vh;
  background-color: #35374b;
}
main {
  padding-top: 40px;
}
main .container {
  background-color: #fff;
  padding: 20px;
}

button.chamado {
  background-color: #720455;
  color: #fff;
  border-radius: 5px;
  border: none;
  padding: 7px 14px;
}

.head-view {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.head-view h2 {
  font-size: 1.6rem;
  margin-bottom: 0;
}

.head-content ul {
  list-style: none;
  padding: 0;
  display: flex;
  justify-content: flex-start;
  align-items: center;
  width: 100%;
  border-bottom: 2px solid rgba(0, 0, 0, 0.1);
}
.head-content ul li a {
  padding: 10px;
  display: inline-block;
  text-decoration: none;
  color: #000;
}
.head-content ul li a:hover,
.head-content ul li a.active {
  border: 2px solid rgba(0, 0, 0, 0.1);
  border-bottom: 0;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}

.body-content .list-group-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  transition: all 0.3s;
}
.body-content .list-group-item:hover {
  background-color: #f7f7f7;
  cursor: pointer;
}
.body-content .list-group-item .title-area h3 {
  font-size: 1.2rem;
}
.body-content .list-group-item .title-area h4 {
  font-size: 0.9rem;
  font-weight: 400;
  margin-bottom: 0;
}
.body-content .list-group-item .title-area .badge{
    padding: 5px;
}
.body-content .list-group-item .badges-area .badge {
  margin: 5px;
  margin-bottom: 0;
}
</style>