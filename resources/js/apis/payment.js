import { resource_admin_api, Axios } from "./adminApi"
const resource = 'payment'

export const payApi = (payload) => Axios.post(`${resource_admin_api}/${resource}/charge`, payload)
export const payApprove = (payload) => Axios.post(`${resource_admin_api}/${resource}/approve`, payload)