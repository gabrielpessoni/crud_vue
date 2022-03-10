<template>
  <div class="container">
    <div>
      <div class="card">
        <div class="card-header">Clientes</div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="cliente in clientes" :key="cliente.id">
                <td>{{ cliente.id }}</td>
                <td>{{ cliente.nome }}</td>
                <td>{{ cliente.endereco }}</td>
                <td>
                  <div class="btn-group" role="group" aria-label="">
                    <router-link :to="{name:'Editar',params:{id:cliente.id}}" class="btn btn-info">Editar</router-link>
                    <button type="button" v-on:click="apagarCliente(cliente.id)" class="btn btn-danger">Apagar</button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      clientes: [],
    };
  },
  created: function () {
    this.consultarClientes();
  },
  methods: {
    consultarClientes() {
      fetch("http://localhost/clientes/")
        .then((r) => r.json())
        .then((dadosResposta) => {
          console.log(dadosResposta);
          this.clientes = [];
          if (typeof dadosResposta[0].success === "undefined") {
            this.clientes = dadosResposta;
          }
        })
        .catch(console.log);
    },
    apagarCliente(id){
       fetch("http://localhost/clientes/?excluir="+id)
        .then((r) => r.json())
        .then((dadosResposta) => {
          console.log(dadosResposta);
          window.location.href = "listar";
        })
        .catch(console.log);
    }
  },
  
};
</script>

<style>

.btn {
  margin-right: 20px;
}



</style>
