
<script>
  function loginSubmit(){
    $.ajax({
      type: "post",
      url: "pages/verifyLogin.php",
      data: $('#loginForm').serialize(),
      success: function (response) {
        if (response == "login") {
          /* alert("accesso eseguito"); */
          location.reload();
        }else{
          $("#error").html(response);
        }
      },
      dataType: "text",
    });
    return false;
  }
</script>

<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm " role="document">
      <div class="modal-content">
        <div class="modal-header rounded-top bg-dark text-white">
          <h5 class="modal-title" id="exampleModalCenterTitle">Accedi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="pages/verifyLogin.php" method="post" class="form-horizontal" id="loginForm" onsubmit="return loginSubmit();">
          <div class="form-row">
              <!-- Email -->
              <div class="form-group col-12">
                  <label for="">Inserisci email:</label>
                  <input type="text" class="form-control" name="email" placeholder="Email">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-12">
                <label for="">Inserisci password:</label>
                <div class="input-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" data-toggle="password">
                  <div class="input-group-append">
                      <span class="input-group-text rounded-right" style="width: 44px;"><i class="fa fa-eye " aria-hidden="true"></i></span>
                  </div>
                </div>
              </div>
          </div>
          <p id="error" style="color: red"></p>
        </div>
        <div class="modal-footer bg-light">
          <button type="reset" class="btn btn-danger" data-dismiss="modal">Annulla</button>
          <button type="submit" class="btn btn-primary">Accedi</button>
        </div>
      </form>
      </div>
    </div>
  </div>