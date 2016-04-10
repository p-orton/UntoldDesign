$('#contact-form').validate({
        rules: {
            name: "required",
            subject: "required",
            message:"required",
            email: {
                required: true,
                email: true
            },
        },

        messages:{
          name: "please enter your name",
          subject: "please enter a subject",
          message: "please enter your story",
          email: "please enter a valid email"
        },

        highlight: function (element) {
            $(element).closest('.control-group').removeClass('has-success').addClass('has-error');
        },

        success: function (element) {
            element.text('').addClass('valid')
                .closest('.control-group').removeClass('has-error').addClass('has-success');
        }
});
