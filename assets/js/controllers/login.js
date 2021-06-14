class Login{
    static init(){
      $(function(){
        if(window.localStorage.getItem("token")){
          window.location = "index.html";
        }else{
          $("body").show();
        }
        var urlParams = new URLSearchParams(window.location.search);
        if(urlParams.has("token")){
          $("#change-password-token").val(urlParams.get("token"));
          Login.showResetPasswordForm();
        }
      });
    }

    static showRegister(){
      $("#login-form-container").addClass("hidden");
      $("#register-form-container").removeClass("hidden");
    }

    static showLogin(){
      $("#register-form-container").addClass("hidden");
      $("#change-password-form-container").addClass("hidden");
      $("#forgot-form-container").addClass("hidden");
      $("#login-form-container").removeClass("hidden");
    }

    static showForgotPasswordForm(){
      $("#login-form-container").addClass("hidden");
      $("#forgot-form-container").removeClass("hidden");
    };

    static showResetPasswordForm(){
      $("#register-form-container").addClass("hidden");
      $("#forgot-form-container").addClass("hidden");
      $("#login-form-container").addClass("hidden");
      $("#change-password-form-container").removeClass("hidden");
    }

    static doLogin(){

      $("#login-button").prop("disabled", true);
      $.post( "api/login", Utils.jsonize("#login-form"),function( data ) {
          window.localStorage.setItem("token", data.token);
          window.location = "index.html";
      }).fail(function(error) {
        $("#warning-alert-login").html(error.responseJSON.message);
        $("#warning-alert-login").removeClass("hidden");
        //toastr.error(error.responseJSON.message);
        $("#login-button").prop("disabled", false);
      });

    }

    static changePassword(){
      $("#change-password-button").prop("disabled", true);

      $.post( "api/reset", Utils.jsonize("#change-form") ).done(function( data ) {
          window.localStorage.setItem("token", data.token);
          window.location = "index.html";
      }).fail(function(error) {
        toastr.error(error.responseJSON.message);
        $("#change-password-button").prop("disabled", false);
      });
    }

    static doRegister(){

      $("#register-button").prop("disabled",true);
      $.post("api/register", Utils.jsonize("#register-form"),function(data){
        console.log(data);
        $("#warning-alert").addClass("hidden");
        $("#success-alert").html(data.message);
        $("#success-alert").removeClass("hidden");
        $("#form-body").addClass("hidden");
      }).fail(function(error){
        $("#warning-alert").html(error.responseJSON.message);
        $("#warning-alert").removeClass("hidden");

        //toastr.error(error.responseJSON.message);
        $("#register-button").prop("disabled",false);
      });

    }

    static sendRecoveryLink(){
      var email ={
        "email":$("#forgot-email").val()
      };

      $.post("api/forgot", email,function(data){
        console.log(data);
        $("#warning-alert-forgot").addClass("hidden");
        $("#success-alert-forgot").html(data.message);
        $("#success-alert-forgot").removeClass("hidden");
        $("#forgot-form-body").addClass("hidden");


      }).fail(function(error){
        $("#warning-alert-forgot").html(error.responseJSON.message);
        $("#warning-alert-forgot").removeClass("hidden");

        //toastr.error(error.responseJSON.message);
      })
    }

}
