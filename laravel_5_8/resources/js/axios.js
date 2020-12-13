import axios from 'axios';

const base_url = '/api/';

axios.defaults.withCredentials = true;

export default axios.create({
    base_url
})