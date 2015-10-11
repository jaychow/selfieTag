<script>
    //Being injected from FrontendController
    //console.log(test);
    $('.tag-img').on('click',function(){
        var $this = $(this);
        var id = $this.data('id');
        var pleaseWaitDiv = $('<div id="pleaseWaitDialog" class="modal fade" role="dialog"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <h4 class="modal-title"><h1>Processing...</h1></h4> </div><div class="modal-body"> <div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div></div></div></div></div>');

        if(!$this.hasClass('active')){
            $.ajax({
                method: "POST",
                type: "POST",
                url: '/tagSelfie',
                data: {
                    id: id,
                },
                beforeSend: function(){
                    pleaseWaitDiv.modal();
                },
                success: function (data) {
                    pleaseWaitDiv.modal('hide');
                    $this.addClass('active')
                }
            });
        }else{
            $.ajax({
                method: "DELETE",
                type: "DELETE",
                url: '/tagSelfie',
                data: {
                    id: id,
                },
                beforeSend: function(){
                    pleaseWaitDiv.modal();
                },
                success: function (data) {
                    pleaseWaitDiv.modal('hide');
                    $this.removeClass('active')
                }
            });
        }




    })
</script>