<template>
    <v-card>
        <v-toolbar flat color="transparent">
            <v-toolbar-title>{{titulo}}</v-toolbar-title>
        </v-toolbar>
        <v-divider/>
        <v-card-text>
            <slot></slot> 
        </v-card-text>       
    </v-card>
</template>

<script>
export default {
    props:['titulo']
}
</script>

<style>

</style>
