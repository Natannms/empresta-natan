<template>
    <div class="w-full mx-auto py-10 mt-4 mb-4">
        <div class="w-full flex flex-row w-full justify-between items-center border-b-gray-500/50 px-2">
            <h2 class="text-xl font-bold mb-4">Simulações</h2>
            <button @click="back" class="flex flex-row items-center justify-between gap-4">
                <span class="material-symbols-outlined text-white  bg-[#ffa600]">arrow_back</span>
                Nova Simulação
            </button>
        </div>
        <hr class="mb-6">
        <div v-for="(items, key) in simulacoes" :key="key" class="flex flex-col gap-4 lg:items-center">
            <div v-for="item in items" :key="item.taxa" class="p-1 bg-white mt-2 lg:w-8/12">
                <div class="flex-row flex gap-2 justify-center items-center rounded-xl shadow border">
                    <h3 class="text-lg font-semibold w-3/12">{{ key }}</h3>
                    <ul>
                        <li>Valor Solicitado: RS{{ valorSolicitado.toFixed(2) }}</li>
                        <li>Taxa: {{ item.taxa }}%</li>
                        <li>Parcelas: {{ item.parcelas }}</li>
                        <li><strong>Valor Total</strong>: <strong class="text-[#ffa600]">R${{ (item.valor_parcela * item.parcelas).toFixed(2) }}</strong></li>
                        <li> Convênio: {{ item.convenio }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        simulacoes: {
            type: Object,
            default: () => ({})
        },

        setSimulacoes: {
            type: Function,
            required: true
        },
        valorSolicitado:{
            type: Number,
            default: () => ({})
        }
    },
    methods: {
        back() {
            this.setSimulacoes({})
        }
    },
    mounted() {

    }
};
</script>
