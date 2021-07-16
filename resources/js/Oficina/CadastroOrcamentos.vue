<template>
    <div class="container">
        <!-- Botão para Adicionar Orçamentos-->
        <div class="div text-center">
            <button
                class="btn btn-success btn-lg"
                @click="modaladdorcamentos = true"
            >
                Adicionar Orçamentos
            </button>
        </div>

        <!-- Formulario para filtrar resultados-->
        <div class="input-group-lg p-3">
            <div class="row">
                <div class="col-6">
                    <label class="form-label">Data Inicial</label>
                    <input
                        type="date"
                        class="form-control form-control-lg"
                        v-model="pesquisar.dataincial"
                    />
                    <div v-if="pesquisar.dataincial == ''">
                        <h4 class="text-warning">Escolha uma data Inicial!</h4>
                    </div>
                </div>

                <div class="col-6">
                    <label class="form-label">Data final</label>
                    <input
                        type="date"
                        class="form-control form-control-lg"
                        v-model="pesquisar.datafinal"
                    />
                    <div v-if="pesquisar.datafinal == ''">
                        <h4 class="text-warning">Escolha uma data Final!</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label class="form-label">Pesquise um cliente</label>
                    <input
                        type="text"
                        class="form-control form-control-lg"
                        v-model="pesquisar.cliente"
                        @keyup="pesquisarOrcamentos"
                    />
                </div>
                <div class="col-6">
                    <label class="form-label">Vendedor</label>
                    <select
                        class="form-select form-select-lg"
                        aria-label="Default select example"
                        v-model="pesquisar.vendedor"
                        @change="pesquisarOrcamentos"
                    >
                        <option :value="0">Todos</option>
                        <option
                            v-for="vend in vendedores"
                            :key="vend.id"
                            :value="vend.id"
                        >
                            {{ vend.nome }}
                        </option>
                    </select>
                </div>
            </div>
            <button class="btn btn-lg btn-success" @click="pesquisarOrcamentos">
                Pesquisar
            </button>
        </div>

        <!-- Chamando outra pagina Vue para exibir resultados-->
        <div class="container pt-3">
            <div class="row">
                <orcamentos-card
                    v-for="orc in orcamentos"
                    :key="orc"
                    :orc="orc"
                    @mensagem="exibirMensagem"
                />
            </div>
        </div>
    </div>

    <!-- Modal Adicionar Orçamento-->
    <teleport to="body">
        <transition name="slide-fade">
            <div
                class="modalcard text-capitalize"
                v-if="modaladdorcamentos"
                @click.self="modaladdorcamentos = false"
            >
                <div class="card">
                    <div class="col">
                        <h3 class="text-center">Adicionar Orçamento</h3>
                        <hr width="100%" align="center" />
                    </div>

                    <div class="input-group-lg">
                        <label class="form-label">Vendedor</label>
                        <select
                            class="form-select"
                            aria-label="Default select example"
                            v-model="orcamento.vendedor"
                        >
                            <option selected>Vendedores</option>
                            <option
                                v-for="vend in vendedores"
                                :key="vend.id"
                                :value="vend.id"
                            >
                                {{ vend.nome }}
                            </option>
                        </select>
                        <div v-if="orcamento.vendedor == 'Vendedores'">
                            <h5 class="text-danger">Escolha um Vendedor</h5>
                        </div>
                        <label class="form-label">cliente</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="orcamento.cliente"
                        />
                        <div v-if="orcamento.cliente.length == 0">
                            <h5 class="text-danger">
                                Cliente não pode ficar vazio
                            </h5>
                        </div>
                        <label class="form-label">Valor</label>
                        <input
                            type="number"
                            min="0"
                            class="form-control"
                            v-model="orcamento.valor"
                            required
                        />
                        <div v-if="orcamento.valor.length == 0">
                            <h5 class="text-danger">
                                Valor não pode ficar vazio
                            </h5>
                        </div>
                        <label class="form-label">descricao</label>
                        <textarea
                            class="form-control"
                            v-model="orcamento.descricao"
                        ></textarea>
                    </div>

                    <div class="row p-2">
                        <div class="col pt-1">
                            <button
                                type="button"
                                class="btn btn-warning btn-lg float-end m-1"
                                @click="addOrcamento"
                            >
                                Adicionar
                            </button>
                            <button
                                type="button"
                                class="btn btn-primary btn-lg float-end m-1"
                                @click="modaladdorcamentos = false"
                                href="#top"
                            >
                                fechar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </teleport>
</template>

<script>
import { onMounted, ref } from "vue";
import OrcamentosCard from "./OrcamentosCard.vue";
export default {
    components: { OrcamentosCard },
    emits: ["mensagem"],
    setup(props, context) {
        const modaladdorcamentos = ref(false);
        const orcamento = ref({
            cliente: "",
            vendedor: "Vendedores",
            descricao: "",
            valor: 0,
        });
        const vendedores = ref([]);
        const orcamentos = ref([]);
        const pesquisar = ref({
            dataincial: "",
            datafinal: "",
            cliente: "",
            vendedor: "",
        });
        const fd = new FormData();
        const pesq = new FormData();

        onMounted(() => {
            getVendedor();
            getOrcamento();
        });

        function datahandle(data) {
            let date = new Date(data);
            let dia = date.getDate();
            let mes = date.getMonth();
            let ano = date.getFullYear();
            mes = mes + 1;
            dia = dia + 1;
            if (mes < 10) {
                mes = "0" + mes;
            }
            if (dia < 10) {
                dia = "0" + dia;
            }
            return ano + "-" + mes + "-" + dia;
        }

        const pesquisarOrcamentos = () => {
            let dtinicial = datahandle(pesquisar.value.dataincial);
            let dtfinal = datahandle(pesquisar.value.datafinal);

            console.log(dtinicial, pesquisar.value.dataincial);
            console.log(dtfinal);

            if (pesquisar.value.vendedor == 0) {
                pesquisar.value.vendedor = 0;
            }

            pesq.append("datainicial", dtinicial);
            pesq.append("datafinal", dtfinal);
            pesq.append("cliente", pesquisar.value.cliente);
            pesq.append("vendedor", pesquisar.value.vendedor);

            axios.post("pesquisar", pesq).then((resp) => {
                orcamentos.value = resp.data;
                orcamentos.value.forEach((el) => {
                    const date = new Date(el.created_at);
                    el.data = date.toLocaleString();
                });
            });
        };

        const addOrcamento = () => {
            fd.append("cliente", orcamento.value.cliente);
            fd.append("vendedor", orcamento.value.vendedor);
            fd.append("valor", orcamento.value.valor);
            fd.append("descricao", orcamento.value.descricao);

            axios.post("orcamento", fd).then((resp) => {
                modaladdorcamentos.value = false;
                context.emit("mensagem", resp.data);
                getOrcamento();
            });
        };

        const getVendedor = () => {
            axios.get("vendedor").then((resp) => {
                vendedores.value = resp.data;
            });
        };

        const getOrcamento = () => {
            axios.get("orcamento").then((resp) => {
                orcamentos.value = resp.data;
                orcamentos.value.forEach((el) => {
                    const date = new Date(el.created_at);
                    el.data = date.toLocaleString();
                });
            });
        };

        const exibirMensagem = (mens) => {
            getOrcamento();
            context.emit("mensagem", mens);
        };

        return {
            modaladdorcamentos,
            addOrcamento,
            orcamento,
            vendedores,
            orcamentos,
            pesquisar,
            pesquisarOrcamentos,
            exibirMensagem,
        };
    },
};
</script>

<style></style>
