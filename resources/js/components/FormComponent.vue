<template>
    <div class="container mx-auto p-4 bg-warning">
        <h1 class="text-center text-2xl font-bold mb-4">Formulário de Empréstimo</h1>
        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <label for="valorEmprestimo" class="block text-gray-700">Valor do Empréstimo</label>
                <input type="text" id="valorEmprestimo" v-model="valorEmprestimo"
                    class="mt-1 p-2 block w-full border rounded" required />
            </div>
            <div class="mb-4">
                <label for="instituicao" class="block text-gray-700">Instituição</label>
                <div class="flex">
                    <select id="instituicao" v-model="instituicaoSelecionada"
                        class="mt-1 p-2 block w-full border rounded">
                        <option v-for="instituicao in instituicoes" :key="instituicao.chave" :value="instituicao.chave">
                            {{ instituicao.valor }}
                        </option>
                    </select>
                    <button type="button" @click="adicionarInstituicao"
                        class="bg-blue-500 text-white p-2 rounded ml-2">+</button>
                </div>
                <div class="mt-2">
                    <span v-for="instituicao in instituicoesSelecionadas" :key="instituicao"
                        class="bg-gray-200 p-1 rounded mr-2 cursor-pointer" @click="removerInstituicao(instituicao)">
                        {{ instituicao }}
                    </span>
                </div>
            </div>
            <div class="mb-4">
                <label for="convenio" class="block text-gray-700">Convênio</label>
                <div class="flex">
                    <select id="convenio" v-model="convenioSelecionado" class="mt-1 p-2 block w-full border rounded">
                        <option v-for="convenio in convenios" :key="convenio.chave" :value="convenio.chave">
                            {{ convenio.valor }}
                        </option>
                    </select>
                    <button type="button" @click="adicionarConvenio"
                        class="bg-blue-500 text-white p-2 rounded ml-2">+</button>
                </div>
                <div class="mt-2">
                    <span v-for="convenio in conveniosSelecionados" :key="convenio"
                        class="bg-gray-200 p-1 rounded mr-2 cursor-pointer" @click="removerConvenio(convenio)">
                        {{ convenio }}
                    </span>
                </div>
            </div>
            <div class="mb-4">
                <label for="parcelas" class="block text-gray-700">Parcelas</label>
                <select id="parcelas" v-model="parcelasSelecionadas" class="mt-1 p-2 block w-full border rounded">
                    <option v-for="parcela in parcelas" :key="parcela" :value="parcela">
                        {{ parcela }}
                    </option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Enviar</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            valorEmprestimo: '',
            instituicoes: [],
            convenios: [],
            parcelas: [36, 48, 60, 72, 84],
            instituicaoSelecionada: '',
            convenioSelecionado: '',
            instituicoesSelecionadas: [],
            conveniosSelecionados: [],
            parcelasSelecionadas: null
        };
    },
    mounted() {
        this.fetchInstituicoes();
        this.fetchConvenios();
    },
    methods: {
        fetchInstituicoes() {
            axios.get('/api/instituicao').then(response => {
                this.instituicoes = response.data;
            });
        },
        fetchConvenios() {
            axios.get('/api/convenio').then(response => {
                this.convenios = response.data;
            });
        },
        adicionarInstituicao() {
            if (this.instituicaoSelecionada && !this.instituicoesSelecionadas.includes(this.instituicaoSelecionada)) {
                this.instituicoesSelecionadas.push(this.instituicaoSelecionada);
                this.instituicaoSelecionada = '';
            }
        },
        adicionarConvenio() {
            if (this.convenioSelecionado && !this.conveniosSelecionados.includes(this.convenioSelecionado)) {
                this.conveniosSelecionados.push(this.convenioSelecionado);
                this.convenioSelecionado = '';
            }
        },
        removerInstituicao(instituicao) {
            this.instituicoesSelecionadas = this.instituicoesSelecionadas.filter(item => item !== instituicao);
        },
        removerConvenio(convenio) {
            this.conveniosSelecionados = this.conveniosSelecionados.filter(item => item !== convenio);
        },
        submitForm() {
            const formData = {
                valor_emprestimo: parseFloat(this.valorEmprestimo.replace(/[^0-9.-]+/g, '')),
                instituicoes: this.instituicoesSelecionadas.map(instituicao => instituicao),
                convenios: this.conveniosSelecionados.map(convenio => convenio),
                parcelas: this.parcelasSelecionadas
            };

            if(this.instituicoesSelecionadas.length <= 0){

            }

            console.log('Dados do Formulário:', formData);

            console.log('Instituições Selecionadas:', this.instituicoesSelecionadas);
            console.log('Convênios Selecionados:', this.conveniosSelecionados);
        }
    }
};
</script>

<style scoped>
.bg-warning {
    background-color: yellow !important;
}

.text-center {
    text-align: center;
}

.cursor-pointer {
    cursor: pointer;
}
</style>
