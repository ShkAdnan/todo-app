import axios from "axios";

const state     = {
    error : {},
    authToken: localStorage.getItem('token') || ''
};
const actions   = {
    loginUser({ commit }, user) {
        axios.post('/api/login',{
            email    : user.email,
            password : user.password
        })
        .then( response => {
            const results  = response.data;

            localStorage.setItem('token', results.response.access_token);
            localStorage.setItem('user_id', results.response.user_id);

            window.location.replace('/')  
        }).catch( err => {
            const results  = err.response.data;
                if(results.statusMessage =='Validation Error'){ 

                    $.each(results.response, function(key, value) {
                        commit('setError', value);
                    });
    
                }
                else if(results.statusMessage =='Authenication Failed'){
                    commit('setError', ["Invalid Email or Password"]);
                }
                    
   
        });
    },
    registerUser({ commit }, user) {
        axios.post('/api/register',{
            email : user.email,
            password : user.password
        })
        .then( response => {
            const results  = response.data;
            if(results){
                localStorage.setItem('currentEmail', user.email);
                window.location.replace('/#/verify')  
            }
        }).catch( err => {
            const results  = err.response.data;
                if(results.statusMessage =='Validation Error'){ 

                    $.each(results.response, function(key, value) {
                        commit('setError', value);
                    });
    
                }
                else if(results.httpCode =='422'){
                    commit('setError', ["This Email is already registered with us please login"]);
                }
        });
    },
    verifyUser({ commit }, user) {
        axios.post('/api/verify',{
            code  : user.code,
            email : localStorage.getItem('currentEmail')
        })
        .then( response => {
            const results  = response.data;
            if(results){
                localStorage.removeItem('currentEmail');
                window.location.replace('/#/login') 
            }
        }).catch( err => {
            const results  = err.response.data;
                if(results.statusMessage =='Validation Error'){ 

                    $.each(results.response, function(key, value) {
                        commit('setError', value);
                    });
    
                }
                else if(results.statusMessage =='Code Verification Failed'){
                    commit('setError', ["Verification code entered is incorrect"]);
                }
        });
    }
    
};
const mutations = {
    setError( state , error){
        state.error = error;
    },
    
};
const getters   = {};

export default {
    namespaced : true,
    state,
    actions,
    mutations,
    getters
}