import { resource_admin_api, Axios } from "./adminApi"
const resource = 'product'

export const productAdd = (payload) => Axios.post(`${resource_admin_api}/${resource}/add`, payload)
export const productEdit = (payload) => Axios.post(`${resource_admin_api}/${resource}/edit`, payload)
export const productList = (payload) => Axios.get(`${resource_admin_api}/${resource}/list`)
export const productGet = (id) => Axios.get(`${resource_admin_api}/${resource}/get/${id}`)