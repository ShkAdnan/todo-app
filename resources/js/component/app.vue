<template>
        <div>
            <div class="todoContainer">
                <div class="heading">
                    <div class="row">
                    <div class="col-md-6">
                        <h2 id="title">Todo List</h2>
                    </div>
                    <div class="col-md-6">
                        
                    </div>
                    </div>
                        <addTodo></addTodo>
                    </div>
                    <todosList :items="items"> </todosList>
            </div>
        </div>
</template>

<script>
   import todosList from './listView';
   import addTodo from './addTodo';
   import search from './search';


    export default {
        components : {
            todosList,
            addTodo,
            search
        },
        computed : {
            items : {
                get(){
                    return this.$store.state.todo.todoList
                }
            }
        },
        created() {
            if(this.$store.state.currentUser.authToken == ''){
                this.$router.push('/login')
            }
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
            this.$store.dispatch('todo/getTodoList');
        }
    };
</script>

<style  scoped>
.todoContainer{
    width : 500px;
    margin: auto;
}
.heading{
    background: #e6e6e6;
    padding: 10px;
}
#title{
    text-align: center;
}
</style>
