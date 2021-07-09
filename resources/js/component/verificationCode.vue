<template>
    <div>
        <h1> Please check your provided email and enter verification code </h1>
        <div class="alert alert-danger" role="alert" v-for="error in errors" :key="error">
            {{ error }} 
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Code</label>
            <input type="text" class="form-control" id="exampleInputEmail1" v-model="user.code"  placeholder="Enter Verification Code">
        </div>
    
        <button type="submit" @click="verify" class="btn btn-primary">Verify</button>
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
          code: "",
      }
  }),
  methods : {
      verify(){
          this.$store.dispatch('currentUser/verifyUser', this.user)
      }
  },
  created(){
      if(this.$store.state.currentUser.authToken != ''){
            window.location.replace('/');
    }
  }
})
</script>
