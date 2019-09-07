(function () {
    $.nette.ext('djktAlerts', {
        success: function (response) {
            if (response.alert) {
                createToastElement('Hodnocení přijato', response.alert)
                    .then(function($toast) {
                        let $toasts = $('#toasts');
                        $toasts.append($toast);
                        $toast.toast('show', {delay: 1000});
                        $toast.on('hidden.bs.toast', function () {
                            $toast.remove();
                        });
                    });
            }
        }
    });

    function getResponseClass(response) {
        switch (response.status) {
            case 'success':
                return 'success';
            case 'error':
                return 'error';
        }

        return 'info';
    }

    let toastTemplatePromise = fetch('/templates/toast.html')
        .then(function (response) {
            return response.text();
        });

    function createToastElement(title, body) {
        return toastTemplatePromise
            .then(function (template) {
                let html = template
                    .replace('{{ title }}', title)
                    .replace('{{ body }}', body);

                return $(html);
            });
    }
})();