@extends('layouts.contactLayout')
 
@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/addContact.css') }}" />
<body>
    <h1>Edit Contact</h1>
 
 @if(isset($contact))    
  <form action="/contacts/{{$contact->id}}" method="POST">  
  <input type="hidden" name="_token" value="{{ csrf_token() }}">    
    <div class="contentform">
      <div id="sendmessage"> Your contact has been updated successfully. Check in your <a href="/contacts">Contact List</a> </div>
      <div id="errorMessage"></div>

            <div class="leftcontact">

                <div class="form-group">
                  <p>Name <span>*</span></p>
                  <span class="icon-case"><i class="fa fa-user"></i></span>
                  <input type="text" name="name" id="name" value = "{{$contact->name}}" required />
                          <div class="validation"></div>
                </div>

                <div class="form-group">
                   <p>Gender <span>*</span></p>
                    <input type="radio" name="gender" value="male" <?php if($contact->gender == "male") echo "checked"; ?>>
                      <label>Male</label>
                      <br/>
                    <input type="radio" name="gender" value="female" style="margin-left: -14px;" <?php if($contact->gender == "female") echo "checked"; ?>>
                      <label>Female</label>
                </div>

                <div class="form-group">
                <p>E-mail <span>*</span></p>  
                <span class="icon-case"><i class="fa fa-envelope-o"></i></span>
                          <input type="email" name="email" id="email" value = "{{$contact->email}}" required />
                          <div class="validation"></div>
                </div>  

           

                <div class="form-group">
                <p>Address <span>*</span></p>
                <span class="icon-case"><i class="fa fa-location-arrow"></i></span>
                  <input type="text" name="address" id="address" value = "{{$contact->address}}" required />
                          <div class="validation"></div>
                </div>

            </div>


            <div class="rightcontact">    

                <div class="form-group">
                <p>Phone number <span>*</span></p>  
                <span class="icon-case"><i class="fa fa-phone"></i></span>
                  <input type="text" name="phone" id="phone" data-rule="maxlen:10" value = "{{$contact->phone}}" />
                          <div class="validation"></div>
                </div>

                <div class="form-group">
                <p>Date of birth <span>*</span></p>
                <span class="icon-case"><i class="fa fa-calendar"></i></span>
                          <input type="text" name="dob" id="dob" value = "{{date("Y-m-d",strtotime($contact->dob))}}" required placeholder="YYYY-MM-DD"/>
                          <div class="validation"></div>
                </div>

                <div class="form-group">
                <p>Organization <span>*</span></p>
                <span class="icon-case"><i class="fa fa-home"></i></span>
                  <input type="text" name="organization" id="organization" value = "{{$contact->organization}}" required/>
                          <div class="validation"></div>
                </div>
            </div>
         
      </div>
    <button type="submit" class="bouton-contact">Update Contact</button>
      
    </form> 
 @endif
  
</body>

<script type="text/javascript">
$('#sendmessage').hide();
$('#errorMessage').hide()
  $( function() {
    $( "#dob" ).datepicker({
        dateFormat:'yy-mm-dd',
        defaultDate: new Date(1990,00,01),
        changeMonth : true,
        changeYear : true,
        maxDate : "0d",
        yearRange : "1900:2017"
      });
  } );
  @if(isset($success))
      $('#sendmessage').show();
  @endif

  @if(isset($error))
    $('#errorMessage').html("{{$error}}");
    $('#errorMessage').show()
  @endif

</script>

@stop
