/**
 * ko handler to get enterkey
 */
ko.bindingHandlers.enterkey = {
    init: function (element, valueAccessor, allBindings, viewModel) {
        var callback = valueAccessor();
        $(element).keypress(function (event) {
            var keyCode = (event.which ? event.which : event.keyCode);
            if (keyCode === 13) {
                callback.call(viewModel);
                return false;
            }
            return true;
        });
    }
};

/**
 * ko handler to format date into time ago
 */
ko.bindingHandlers.timeago = {
    update: function (element, valueAccessor) {
        var value = ko.utils.unwrapObservable(valueAccessor());
        var $this = $(element);
        $this.attr('title', value);

        var timeagoInstance = timeago(new Date().getTime(), 'pt_BR');
        var text = timeagoInstance.format(value);
        $this.text( text );
    }
};