<template>
  <div class="container">
    <div class="card">
      <div class="card-header">Criar novo cliente</div>
      <div class="card-body">
        <form v-on:submit.prevent="adicionarRegistro">
          <div class="form-group">
            <label for="nome">Nome: </label>
            <input
              type="text"
              class="form-control"
              required
              name="nome"
              v-model="cliente.nome"
              id="nome"
              aria-describedby="helpId"
              placeholder="Nome"
            />
            <small id="helpId" class="form-text text-muted">Escreva o nome do cliente</small>
          </div>

          <div class="form-group">
            <label for="">Endereço</label>
            <input
              type="text"
              class="form-control"
              required
              name="endereco"
              v-model="cliente.endereco"
              id="endereco"
              aria-describedby="helpId"
              placeholder="Endereço"
            />
            <small id="helpId" class="form-text text-muted"
              >Escreva o endereço respectivo</small
            >
          </div>
          <div class="btn-group" role="group" aria-label="">
            <button type="submit" class="btn btn-success">Adicionar</button>
            <router-link :to="{name:'Listar'}" class="btn btn-warning">Cancelar</router-link>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cliente: {},
    };
  },
  methods: {
     adicionarRegistro() {
       console.log(this.cliente);
       var dadosEnviar={nome:this.cliente.nome,endereco:this.cliente.endereco}
      
      fetch("http://localhost/clientes/?inserir=1",{
        method:"POST",
        body:JSON.stringify(dadosEnviar)
      })
        .then(resposta => resposta.json())
        .then((dadosResposta) => {
          console.log(dadosResposta);
          window.location.href = 'listar'
        })
        .catch(console.log);
    },
   
  
  },
};
</script>

<style scoped>
.btn {
  margin: 20px;
}

</style>
