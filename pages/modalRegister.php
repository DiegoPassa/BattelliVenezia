
<script>
  function formSubmit() {
    saveForm();
    id_numbers = new Array();
    $.ajax({
      type: "post",
      url: "pages/verifyRegistration.php",
      data: $('#registerForm').serialize(),
      success: function (response) {
        /* console.log(response.toString()); */
        changeForm(response);
      },
      dataType:"json"
    });
    var form = document.getElementById('registerForm').reset();
    return false;
  }
</script>

<script>

    var name;
    var lastName;
    var email;
    var DoB;
    var password;
    var confirmPassword;

  function changeForm(result) {
    /* console.log(result); */

    // CONTROLLO NOME
    if (result.includes("emptyName")) {
      $("#name").addClass("is-invalid");
      /* $("#name").attr("placeholder", "Nome vuoto*"); */
      $('#feedbackName').addClass("invalid-feedback");$('#feedbackName').html("Nome vuoto");
    }else
    if (result.includes("20charName")) {
      $("#name").addClass("is-invalid");
      /* $("#name").attr("placeholder", "Contiene più di 20 caratteri*"); */
      $('#feedbackName').addClass("invalid-feedback");$('#feedbackName').html("Contiene più di 20 caratteri");
    }else
    if (result.includes("invalidName")) {
      $("#name").addClass("is-invalid");
      /* $("#name").attr("placeholder", "Nome invalido*"); */
      $('#feedbackName').addClass("invalid-feedback");$('#feedbackName').html("Nome invalido");
    }else{
      $("#name").removeClass("is-invalid");
      $("#name").addClass("is-valid");
      $('#name').val(name);
    }

    // CONTROLLO COGNOME
    if (result.includes("emptyLastName")) {
      $("#lastName").addClass("is-invalid");
      $('#feedbackLastName').addClass("invalid-feedback");$('#feedbackLastName').html("Cognome vuoto");
    }else
    if (result.includes("20charLastName")) {
      $("#lastName").addClass("is-invalid");
      $('#feedbackLastName').addClass("invalid-feedback");$('#feedbackLastName').html("Contiene più di 20 caratteri");
    }else
    if (result.includes("invalidLastName")) {
      $("#lastName").addClass("is-invalid");     
      $('#feedbackLastName').addClass("invalid-feedback");$('#feedbackLastName').html("Cognome non valido");
    }else{
      $("#lastName").removeClass("is-invalid");
      $("#lastName").addClass("is-valid");   
      $('#lastName').val(lastName);  
    }
    
    // CONTROLLO EMAIL
    if (result.includes("emptyEmail")) {
      $("#emailReg").addClass("is-invalid");
      $('#feedbackEmailReg').addClass("invalid-feedback");$('#feedbackEmailReg').html("Email non inserita");
    }else
    if (result.includes("invalidEmailFormat")){
      $("#emailReg").addClass("is-invalid");
      $('#feedbackEmailReg').addClass("invalid-feedback");$('#feedbackEmailReg').html("Formato email non valido");
    }else
    if (result.includes("emailAlreadyUsed")){
      $("#emailReg").addClass("is-invalid");
      $('#feedbackEmailReg').addClass("invalid-feedback");$('#feedbackEmailReg').html("Email già in uso");
    }else{
      $("#emailReg").removeClass("is-invalid");
      $("#emailReg").addClass("is-valid");
      $('#emailReg').val(email);      
    }

    // CONTROLLO PASSWORD
    if (result.includes("emptyPassword")) {
      $("#passwordReg").addClass("is-invalid");
      $('#feedbackPasswordReg').addClass("invalid-feedback");$('#feedbackPasswordReg').html("Password non inserita");
    }else
    if (result.includes("less8charPass")) {
      $("#passwordReg").addClass("is-invalid");
      $('#feedbackPasswordReg').addClass("invalid-feedback");$('#feedbackPasswordReg').html("Almeno 8 caratteri");
    }else{
      $("#passwordReg").removeClass("is-invalid");
      $("#passwordReg").addClass("is-valid");
      $('#passwordReg').val(password); 
    }

    // CONTROLLO PASSWORD DI CONFERMA
    if (result.includes("emptyConfirmPassword")) {
      $("#confirmPassword").addClass("is-invalid");
      $('#feedbackConfirmPassword').addClass("invalid-feedback");$('#feedbackConfirmPassword').html("Password non inserita");
    }else
    if (result.includes("invalidConfirmPassword")) {
      $("#confirmPassword").addClass("is-invalid");
      $('#feedbackConfirmPassword').addClass("invalid-feedback");$('#feedbackConfirmPassword').html("Le password non corrispondono");
    }else{
      $("#confirmPassword").removeClass("is-invalid");
      $("#confirmPassword").addClass("is-valid");     
      $('#confirmPassword').val(confirmPassword);
    }

    if (result.includes("ok")) {
      $('#conferma').html('Registrazione completata!');
      restoreForm();
    }else{
      $('#conferma').html('');
    }
  }

  function saveForm(){   
    name = $("#name").val();
    lastName = $("#lastName").val();
    email = $("#emailReg").val();
    DoB = $("#DoB").val();
    password = $("#passwordReg").val();
    confirmPassword = $("#confirmPassword").val();
  }

  function restoreForm(){
    $('#name').val('');
    $('#name').removeClass('is-invalid');
    $('#name').removeClass('is-valid');

    $('#lastName').val('');
    $('#lastName').removeClass('is-invalid');
    $('#lastName').removeClass('is-valid');

    $('#emailReg').val('');
    $('#emailReg').removeClass('is-invalid');
    $('#emailReg').removeClass('is-valid');

    $('#DoB').val('');
    $('#DoB').removeClass('is-invalid');
    $('#DoB').removeClass('is-valid');

    $('#passwordReg').val(''); 
    $('#passwordReg').removeClass('is-invalid');
    $('#passwordReg').removeClass('is-valid');

    $('#confirmPassword').val('');
    $('#confirmPassword').removeClass('is-invalid');
    $('#confirmPassword').removeClass('is-valid');
  }

