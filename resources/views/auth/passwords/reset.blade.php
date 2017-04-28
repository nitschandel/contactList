<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
<form class="form-horizontal" action="/saveNewPassword" method="POST">
<fieldset>

<!-- Form Name -->
<legend>Change Password</legend>

<input type="hidden" name="_token" value="{{ csrf_token() }}">   
<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="newPassword">New password</label>
  <div class="col-md-4">
    <input id="newPassword" name="newPassword" type="password" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="newPasswordRepeat">Repeat Password</label>
  <div class="col-md-4">
    <input id="newPasswordRepeat" name="newPasswordRepeat" type="password" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>
<input type="hidden" name="passwordToken" value="{{$passwordToken}}"></input>

<!-- Button (Double) -->
<div class="form-group"> 
  <div class="col-md-8 pull-right">
    <button type="submiit" id="save" name="save" class="btn btn-success">Save</button>
  </div>
</div>

</fieldset>
</form>

<script type="text/javascript">
    @if(isset($error))
        alert('{{$error}}');
    @endif
</script>
