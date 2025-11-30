$(document).ready(function(){

  /* Validation : Allowed only numeric value */
    $('.numeric-validation').on('input', function(){
      var inputVal = $(this).val();
      if(inputVal.match(/[^0-9]/g)){
          $(".error").remove();
          $(this).val('');
          $(this).after('<span class="error">Allowed only digit value.</span>');
      } else {
          $(this).next('.error').hide();
      }
    });

    /* Validation : Price (Cost) Validation */
    $('.onlynumber').on('input', function(){
      var inputVal = $(this).val();
      if(!isNumeric(inputVal) || inputVal <= 0){
        $(".error").remove();
        $(this).val('');
        $(this).after('<span class="error">Please enter only number value.</span>');
      } else {
          $(this).next('.error').hide();
      }
    });

    function isNumeric(value) {
        return !isNaN(parseFloat(value)) && isFinite(value);
    }

    /* Validation : Email Address validation */
    $('.email-validation').on('focusout', function(){
      var inputVal = $(this).val();
      if(!isValidEmail(inputVal)){
        $(".error").remove();
        $(this).val('');
        $(this).after('<span class="error">Please enter valid email address.</span>');
      } else {
          $(this).next('.error').hide();
      }
    });

    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    /* Validation : Phone number validation */
    $('.phone-validation').on('focusout', function(){
      var inputVal = $(this).val();
      if(!isValidPhoneNumber(inputVal)){
        $(".error").remove();
        $(this).val('');
        $(this).after('<span class="error">Please enter valid phone number.</span>');
      } else {
          $(this).next('.error').hide();
      }
    });

    function isValidPhoneNumber(phone) {
        var phoneRegex = /^\d{10}$/; // Change this regex as per your requirement
        return phoneRegex.test(phone);
    }

    /* Validation : File Uploading Validation like file size and file type */
      $('.file-validation').on('change', function(){
        var fileInput = this;
        var file = fileInput.files[0];

        // Check file size
        var fileSize = file.size;

        // Check file type
        var allowedFileTypes = ['jpg', 'jpeg', 'png'];
        var fileName = file.name;
        var fileExtension = fileName.split('.').pop().toLowerCase();
        
        if ($.inArray(fileExtension, allowedFileTypes) == -1) {
            $(".error").remove();
            $(this).val('');
            $(this).after('<span class="error">Please select a valid file type.</span>');
        } /*else if (fileSize > 5) { // 5 MB
            $(".error").remove();
            $(this).val('');
            $(this).after('<span class="error">File size exceeds the maximum limit(5 MB).</span>');
        }*/ else {
            $(this).next('.error').hide();
        }
      });


});	 
   