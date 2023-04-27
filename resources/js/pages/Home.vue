<template>
    <div class="mx-3">
        <h1>Welcome {{ user  }} </h1>
    </div>
</template>

<script>
export default {
    data(){
        return {
            user : null
        }
    },
    mounted() {
        this.$store.dispatch('initialized', localStorage.getItem('access_token'))
        this.user = this.$store.getters.getUser.name
    },
}
</script>

<style>

</style>