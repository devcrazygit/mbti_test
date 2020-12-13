import { authHelper } from "../../helpers"
import {http} from "../../services/http"
import router from "../../router";
export default {
    state: {},
    getters: {},
    mutations: {},
    actions : {
        login(context, payload){
            if(this.isLoading) return;
            
            http.post('login', false, payload)
                .then( ( response ) => {
                    console.log(response.data.access_token)
                    if(response.data.access_token){
                        authHelper.saveAdminToken(response.data.access_token);
                        router.push('/history')
                    }
                    return;
                })
                .catch( (response )  => {
                    console.log(response)
                    authHelper.removeAdminToken()                    
                    this.dispatch('alerts/error', "Login Failed")
                })
        },
        logout(context){
            authHelper.removeAdminToken();
            router.push({name: "login"});
        }
    }
}