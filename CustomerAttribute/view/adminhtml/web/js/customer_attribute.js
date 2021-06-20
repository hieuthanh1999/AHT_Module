require([
    'jquery'
], function ($) {
    var waitForEl = function(selector, callback) {
        if ($(selector).val() || $(selector).val() == '') {
          callback();
        } else {
          setTimeout(function() {
            waitForEl(selector, callback);
          }, 100);
        }
      };
    var selector = '[name="customer[company_type]"]';
    waitForEl(selector, function() {
        console.log('run');
        $('[data-index="organization_name"]').hide();
        $('[name="customer[company_type]"]').change(function() {
            var data = $(this).val();
            if(data == 3){
                $('[data-index="organization_name"]').fadeIn();
            } else {
                $('[data-index="organization_name"]').fadeOut();
                $('[name="customer[organization_name]"]').val('');
          }
        })
        
    });
})