@extends('layouts.contactLayout')
 
@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/addContact.css') }}" />
<body>  
    <h1>Show Contact</h1>
    <form>
    <div class="contentform">

            <div class="leftcontact">

                  <div class="form-group">
                  <p>Name <span>*</span></p>
                  <span class="icon-case"><i class="fa fa-user"></i></span>
                  <input type="text" name="name" id="name" value = "{{$contact->name}}" readonly="true" />
                          <div class="validation"></div>
                </div>

                <div class="form-group">
                   <p>Gender <span>*</span></p>
                    <input type="radio" name="gender" value="male" <?php if($contact->gender == "male") echo "checked"; ?> readonly ="true">
                      <label>Male</label>
                      <br/>
                    <input type="radio" name="gender" value="female" style="margin-left: -14px;" <?php if($contact->gender == "female") echo "checked"; ?> readonly = "true">
                      <label>Female</label>
                </div>

                <div class="form-group">
                <p>E-mail <span>*</span></p>  
                <span class="icon-case"><i class="fa fa-envelope-o"></i></span>
                          <input type="email" name="email" id="email" value = "{{$contact->email}}" readonly="true"  />
                          <div class="validation"></div>
                </div>  

           

                <div class="form-group">
                <p>Address <span>*</span></p>
                <span class="icon-case"><i class="fa fa-location-arrow"></i></span>
                  <input type="text" name="address" id="address" value = "{{$contact->address}}" readonly="true"  />
                          <div class="validation"></div>
                </div>

            </div>


            <div class="rightcontact">    

                <div class="form-group">
                <p>Phone number <span>*</span></p>  
                <span class="icon-case"><i class="fa fa-phone"></i></span>
                  <input type="text" name="phone" id="phone" data-rule="maxlen:10" value = "{{$contact->phone}}" readonly="true" />
                          <div class="validation"></div>
                </div>

                <div class="form-group">
                <p>Date of birth <span>*</span></p>
                <span class="icon-case"><i class="fa fa-calendar"></i></span>
                          <input type="text" name="dob" id="dob" value = "{{date("Y-m-d",strtotime($contact->dob))}}" readonly="true"  placeholder="YYYY-MM-DD"/>
                          <div class="validation"></div>
                </div>

                <div class="form-group">
                <p>Organization <span>*</span></p>
                <span class="icon-case"><i class="fa fa-home"></i></span>
                  <input type="text" name="organization" id="organization" value = "{{$contact->organization}}" readonly="true" />
                          <div class="validation"></div>
                </div>
            </div>
         
      </div> 
        <a href="/contacts/{{$contact->id}}/edit" class="btn bouton-contact">Edit Contact</a>

      </form>
  
</body>

<script type="text/javascript">
  $(':radio').attr('disabled','disabled');
</script>

@stop
