<template>
    <div class="w-full flex flex-col">
        <HeaderComponent></HeaderComponent>
        <FormComponent :setValorSolicitado="setValorSolicitado" :setSimulacoes="setSimulacoes" v-if="Object.keys(simulacoes).length <= 0"></FormComponent>
        <Simulacoes :setSimulacoes="setSimulacoes" :valorSolicitado="valorSolicitado" v-if="Object.keys(simulacoes).length > 0" :simulacoes="simulacoes"></Simulacoes>
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
     props: {
        setSimulacoes: {
            type: Function,
            required: true
        },
        setValorSolicitado:{
            type: Function,
            required: true
        }
    },
    data() {
        return {
            simulacoes: {},
            valorSolicitado: 0
        };
    },
    methods: {
        setSimulacoes(data) {
            this.simulacoes = data;
        },
        setValorSolicitado(valor) {
            this.valorSolicitado = valor;
        }
    }
}
</script>
