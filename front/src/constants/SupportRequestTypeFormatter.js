import { SupportRequestType } from "./SupportRequestType";

export class SupportRequestTypeFormatter {

    static getBadgeColor(status) {
        if (status == SupportRequestType.TECHNICAL) {
            return "badge-info";
        }
        if (status == SupportRequestType.FINANCIAL) {
            return "badge-warning";
        }
        if (status == SupportRequestType.OTHER) {
            return "badge-secondary";
        }
    }
    static getBadgeTranslate(status) {
        if (status == SupportRequestType.TECHNICAL) {
            return "Técnica";
        }
        if (status == SupportRequestType.FINANCIAL) {
            return "Financeira";
        }
        if (status == SupportRequestType.OTHER) {
            return "Outros";
        }
    }


}