<template>
  <div>
    <div class="position-relative">
      <!-- shape Hero -->
      <section class="section-shaped my-0">
        <div class="shape shape-style-1 shape-default shape-skew">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </div>
        <div class="container shape-container" >
          <div class>
            <div class="row">
              <div class="col-lg-6">
                <h4 class="display-3 font-weight-bold text-white">Bem Vindo (a) {{nome}}</h4>
                <div class="row align-items-center">
               
                  <div class="col-sm-9">
                    <h6 class="mb-0 text-white">
                      <strong>Conta: {{conta}}</strong>
                    </h6>
                    <h6 class="mb-0 text-white">
                      <strong>Agência: {{agencia}}</strong>
                    </h6>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 ml-lg-auto">
                <h4 class="display-3 font-weight-bold text-white">Saldo: R$ {{saldoConta}}</h4>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- 1st Hero Variation -->
    </div>
    <section class="section section-lg pt-lg-0 mt--200">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="row row-grid">
              <div class="col-lg-4">
                <card class="border-0" hover shadow body-classes="py-5">
                  <icon name="ni ni-bold-down" type="primary" rounded class="mb-4"></icon>
                  <h6 class="text-primary text-uppercase">Efetue deposito rapido e facil</h6>

                  <base-button
                    href
                    type="primary"
                    class="mt-4 col-lg-12"
                    @click="showFormDepositar"
                  >Depositar</base-button>
                </card>
              </div>

              <div class="col-lg-4">
                <card class="border-0" hover shadow body-classes="py-5">
                  <icon name="ni ni-bold-up" type="success" rounded class="mb-4"></icon>
                  <h6 class="text-success text-uppercase">Efetue saque de forma simples</h6>

                  <base-button
                    href
                    type="success"
                    class="mt-4 col-lg-12"
                    @click="showFormSacar"
                  >Sacar</base-button>
                  <!-- </div> -->
                </card>
              </div>
              <div class="col-lg-4">
                <card class="border-0" hover shadow body-classes="py-5">
                  <icon name="ni ni-check-bold" type="warning" rounded class="mb-4"></icon>
                  <h6 class="text-warning text-uppercase">Histórico de Transações</h6>

                  <base-button
                    href
                    type="warning"
                    class="mt-4 col-lg-12"
                    @click="showFormTransacoes"
                  >TRANSAÇÕES</base-button>
                </card>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container" v-if="divFormSacar">
        <div class="row position-relative" style="margin-top:5%;">
          <div class="col-lg-12">
            <card gradient="secondary" shadow body-classes="p-lg-5">
              <h4 class="mb-1">Infome o valor do Saque</h4>
              <!-- <p class="mt-0">Dados da conta para deposito</p> -->
              <div
                v-if="mensagem"
                role="alert"
                class="alert alert-dismissible"
                :class="[`alert-${tipoMensagem}`]"
              >
                <span class="alert-inner--text">
                  <span>
                    <strong>{{tipo}}!</strong>
                    {{mesagemRetorno}}
                  </span>
                </span>
                <button
                  type="button"
                  data-dismiss="alert"
                  aria-label="Close"
                  class="close"
                  @click="hideAlert"
                >
                  <span aria-hidden="true">×</span>
                </button>
              </div>

              <base-input
                type="text"
                class="mt-4"
                alternative
                placeholder="Valor do Depósito"
                addon-left-icon="ni ni-money-coins"
                v-model="valorSaque"
                v-money="money"
              ></base-input>
              <base-button @click="efetuarSaque" type="default" round block size="lg">Efetuar Saque</base-button>
            </card>
          </div>
        </div>
      </div>

      <div class="container" v-if="divFormDepositar">
        <div class="row position-relative" style="margin-top:5%;">
          <div class="col-lg-12">
            <card gradient="secondary" shadow body-classes="p-lg-5">
              <h4 class="mb-1">Infome o valor do Depósito</h4>

              <!-- <p class="mt-0">Dados da conta para deposito</p> -->
              <!-- <div v-model="divMensagem"> -->
              <div
                v-if="mensagem"
                role="alert"
                class="alert alert-dismissible"
                :class="[`alert-${tipoMensagem}`]"
              >
                <span class="alert-inner--text">
                  <span>
                    <strong>{{tipo}}!</strong>
                    {{mesagemRetorno}}
                  </span>
                </span>
                <button
                  type="button"
                  data-dismiss="alert"
                  aria-label="Close"
                  class="close"
                  @click="hideAlert"
                >
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <!-- <div v-else role="alert" class="alert alert-warning alert-dismissible"><span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span><span class="alert-inner--text"><span><strong>Warning!</strong> This is a warning alert—check it out!</span></span><button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true">×</span></button></div> -->
              <!-- </div> -->
              <base-input
                type="text"
                class="mt-4"
                alternative
                placeholder="Valor do Depósito"
                addon-left-icon="ni ni-money-coins"
                v-model="valorDeposito"
                v-money="money"
              ></base-input>

              <base-button
                @click="efetuarDeposito"
                type="default"
                round
                block
                size="lg"
              >Efetuar Deposito</base-button>
            </card>
          </div>
        </div>
      </div>

      <div class="container" v-if="divFormTransacoes">
        <div class="row position-relative" style="margin-top:5%;">
          <div class="col-lg-12">
            <card gradient="secondary" shadow body-classes="p-lg-5">
              <h4 class="mb-1">Histórico das transações</h4>

              <!-- <table class="table">
                <tr v-for="row in dadosTransacao">
                  <td v-for="(value, key) in row">{{ key }} : {{ value }}</td>
                </tr>
              </table> -->
              <table id="tableTransacoes">
                <tr>
                  <th>Id</th>
                  <th>Valor</th>
                  <th>Tipo Transação</th>
                  <th>Data</th>
                </tr>
                <tr v-for="dados in dadosTransacao">
                <td v-for="(value, key) in dados"> {{ value }}</td>
                </tr>
              </table>
            </card>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import { VMoney } from "v-money";