</script>


<!-- Modal Register -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header rounded-top bg-dark text-white"> <!-- style="background-color: #008B8B;color:white" -->
          <h5 class="modal-title" id="exampleModalCenterTitle">Registrazione</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="pages/verifyRegistration.php" method="post" class="form-horizontal" id="registerForm" onsubmit="return formSubmit();">
        <div class="modal-body mx-3">
          <div class="form-row">
              <!-- Name -->
              <div class="form-group col-md-6">
                  <label for="">Inserisci nome:</label>
                  <input id="name" type="text" class="form-control" name="name" aria-describedby="helpId" placeholder="Nome">
                  <div id = "feedbackName"></div>
              </div>
              <!-- lastName -->
              <div class="form-group col-md-6">
                  <label for="">Inserisci cognome:</label>
                  <input id="lastName" type="text" class="form-control" name="lastName" aria-describedby="helpId" placeholder="Cognome">
                  <div id = "feedbackLastName"></div>
              </div>
          </div>
          <div class="form-row">
              <!-- Email -->
              <div class="form-group col-md-8">
                  <label for="">Inserisci email:</label>
                  <input id="emailReg" type="text" class="form-control" name="email" placeholder="Email">
                  <div id = "feedbackEmailReg"></div>
              </div>
              <!-- Date of Birth-->
              <div class="form-group col-md-4">
                  <label for="">Data di nascita:</label>
                  <input id="DoB" type="date" class="form-control" name="DoB" aria-describedby="helpId">
                  <small id="DoBHelp" class="form-text text-muted">*Opzionale</small>
              </div>
          </div>
          <div class="form-row">
              <!-- Password -->
              <div class="form-group col-md-6">
                <label for="">Inserisci password:</label>
                <div class="input-group">
                  <input id="passwordReg" type="password" class="form-control" name="password" placeholder="Password" data-toggle="password">
                  <div class="input-group-append">
                    <span class="input-group-text rounded-right" style="width: 44px;"><i class="fa fa-eye " aria-hidden="true"></i></span>
                  </div>
                  <div id = "feedbackPasswordReg"></div>
                </div>
              </div>  
              <!-- Conferma Password -->
              <div class="form-group col-md-6">
                <label for="">Conferma password:</label>
                <div class="input-group">
                  <input id="confirmPassword" type="password" class="form-control" name="confirmPassword" placeholder="Conferma password" data-toggle="password">
                  <div class="input-group-append">
                    <span class="input-group-text rounded-right" style="width: 44px;"><i class="fa fa-eye" aria-hidden="true"></i></span>
                  </div>
                  <div id = "feedbackConfirmPassword"></div>
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer bg-light">
          <div id="conferma"></div>
          <button type="reset" class="btn btn-danger" data-dismiss="modal" onclick="restoreForm()">Annulla</button>
          <button type="submit" id="submitReg" class="btn btn-primary">Registrati</button>
        </div>
        </form>
      </div>
    </div>
  </div>