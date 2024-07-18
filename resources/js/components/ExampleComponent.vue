<template>
    <div class="w-full flex flex-col">
        <HeaderComponent></HeaderComponent>
        <FormComponent :setSimulacoes="setSimulacoes"></FormComponent>
        <Simulacoes v-if="Object.keys(simulacoes).length > 0" :simulacoes="simulacoes"></Simulacoes>
    </div>
</template>

<script>
import FormComponent from './FormComponent.vue';
import HeaderComponent from './HeaderComponent.vue';
import Simulacoes from './Simulacoes.vue';

export default {
    components: {
        HeaderComponent,
        FormComponent,
        Simulacoes
    },
    data() {
        return {
            simulacoes: {}
        };
    },
    methods: {
        setSimulacoes(data) {
            this.simulacoes = data;
        }
    }
}
</script>

<style scoped>
</style>
