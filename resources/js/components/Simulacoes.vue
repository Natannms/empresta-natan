<template>
    <div class="w-full mx-auto py-10 px-4 mt-4 bg-green-500">
        <h2 class="text-xl font-bold mb-4">Simulações</h2>
        <div v-if="simulacoes.PAN">
            <h3 class="text-lg font-semibold">PAN</h3>
            <ul>
                <li v-for="item in simulacoes.PAN" :key="item.taxa">
                    Taxa: {{ item.taxa }}%, Parcelas: {{ item.parcelas }}, Valor da Parcela: {{ item.valor_parcela }}, Convênio: {{ item.convenio }}
                </li>
            </ul>
        </div>
        <div v-if="simulacoes.OLE">
            <h3 class="text-lg font-semibold">OLE</h3>
            <ul>
                <li v-for="item in simulacoes.OLE" :key="item.taxa">
                    Taxa: {{ item.taxa }}%, Parcelas: {{ item.parcelas }}, Valor da Parcela: {{ item.valor_parcela }}, Convênio: {{ item.convenio }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        simulacoes: {
            type: Object,
            default: () => ({})
        }
    }
};
</script>

<style scoped>
/* Estilos específicos do Simulacoes aqui */
</style>
