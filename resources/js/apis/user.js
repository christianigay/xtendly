import { resource_admin_api, Axios } from "./adminApi"
const resource = 'user'

export const apiRegister = (payload) => Axios.post(`${resource_admin_api}/${resource}/insert`, payload)
export const apiDetails = (payload) => Axios.get(`${resource_admin_api}/${resource}/details`)