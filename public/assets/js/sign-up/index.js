$(document).ready(function () {
   
    $('#lrf-form').submit(function (e) {
        e.preventDefault();
    });
    $('#lrf-form').validate({
        errorClass: 'error-message',
        errorPlacement: function (error, element) {
            element.next('label').replaceWith(error);
        },
        rules: {
            name: {
                required: true,
                minlength: 2,
                maxlength: 50,
            },
            email: {
                required: true,
                email: true,
                maxlength: 100,
            },
            password: {
                required: true,
                minlength: 8,
                maxlength: 20,
            },
            confirm_password: {
                required: true,
                minlength: 8,
                maxlength: 20,
                equalTo: "#password"
            }
        },
        messages: {
            name: {
                required: "Name is required.",
                minlength: "Name at least 2 characters.",
                maxlength: "No more than 50 characters."
            },
            email: {
                required: "Email Address is required.",
                email: "Invalid email address.",
                maxlength: "No more than 100 characters."
            },
            password: {
                required: "Please provide a password.",
                minlength: "Password at least 8 characters.",
                maxlength: "No more than 20 characters."
            },
            confirm_password: {
                required: "Please provide a password confirmation.",
                minlength: "Password confirmation at least 8 characters.",
                maxlength: "No more than 20 characters.",
                equalTo: "Please enter the same password as above."
            }
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajax({
                url: `${signUpUrl}`,
                method: 'POST',
                contentType: false,
                data: formData,
                cache: false,
                processData: false,
                success: function (response) {
                    if (!response.status) {
                        // Handle error response
                        if (typeof response.message === 'object') {
                            $.each(response.message, function (field, messages) {
                                var errorContainer = $('[name="' + field + '"]').next('.error-message');
                                if (errorContainer.length) {
                                    errorContainer.text(messages[0]).show();
                                }
                            });
                        } else {
                            $('[name="email"]').next('.error-message').text(response.message).show();
                        }
                    } else {
                        form.reset();
                        window.location.href = window.siteUrl;
                    }
                },
                error: function (xhr, status, error) {
                    // Handle error
                    $('.application-error').text('Error: ' + error);
                }
            });

        }
    });
});