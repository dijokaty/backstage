(function () {
    $.nette.ext('djktAlerts', {
        success: function (response) {
            if (response.alert) {
                console.log(getResponseClass(response), response.alert);
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
})();