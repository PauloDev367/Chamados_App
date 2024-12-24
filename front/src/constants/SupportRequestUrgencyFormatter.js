import { SupportRequestUrgency } from "./SupportRequestUrgency";

export class SupportRequestUrgencyFormatter {

    static getBadgeColor(status) {
        if (status == SupportRequestUrgency.LOW) {
            return "badge-success";
        }
        if (status == SupportRequestUrgency.MEDIUM) {
            return "badge-warning";
        }
        if (status == SupportRequestUrgency.URGENCY) {
            return "badge-danger";
        }
    }
    static getBadgeTranslate(status) {
        if (status == SupportRequestUrgency.LOW) {
            return "Baixa";
        }
        if (status == SupportRequestUrgency.MEDIUM) {
            return "Média";
        }
        if (status == SupportRequestUrgency.URGENCY) {
            return "Alta";
        }
    }


}