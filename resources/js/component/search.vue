<template>
    <div>
        <input v-model="search" type="text" class="search" placeholder="search here"/>
    </div>
</template>

<script>
export default {
    computed : {
        items : {
            get(){
                return this.$store.state.todo.todoList
            }
        } 
    },
    data: () => ({
      search : ""
    }),
    methods : {
        search(){
            
        }
    }
}
</script>

<style scoped>
.search{
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 5px;
    width: 100%;
}
</style>