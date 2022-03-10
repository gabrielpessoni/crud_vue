<template>
  <div class="container">
    <div class="card">
      <div class="card-header">Editar cliente</div>
      <div class="card-body">
        <form v-on:submit.prevent="atualizarRegistro">
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
            <button type="submit" class="btn btn-danger">Alterar</button>
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
  created:function() {
    this.obterInfoId();
  },
  methods: {
    obterInfoId() {
      fetch("http://localhost/clientes/?consultar="+this.$route.params.id)
        .then((r) => r.json())
        .then((dadosResposta) => {
          console.log(dadosResposta);
          this.cliente = dadosResposta[0];
        })
        .catch(console.log);
    },
    atualizarRegistro() {
       var dadosEnviar={id: this.$route.params.id, nome:this.cliente.nome,endereco:this.cliente.endereco}
      
      fetch("http://localhost/clientes/?atualizar="+this.$route.params.id,{
        method:"POST",
        body:JSON.stringify(dadosEnviar)
      })
        .then(resposta => resposta.json())
        .then((dadosResposta) => {
          console.log(dadosResposta);
          window.location.href = '../listar'
        })

    }
  },
}
</script>

<style>

</style>