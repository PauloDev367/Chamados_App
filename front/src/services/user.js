import { API_URL } from "@/constants";
import axios from "axios";

export function login(email, password) {
    return axios.post(`${API_URL}/auth/login`, {
        email, password
    });
}
export function me() {
    const token = window.localStorage.getItem("token");
    return axios.post(`${API_URL}/auth/me`, {}, {
        headers: {
            Authorization: "Bearer " + token
        }
    });
}