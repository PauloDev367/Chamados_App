import { SupportRequestChatStatus } from "./SupportRequestChatStatus";

export class MessagesTypesFormatter {
    static CLIENT = "CLIENT";
    static SUPPORT = "SUPPORT";


    static getBadgeColor(type) {
        if (type == SupportRequestChatStatus.WAITING_CLIENT_RESPONSE) {
            return "badge-warning";
        }
        if (type == SupportRequestChatStatus.WAITING_SUPPORT_RESPONSE) {
            return "badge-info";
        }
        if (type == SupportRequestChatStatus.NO_MESSAGES) {
            return "badge-secondary";
        }
    }
    static getBadgeTranslate(type) {
        if (type == SupportRequestChatStatus.WAITING_CLIENT_RESPONSE) {
            return "Aguardando cliente";
        }
        if (type == SupportRequestChatStatus.WAITING_SUPPORT_RESPONSE) {
            return "Aguardando suporte";
        }
        if (type == SupportRequestChatStatus.NO_MESSAGES) {
            return "Nenhuma mensagem";
        }
    }
}