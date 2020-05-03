  $(document).ready(function() {

    $('#crear_cliente_btn').click(function(e) {
        // $('#myModal').modal('show');
        var url = $(this).attr('data-url');
        BootstrapDialog.show({
            title:"Crear nuevo cliente",
            message: function(dialog) {
                var $message = $('<div></div>');
                var pageToLoad = dialog.getData('pageToLoad');
                $message.load(pageToLoad);
        
                return $message;
            },
            data: {
                'pageToLoad': url
            }
        });
    });

    $('.edit-btn-cliente').click(function (e) {
        var url = $(this).attr('data-url');
        BootstrapDialog.show({
            title:"Editar",
            message: function(dialog) {
                var $message = $('<div></div>');
                var pageToLoad = dialog.getData('pageToLoad');
                $message.load(pageToLoad);
        
                return $message;
            },
            data: {
                'pageToLoad': url
            }
        });
    });

    $('.edit-btn').click(function (argument) {
        $('.edit-container').fadeToggle();
    });
});