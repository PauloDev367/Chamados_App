import { SupportRequestStatus } from "./SupportRequestStatus";

export class SupportRequestStatusFormatter {

    static getBadgeColor(status) {
        if (status == SupportRequestStatus.PENDENT) {
            return "badge-warning";
        }
        if (status == SupportRequestStatus.IN_PROGRESS) {
            return "badge-info";
        }
        if (status == SupportRequestStatus.FINISHED_BY_CLIENT) {
            return "badge-success";
        }
        if (status == SupportRequestStatus.FINISHED_BY_SUPPORT) {
            return "badge-success";
        }
    }
    static getBadgeTranslate(status) {
        if (status == SupportRequestStatus.PENDENT) {
            return "Pendente";
        }
        if (status == SupportRequestStatus.IN_PROGRESS) {
            return "Em progresso";
        }
        if (status == SupportRequestStatus.FINISHED_BY_CLIENT) {
            return "Finalizado pelo cliente";
        }
        if (status == SupportRequestStatus.FINISHED_BY_SUPPORT) {
            return "Finalizado pelo suporte";
        }
    }


}