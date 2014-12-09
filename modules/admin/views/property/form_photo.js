$(function(){
    $('.photo-remove').click(function(event){
        var id  = $(this).data('id');

        var val = $('#droplist').val();
        if(val != '')
            val = val + ',';
        val = val + id;
        $('#droplist').val(val);
        
        //Remove UI element
        $('#photo' + id).remove();
    })
});