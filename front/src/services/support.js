import { API_URL } from "@/constants";
import { SupportRequestStatus } from "@/constants/SupportRequestStatus";
import axios from "axios";

const token = window.localStorage.getItem("token");

export function getNewSupportRequests(page) {
    return axios.get(`${API_URL}/support-requests?supportrequest_status=${SupportRequestStatus.PENDENT}&page=${page}`, {
        headers: {
            Authorization: 'Bearer ' + token
        }
    });
}

export function getInProgressSupportRequests(page) {
    return axios.get(`${API_URL}/support-requests?supportrequest_status=${SupportRequestStatus.IN_PROGRESS}&page=${page}`, {
        headers: {
            Authorization: 'Bearer ' + token
        }
    });
}

export function getFinishedSupportRequests(page) {
    return axios.get(`${API_URL}/support-requests?supportrequest_status=${SupportRequestStatus.FINISHED_BY_CLIENT}&page=${page}`, {
        headers: {
            Authorization: 'Bearer ' + token
        }
    });
}

export function getOneSupportRequest(id) {
    return axios.get(`${API_URL}/support-requests/${id}`, {
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
export function supportGetSuppportRequest(id) {
    return axios.patch(`${API_URL}/support-requests/${id}/manage`, {}, {
        headers: {
            Authorization: 'Bearer ' + token
        }
    });
}


