import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

export default {
    install(app) {
        toastr.options.positionClass = 'toast-bottom-right';
        toastr.options.closeButton = true;
        toastr.options.progressBar = true;
        app.config.globalProperties.$toastr = toastr;
    }
}

export function useToastr() {
    toastr.options.positionClass = 'toast-bottom-right';
    toastr.options.closeButton = true;
    toastr.options.progressBar = true;
    return toastr;
}