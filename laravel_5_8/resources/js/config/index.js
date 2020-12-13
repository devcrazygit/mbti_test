
const host_url = "/api";

export const config = {
    base_url(url) {
        if(url.startsWith("/")){
            return host_url + url;            
        } else {
            return host_url + '/' + url
        }
    },
    admin_url(url) {
        if(url.startsWith("/")){
            return host_url + "/admin" +url;            
        } else {
            return host_url + '/admin/' + url
        }
    }
}