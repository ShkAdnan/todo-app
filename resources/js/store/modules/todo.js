import axios from "axios";

const state     = {
    todoList : {},
    editObject : {}
};
const actions   = {
    addTodo({ commit }, todo) {
        axios.post('/api/todo',{
            title : todo.name,
            description : todo.description
        })
        .then( response => {
            const results  = response.data;

            console.log(results); 
        }).catch( err => {                    
            console.log(err);
        });
    },
    async getTodoList({ commit }){
        await axios.get('/api/todo')
        .then( res => {
            const results  = res.data
            commit('getTodo', results.response)
        }).catch(err => {
            localStorage.removeItem('token')
        })
    },

    updateTodo({ commit } , items){
        axios.post('/api/todo/update',{
            todo_id     : items.id,
            user_id     : localStorage.getItem('user_id'), 
            name        :  items.title,
            description : items.description
        })
        .then( response => {
            const results  = response.data;

            console.log(results); 
        }).catch( err => {                    
            console.log(err);
        });
    },
    async setEditID( {commit} , id){
        await axios.post('/api/todo/edit',{
                todo_id : id
        })
        .then( res => {
                const results  = res.data;
                commit('setTodoEditId' , results.response);
        } );
    },
    deleteTodo( {commit} , id){
        axios.post('/api/todo/delete',{
                todo_id : id,
                user_id : localStorage.getItem('user_id')
        })
        .then( res => {
                const results  = res.data;
        });
    }      
};
const mutations = {
    getTodo( state, todos){
        state.todoList = todos
    },
    setTodoEditId( state, response){
        state.editObject = response
    }
};
const getters   = {};

export default {
    namespaced : true,
    state,
    actions,
    mutations,
    getters
}