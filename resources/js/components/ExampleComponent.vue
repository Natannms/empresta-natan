<template>
    <div class="w-full flex flex-col">
        <HeaderComponent></HeaderComponent>
        <FormComponent></FormComponent>
    </div>
</template>

<script>
import FormComponent from './FormComponent.vue';
import HeaderComponent from './HeaderComponent.vue'; // Importe o MeuComponente

export default {
    components: {
        HeaderComponent, // Registre o MeuComponente localmente no componente ExampleComponent
        FormComponent
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>

<style scoped>
/* Estilos específicos do ExampleComponent aqui */
</style>
