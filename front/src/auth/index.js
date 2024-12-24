
import { API_URL } from "@/constants";
import axios from "axios";
export default function isAuthenticated() {
    const token = localStorage.getItem('token');
    return axios.post(`${API_URL}/auth/me`, {}, {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json',
        }
    });
}