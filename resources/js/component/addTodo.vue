<template>
    <div class="addItem">
       <input type="text" v-model="item.name" placeholder="title"/>
       <input type="text" v-model="item.description" placeholder="description"/>
       <font-awesome-icon icon="plus-square" :class="[item.name ? 'active' : 'inactive', 'plus' ]"
       @click="addTodo"
       />
    </div>
</template>
<script>


export default({
    data: () => ({
      item : {
          name       : "",
          desription : ""
      }
    }),
    methods : {
         addTodo(){
          if(this.item.name == ''){
              return;
          }else{
              this.$store.dispatch('todo/addTodo', this.item)
              this.$store.dispatch('todo/getTodoList')
          }
      }
    }
})
</script>


<style  scoped>
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