export default {
  name: "home",

  components: {},
  data() {
    return {
      //Simulando usuário logado
      nome: "",
      codigoContaCorrente: 1,
      codigoBanco: 1,
      codigoConta: 1,
      codigoCliente: 1,
      //Simulando usuário logado
      conta: "",
      agencia: "",
      valorTransacao: "",
      divFormSacar: false,
      divFormDepositar: false,
      divFormTransacoes: false,
      valorDeposito: "",
      valorSaque: "",
      saldoConta: "",
      mensagem: false,
      tipoMensagem: "",
      tipo: "",
      dadosTransacao: "",
      money: {
        decimal: ",",
        thousands: ".",
        prefix: "R$ ",
        precision: 2,
        masked: false
      }
    };
  },
  directives: { money: VMoney },
  methods: {
    efetuarDeposito() {
      this.$http
        .post("/transacao/deposito/", {
          codigoContaCorrente: this.codigoContaCorrente,
          codigoBanco: this.codigoBanco,
          codigoConta: this.codigoConta,
          codigoCliente: this.codigoCliente,
          valorTransacao: this.valorDeposito
        })
        .then(retorno => {
          if (retorno.data.erro != "S") {
            (this.mensagem = true), (this.tipoMensagem = "success");
            this.tipo = "Sucesso";
            this.mesagemRetorno = retorno.data.mensagem;
            this.valorDeposito = "";
            this.getSaldo();
          } else {
            this.mensagem = true;
            this.tipoMensagem = "info";
            this.tipo = "Atenção";
            this.mesagemRetorno = retorno.data.mensagem;
          }
        })
        .catch(error => {
          console.log(error);
          alert("Resposta indevida de requisição");
        });
    },

    efetuarSaque() {
      this.$http
        .post("/transacao/saque/", {
          codigoContaCorrente: this.codigoContaCorrente,
          codigoBanco: this.codigoBanco,
          codigoConta: this.codigoConta,
          codigoCliente: this.codigoCliente,
          valorTransacao: this.valorSaque
        })
        .then(retorno => {
          // console.log(retorno);

          if (retorno.data.erro != "S") {
            (this.mensagem = true), (this.tipoMensagem = "success");
            this.tipo = "Sucesso";
            this.mesagemRetorno = retorno.data.mensagem;
            this.valorSaque = 0;
            this.getSaldo();
          } else {
            this.mensagem = true;
            this.tipoMensagem = "info";
            this.tipo = "Atenção";
            this.mesagemRetorno = retorno.data.mensagem;
          }
        })
        .catch(error => {
          console.log(error);
          alert("Resposta indevida de requisição");
        });
    },

    showFormDepositar() {
      this.divFormDepositar = !this.divFormDepositar;
      this.divFormSacar = false;
      this.divFormTransacoes = false;
      this.mensagem = false;
    },
    showFormSacar() {
      this.divFormSacar = !this.divFormSacar;
      this.divFormDepositar = false;
      this.divFormTransacoes = false;
      this.mensagem = false;
    },
    showFormTransacoes() {
      this.getHistoricoTransacao();
    },

    getSaldo() {
      this.$http
        .get(
          "/conta/saldo/" +
            this.codigoContaCorrente +
            "/" +
            this.codigoBanco +
            "/" +
            this.conta
        )
        .then(retorno => {
          this.saldoConta = retorno.data.saldo;
        })
        .catch(error => {
          console.log("Resposta indevida de requisição");
        });
    },
    getDadosConta() {
      this.$http
        .get(
          "/conta/data/" +
            this.codigoCliente +
            "/" +
            this.codigoConta
        )
        .then(retorno => {
          console.log(retorno);
          var data = retorno.data.dadosConta["0"];
          this.nome = data.nomeCliente;
          this.saldoConta = retorno.data.saldoFormatado;
          this.conta = data.conta;
          this.codigoContaCorrente = data.id;
          this.agencia = data.agencia;
          this.codigoBanco = data.banco_id;
        })
        .catch(error => {
          console.log("Resposta indevida de requisição");
        });
    },
    getHistoricoTransacao() {
      this.$http
        .get(
          "/transacao/show/" +
            this.codigoContaCorrente +
            "/" +
            this.codigoBanco +
            "/" +
            this.codigoCliente
        )
        .then(retorno => {
          console.log(retorno.data);
        
          this.divFormTransacoes = !this.divFormTransacoes;
          this.divFormDepositar = false;
          this.divFormSacar = false;
          this.mensagem = false;
          this.dadosTransacao = retorno.data;
        })
        .catch(error => {
          console.log("Resposta indevida de requisição");
        });
    },
    hideAlert() {
      this.mensagem = false;
    }
  },

  mounted() {
    this.getDadosConta();
  }
};
</script>




<style>
#tableTransacoes {
  margin-top: 5%;
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#tableTransacoes td,
#tableTransacoes th {
  border: 1px solid #2dce89;
  padding: 8px;
}

#tableTransacoes tr:nth-child(even) {
  background-color: #f2f2f2;
}

#tableTransacoes tr:hover {
  background-color: #ddd;
}

#tableTransacoes th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #2dce89;
  color: white;
}
.section-shaped .shape.shape-skew + .shape-container {
    padding-top: 7rem !important;
    padding-bottom: 19rem;
}
</style>
