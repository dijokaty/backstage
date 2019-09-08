(function () {
    $.nette.ext('djktAlerts', {
        success: function (response) {
            let $areaEl = $('#rating-area');
            let $thanksEl = $areaEl.find('.rating-thanks');
            $thanksEl.html(response.alert || "Děkujeme");

            $areaEl.animate({
                scrollTop: $thanksEl.offset().top,
            }, 250);
            setTimeout(function () {
                $areaEl.animate({
                    scrollTop: 0,
                }, 250);
            }, 1000);

            /*createToastElement('Hodnocení přijato', response.alert)
                .then(function ($toast) {
                    let $toasts = $('#toasts');
                    $toasts.append($toast);
                    $toast.toast('show', {delay: 1000});
                    $toast.on('hidden.bs.toast', function () {
                        $toast.remove();
                    });
                });*/
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