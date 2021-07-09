<template>
    <div>
        <img :src="picture" />
        <h1>Name  : {{ firstName }} {{ lastName }}</h1>
        <h2>Email : {{ email }}</h2>
        <button v-on:click="getUser()"> Get Random user </button>
    </div>
</template>

<script>
   
    export default {
        computed : {},
        data() {
            return {
                firstName : "Adnan",
                lastName  : "Asad",
                email     : "adnanasad@outlook.com",
                gender    : "male",
                picture   : "https://randomuser.me/api/portraits/men/10.jpg"
            }
        },
        methods : {
            async getUser(){
                
                await axios.get('https://randomuser.me/api')
                .then( res => {
                    const { results } = res.data
                        this.firstName = results[0].name.first,
                        this.lastName  = results[0].name.last,
                        this.email     = results[0].email,
                        this.gender    = results[0].gender,
                        this.picture   = results[0].picture.medium
                    } );

            }
        },
        created() {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
        }
    };
</script>


