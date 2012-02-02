$(document).ready(function() {
    $('input[type="text"]').focus(function() {
        if (this.value == this.defaultValue){ 
            this.value = '@';
        }
        if(this.value != this.defaultValue){
            this.select();
        }
    });
    $('input[type="text"]').blur(function() {
        if ($.trim(this.value) == ''){
            this.value = (this.defaultValue ? this.defaultValue : '');
        }
    });
});			
