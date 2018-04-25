<template>
    <div id="main" class="container-fluid no-padding px-0">
        <Header/>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import Header from './Header.vue';

    export default {
        name: 'main-app',
        components: {Header}
    }
</script>
