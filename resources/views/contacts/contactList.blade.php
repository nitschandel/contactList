@extends('layouts.contactLayout')

@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/contactList.css') }}" />
<script type="text/javascript" src="{{ URL::asset('js/contactList.js') }}"></script>

<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-body p-t-0">
                    <form action="/contacts/search" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">   
                        <div class="input-group">
                            <input type="text" id="searchText" name="searchText" class="form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-effect-ripple btn-primary btn-search"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-4 add-button">
            <a href="/contacts/download" class="btn btn-default add-new"><span class="glyphicon glyphicon-download"></span> Export all</a>
            <a href="/contacts/create" class="btn btn-default add-new"><span class="glyphicon glyphicon-plus"></span> Add new Contact</a>
            </a>
        </div>

    </div>
    <br/>
    <div class="row">
        @if(count($contacts) > 0)
            @foreach($contacts as $contact)
                <div class="col-sm-6">
                    <div class="panel">
                        <div class="panel-body p-t-10">
                            <div class="media-main">
                                <a class="pull-left" href="/contacts/{{$contact->id}}">
                                    @if($contact->gender == 'male')
                                        <img class="thumb-lg img-circle bx-s" src="{{URL::asset('/images/user_male.jpg')}}" alt="">
                                    @else
                                        <img class="thumb-lg img-circle bx-s" src="{{URL::asset('/images/user_female.jpg')}}" alt="">
                                    @endif
                                </a>
                                <div class="pull-right btn-group-sm">
                                    <a href="/contacts/{{$contact->id}}/export" class="btn btn-success tooltips export" data-placement="top" data-toggle="tooltip" data-original-title="Export">
                                        <i class="fa fa-download"></i>
                                    </a>
                                    <a href="/contacts/{{$contact->id}}/edit" class="btn btn-success tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="/contacts/{{$contact->id}}/delete" class="btn btn-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </div>
                                <div class="info">
                                    <h4>{{$contact->name}}</h4>
                                    <p class="text-muted">{{$contact->organization}}</p>
                                    <p class="text-muted">{{$contact->age}} yrs</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            @endforeach
            <br/>
            <br/>
            {{ $contacts->links() }}
        @else
            <div class="noContacts">
                <p class="notFound">No contacts found!! Please add few contacts.</p>
            <a href="/contacts/create" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add new Contact</a>
            </a>
            </div>
        @endif
    </div>
</div>

<script type="text/javascript">
    @if(isset($error))
        alert('{{$error}}');
    @endif


</script>

@stop

