<template>
    <div>
        <h1> Register Account </h1>
        <div class="alert alert-danger" role="alert" v-for="error in errors" :key="error">
            {{ error }} 
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" v-model="user.email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" v-model="user.password" placeholder="Password">
        </div>
     
        <button type="submit" @click="register" class="btn btn-primary">Submit</button>
    </div>
</template>

<script>
export default ({
  computed : {
      errors : {
          get(){
              return this.$store.state.currentUser.error
             
          }
      }
  }, 
  data: () => ({
      user : {
          email : "",
          password : ""
      }
  }),
  methods : {
      register(){
          this.$store.dispatch('currentUser/registerUser', this.user)
      }
  },
  created(){
      if(this.$store.state.currentUser.authToken != ''){
            window.location.replace('/');
    }
  }
})
</script>
