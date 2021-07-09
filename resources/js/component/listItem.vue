<template>
    <div class="item">
        <input type="checkbox" 
        @change="updateCheck()"
        v-model="item.completed"
        />
        <span :class="[item.completed ? 'completed' : '', 'itemText' ]"> {{ item.title }} || {{ item.description }}</span>
        <button class="eye" @click="viewItem()">
            <router-link to="/edit"><font-awesome-icon icon="eye" /></router-link>
        </button>
        <button class="trash" @click="removeItem()" > 
            <font-awesome-icon icon="trash" />
        </button>    
    </div>
</template>
<script>
export default {
  props : ['item'],
  methods : {
      removeItem(){
          this.$store.dispatch('todo/deleteTodo', this.item.id);
          this.$store.dispatch('todo/getTodoList');
      },
      viewItem(){
         this.$store.dispatch('todo/setEditID', this.item.id);
      }
  }
}
</script>

<style scoped>
.completed{
    text-decoration: line-through;
    color: #999999;
}
.itemText{
    width : 100%;
    margin-left: 20px;
}
.item{
    display: flex;
    justify-content: center;
    align-items: center;
}
.trash{
    background: #e6e6e6;
    border: none;
    color: #ff0000;
    outline: none;
}
.eye{
    background: #e6e6e6;
    border: none;
    color: black;
    outline: none;
}
</style>