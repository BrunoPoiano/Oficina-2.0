<template>
    <div class="col text-center">
        <h1>Oficina 2.0</h1>
    </div>
    <!-- Botão Adicionar Vendedor-->
    <div class="col text-center">
        <button class="btn btn-primary btn-lg" @click="addvendedormodal = true">
            Adicionar Vendedor
        </button>
    </div>

    <!-- Modal Adicionar Vendedor-->
    <teleport to="body">
        <transition name="slide-fade">
            <div
                class="modalcard"
                v-if="addvendedormodal"
                @click.self="addvendedormodal = false"
            >
                <div class="card">
                    <div class="col">
                        <h3 class="text-center">Adicionar Vendedor</h3>
                        <hr width="100%" align="center" />
                    </div>

                    <div class="input-group-lg">
                        <label class="form-label">Nome do Vendedor</label>
                        <input
                            type="text"
                            class="form-control"
                            v-model="vendedor"
                        />
                    </div>
                    <div v-if="vendedor.length == 0">
                        <h5 class="text-danger">Nome não pode ficar vazio</h5>
                    </div>
                    <div class="row p-2">
                        <div class="col pt-1">
                            <button
                                type="button"
                                class="btn btn-warning btn-lg float-end m-1"
                                @click="addVendedor"
                            >
                                Adicionar
                            </button>
                            <button
                                type="button"
                                class="btn btn-primary btn-lg float-end m-1"
                                @click="addvendedormodal = false"
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
import { ref } from "vue";
export default {
    emits: ["mensagem"],
    setup(props, context) {
        const addvendedormodal = ref(false);
        const vendedor = ref("");
        let fd = new FormData();

        const addVendedor = () => {
            fd.append("vendedor", vendedor.value);
            axios.post("vendedor", fd).then((resp) => {
                addvendedormodal.value = false;
                context.emit("mensagem", resp.data);
            });
        };

        return {
            addvendedormodal,
            vendedor,
            addVendedor,
        };
    },
};
</script>

<style></style>
