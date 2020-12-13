import axios from '../axios'
import { authHeader } from '../helpers'
import { config } from '../config'

let precessUrl = function ( url, header = {}, is_admin = false ){
    url = is_admin ?  config.admin_url(url) : config.base_url(url)
    if(is_admin){
        header = { headers: Object.assign(header, authHeader()) };
    }
    return {url: url, header: header}
}

export const http = {
    get: ( url, is_admin = false, header = {}) => {
        let presult = precessUrl(url, header, is_admin);
        return axios.get(presult.url, presult.header);
    },
    post: ( url, is_admin = false, data, header = {} ) => {
        let presult = precessUrl(url, header, is_admin);
        return axios.post(presult.url, data, presult.header)
    },
    put: ( url, data, is_admin = false, header = {} ) => {
        let presult = precessUrl(url, header, is_admin);
        return axios.put(presult.url, data, presult.header)
    },
    delete: ( url, data = {}, is_admin = false, header = {}) => {
        let presult = precessUrl(url, header, is_admin);
        return axios.delete(presult.url, presult.header, data)
    }
}
