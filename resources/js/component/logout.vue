<template>
    
</template>
<script>
export default {
     created() {
           
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
            this.$store.dispatch('currentUser/logout');
            this.$router.push('/login')
        }
}
</script>