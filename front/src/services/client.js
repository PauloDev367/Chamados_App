import { API_URL } from "@/constants";
import { SupportRequestStatus } from "@/constants/SupportRequestStatus";
import axios from "axios";

const token = window.localStorage.getItem("token");

export function getClientSupportRequests(page) {
    return axios.get(`${API_URL}/support-requests/client?supportrequest_status=${SupportRequestStatus.PENDENT}&page=${page}`, {
        headers: {
            Authorization: 'Bearer ' + token
        }
    });
}

export function getClientFinishedSupportRequests(page) {
    return axios.get(`${API_URL}/support-requests/client?supportrequest_status=${SupportRequestStatus.FINISHED_BY_CLIENT}&page=${page}`, {
        headers: {
            Authorization: 'Bearer ' + token
        }
    });
}

export function getOneSupportRequest(id) {
    return axios.get(`${API_URL}/support-requests/${id}/client`, {
        headers: {
            Authorization: 'Bearer ' + token
        }
    });
}
export function getSupportRequestMessages(id) {
    return axios.get(`${API_URL}/messages/support-request/${id}`, {
        headers: {
            Authorization: 'Bearer ' + token
        }
    });
}
export function clientFinishSuppportRequest(id) {
    return axios.patch(`${API_URL}/support-requests/${id}/client/finish`, {}, {
        headers: {
            Authorization: 'Bearer ' + token
        }
    });
}
export function clientAddMessageToSupportRequest(id, message) {
    const data = {
        message,
        support_request_id: id
    };

    return axios.post(`${API_URL}/messages/`, data, {
        headers: {
            Authorization: 'Bearer ' + token
        }
    });
}