require("./bootstrap");

import { createApp } from "vue";
import Oficina from "./Oficina.vue";

const app = createApp({});
app.component("oficina", Oficina).mount("#app");
