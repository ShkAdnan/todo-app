<template>
    <div> 
        <div v-for="item in items" :key="item.id">
            <listTodo 
                :item="item"
                class="item"
            />
        </div>
    </div>
</template>

<script>

import listTodo from './listItem';

export default ({
   props : ['items'],
   components : {
            listTodo
        }
})
</script>

<style scoped>
.item{
    background: #e6e6e6;
    padding: 5px;
    margin-top: 5px;
}
</style>