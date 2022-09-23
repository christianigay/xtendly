import axios from "axios";

const baseURL = import.meta.env.VITE_APP_URL;

const httpClient = axios.create({
    baseURL
});

httpClient.interceptors.request.use(function(config) {
    return config;
});
httpClient.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        return Promise.reject(error);
    }
);

export default httpClient;
