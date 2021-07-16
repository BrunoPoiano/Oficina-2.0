<template>
    <!-- Card para exibir resultados-->
    <div class="col-6 card card-body p-2">
        <div class="row">
            <div class="col-8">
                <h3>Cliente: {{ orc.cliente }}</h3>
                <h3>Vendedor: {{ orc.nome }}</h3>

                <h3>valor: {{ orc.valor }}</h3>
                <p>descricao: {{ orc.descricao }}</p>
            </div>

            <div class="col text-end">
                <h5>{{ orc.data }}</h5>

                <div class="col d-grid gap-2">
                    <button
                        class="btn btn-danger btn-lg"
                        @click="excluirOrcamento(orc.id)"
                    >
                        Excluir
                    </button>

                    <button
                        class="btn btn-warning btn-lg"
                        @click="orcamentoModal(orc)"
                    >
                        Editar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Orçamento-->
    <teleport to="body">
        <transition name="slide-fade">
            <div
                class="modalcard text-capitalize"
                v-if="modalEditarOrcamento"
                @click.self="modalEditarOrcamento = false"
            >
                <div class="card">
                    <div class="col">
                        <h3 class="text-center">Editar Orçamento</h3>
                        <hr width="100%" align="center" />
                    </div>

                    <div class="input-group-lg">
                        <label class="form-label">Vendedor</label>
                        <select
                            class="form-select"
                            aria-label="Default select example"
                            v-model="editarOrcamento.vendedor"
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
                        <label class="form-label">cliente</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="editarOrcamento.cliente"
                        />
                        <div v-if="editarOrcamento.cliente.length == 0">
                            <h5 class="text-danger">
                                Cliente não pode ficar vazio
                            </h5>
                        </div>
                        <label class="form-label">Valor</label>
                        <input
                            type="number"
                            min="0"
                            class="form-control"
                            v-model="editarOrcamento.valor"
                            required
                        />
                        <div v-if="editarOrcamento.valor.length == 0">
                            <h5 class="text-danger">
                                Valor não pode ficar vazio
                            </h5>
                        </div>
                        <label class="form-label">descricao</label>
                        <textarea
                            class="form-control"
                            v-model="editarOrcamento.descricao"
                            cols="30"
                            rows="10"
                        ></textarea>
                    </div>

                    <div class="row p-2">
                        <div class="col pt-1">
                            <button
                                type="button"
                                class="btn btn-warning btn-lg float-end m-1"
                                @click="editOrcamento"
                            >
                                Editar
                            </button>
                            <button
                                type="button"
                                class="btn btn-primary btn-lg float-end m-1"
                                @click="modalEditarOrcamento = false"
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
import { onMounted, ref } from "@vue/runtime-core";
export default {
    props: ["orc"],
    emits: ["mensagem"],
    setup(props, context) {
        const modalEditarOrcamento = ref(false);
        const editarOrcamento = ref({
            cliente: "",
            vendedor: "",
            descricao: "",
            valor: 0,
        });
        const vendedores = ref([]);

        const getVendedor = () => {
            axios.get("vendedor").then((resp) => {
                vendedores.value = resp.data;
            });
        };

        const excluirOrcamento = (id) => {
            axios.delete("orcamento/" + id).then((resp) => {
                context.emit("mensagem", resp.data);
            });
        };

        const orcamentoModal = (orc) => {
            getVendedor();
            editarOrcamento.value.id = orc.id;
            editarOrcamento.value.cliente = orc.cliente;
            editarOrcamento.value.vendedor = orc.vendedor_id;
            editarOrcamento.value.valor = orc.valor;
            editarOrcamento.value.descricao = orc.descricao;
            modalEditarOrcamento.value = true;
        };

        const editOrcamento = () => {
            axios
                .put("orcamento/" + editarOrcamento.value.id, {
                    cliente: editarOrcamento.value.cliente,
                    vendedor: editarOrcamento.value.vendedor,
                    valor: editarOrcamento.value.valor,
                    descricao: editarOrcamento.value.descricao,
                })
                .then((resp) => {
                    context.emit("mensagem", resp.data);
                    modalEditarOrcamento.value = false;
                });
        };

        return {
            excluirOrcamento,
            orcamentoModal,
            modalEditarOrcamento,
            vendedores,
            editarOrcamento,
            editOrcamento,
        };
    },
};
</script>

<style></style>
