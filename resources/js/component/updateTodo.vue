<template>
        <div class="todoContainer">
            <div class="heading">
                <h2 id="title">Update Todo</h2>
                </div>
                <div class="addItem">
                <input type="text" v-model="items.title" placeholder="title"/>
                <input type="text" v-model="items.description" placeholder="description"/>
                <input type="hidden" v-model="items.id" />
                <button @click="update()">Update</button>
            </div>
        </div>
</template>

<script>
export default {
    computed : {
        items : {
            get(){     
                 return this.$store.state.todo.editObject
            }
        }
    },
    methods : {
        update(){   
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
            this.$store.dispatch('todo/updateTodo', this.items);
        }
    }
}
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
.addItem{
    display: flex;
    justify-content: center;
    align-items: center;
}
input{
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 5px;
    margin-right: 10px;
    width: 100%;
}
.plus{
    font-size: 20px;
}
.active {
    color: #00CE25;
}
.inactive{
    color: #999999;
}
</style>
