  $(document).ready(function() {

    $('#crear_empleado_btn').click(function(e) {
      
        // $('#myModal').modal('show');
        var url = $(this).attr('data-url');
        BootstrapDialog.show({
            title:"Crear nuevo empleado",
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
});