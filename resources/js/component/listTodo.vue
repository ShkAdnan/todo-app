<template>
    <div>
        <ul id="list">
            <li v-for="todo in todos" :key="todo.title">
                <h3>{{ todo.title }}</h3>
                <h4>{{ todo.description }}</h4>
                <br>
            </li>
        </ul>
    </div>
</template>

<script>
   
    export default {
        computed : {
            todos : {
                get(){
                    return this.$store.state.todo.todoList
                }
            }
        },
        created() {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
            this.$store.dispatch('todo/getTodoList')
        }
    };
</script>

