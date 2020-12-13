import { authHelper } from './authHelper'

export const authHeader = function(){
    // let token = JSON.parse(localStorage.getItem("token"));
    let token = authHelper.getAdminToken() // localStorage.getItem("token");
    if(token){
        return {
            'Authorization' :   'Bearer ' + token
        }
    }else{
        return {}
    }
}