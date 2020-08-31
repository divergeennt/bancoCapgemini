import Vue from "vue"
import axios from "axios"

Vue.use({
    install(Vue) {
        Vue.prototype.$http = axios.create({
            baseURL: 'http://127.0.0.1:8000/api/'
        })
    }
});