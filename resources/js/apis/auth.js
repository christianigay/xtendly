import { resource_admin_api, Axios } from "./adminApi"
const resource = 'auth'

export const apiLogin = (payload) => Axios.post(`${resource_admin_api}/${resource}/login`, payload)
export const apiLogout = () => Axios.post(`${resource_admin_api}/${resource}/logout`)