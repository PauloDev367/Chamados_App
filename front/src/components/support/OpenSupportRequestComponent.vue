<template>
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
          <span class="badge badge-warning">
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
          <span class="badge badge-warning">
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
</template>

<style scoped>
.list-group-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  transition: all 0.3s;
}
.list-group-item:hover {
  background-color: #f7f7f7;
  cursor: pointer;
}
.list-group-item .title-area h3 {
  font-size: 1.2rem;
}
.list-group-item .title-area h4 {
  font-size: 0.9rem;
  font-weight: 400;
  margin-bottom: 0;
}
.list-group-item .title-area .badge {
  padding: 5px;
}
.list-group-item .badges-area .badge {
  margin: 5px;
  margin-bottom: 0;
}
</style>