<template>
    <div class="container boxshadow card text-capitalize pt-3">
        <div class="p-2">
            <add-vendedores @mensagem="exibirMensagem" />
        </div>
        <div class="p-2">
            <cadastro-orcamentos @mensagem="exibirMensagem" />
        </div>
    </div>
</template>

<script>
import AddVendedores from "./Oficina/AddVendedores.vue";
import { ref } from "vue";
import CadastroOrcamentos from "./Oficina/CadastroOrcamentos.vue";
export default {
    components: { AddVendedores, CadastroOrcamentos },
    setup() {
        const mensagem = ref("");
        const exibirMensagem = (mens) => {
            alert(mens + "!");
        };

        return {
            exibirMensagem,
            mensagem,
        };
    },
};
</script>

<style>
.container {
    margin-top: 1rem;
    margin-bottom: 1rem;
}
.boxshadow {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

/*  Modal */
body {
    position: relative;
    background: rgb(219, 219, 219);
}
.modalcard {
    position: fixed;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 56%);
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    scroll-behavior: smooth(0, 0);
}
.modalcard > div {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    width: 40rem;
    font-size: 1.5rem;
}

/* Transição Modal */
.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>
