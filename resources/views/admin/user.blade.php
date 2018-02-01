@extends('admin.app')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div>
                    <p><h2><span style="font-size: 16px">Name  </span>{{$user->name}}</h2></p>
                    <p><h2><span style="font-size: 16px">Status  </span>    <span class="status_name_in_user_page">
                        @if($user->status == '')
                            {{"New"}}
                        @else
                            {{$user->status}}
                        @endif
                    </span>

                    </h2></p>
                </div>
                <div class="status_div_content">
                        <div class="checkbox">
                            <label><input class="a_chac_s_b" type="radio" name="status"  value="1"><span class="status_chackbox_in_u">In Progress</span> </label>
                        </div>
                        <div class="checkbox">
                            <label><input class="a_chac_s_b" type="radio" name="status" value="2"><span class="status_chackbox_in_u">Active</span> </label>
                        </div>
                        <div class="checkbox">
                            <label><input class="a_chac_s_b" type="radio" name="status"  value="3" ><span class="status_chackbox_in_u">Archive</span></label>
                        </div>
                        <div class="">
                            <button data-id="{{$user->id}}" class="btn btn-warning save_status_b">Save</button>
                        </div>

                </div>
                @if(gettype($userRezume) == 'string')
                    {{--<area shape="rect" coords="0,0,82,126" alt="Sun" href="{{ 'uploads/'.$userRezume }}" download>--}}
                    <p class="p_upload_class_download">
                        @if($userRezume != 'Not Resume')
                        <area class="aasdd" href="{{ asset('uploads/'.$userRezume) }}" download>
                        <i data-name="{{ $resumeId }}" class="fa fa-file-text download_file_resume" aria-hidden="true"></i>
                        </area>
                        @endif
                        <span class="text-success">{{ $userRezume }}</span>
                    </p>


                    <div class="form-group">
                        <label>Template Selected:</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                            </div>
                            <p class="form-control">{{ $user->template_id }}</p>
                        </div>

                    </div>

                    @if(isset($subBillingInfo))
                        @foreach( $subBillingInfo as $subInfo)
                            <div class="form-group">
                                <label>
                                    @if($subInfo['stripe_plan'] != '14.99' && $subInfo['stripe_plan'] != '7.99')
                                        Domain Subscriptions
                                        @else
                                        Hosting Subscriptions:
                                    @endif
                                </label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                                    </div>
                                    @if(isset($subInfo['name']))
                                        {{--<p value="{{ $subInfo['name']}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"'>{{ $subInfo['name']}}</p>--}}
                                        @if($subInfo['stripe_plan'] == '14.99')
                                            <p type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"'>Monthly </p>
                                        @endif
                                        @if($subInfo['stripe_plan'] == '7.99')
                                            <p type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"'>Annual </p>
                                        @endif

                                         <p type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"'>{{ '$'. $subInfo['stripe_plan']}}</p>
                                    @endif
                                </div>

                            </div>
                        @endforeach
                    @endif
                    @if(isset($domainName))

                            <div class="form-group">
                                <label>Domain Name:</label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                                    </div>
                                    <p class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                        @if($domainName->name=='null' || $domainName->name=='')
                                            @php
                                                $name =  explode(' ',$user->name);
                                                $email =  implode('',$name).'.hiprez.com';
                                                $email = strtolower($email);
                                            @endphp
                                            {{ $email }}
                                        @else
                                            {{ $domainName->name }}
                                        @endif
                                    </p>
                                </div>

                            </div>

                    @endif


                    @else
                    @if(isset($userRezume['providerprovider_id']))

                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">User Rezume Info</h3>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="box box-danger">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label>ID:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-laptop"></i>
                                                        </div>
                                                        @if(isset($userRezume['user_id']))   <p value="{{ $userRezume['user_id'] }}" type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask>{{ $userRezume['user_id'] }}</p> @endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>

                                                <div class="form-group">
                                                    <label>Provider:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-share-square-o" aria-hidden="true"></i>
                                                        </div>
                                                        @if(isset($userRezume['provider']))   <p value="{{ ($userRezume['provider'])?$userRezume['provider']:'User Resume' }}" type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask>{{ ($userRezume['provider'])?$userRezume['provider']:'User Resume' }}</p> @endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>

                                                <div class="form-group">
                                                    <label>Date:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        @if(isset($userRezume['created_at'])) <p value="{{ $userRezume['created_at'] }}" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>{{ $userRezume['created_at'] }}</p>@endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box box-info">
                                            <div class="box-body">

                                                <div class="form-group">
                                                    <label>Email:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                        </div>
                                                        @if(isset($userRezume['name']['emailAddress']))  <input value="{{ $userRezume['name']['emailAddress'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>

                                                <div class="form-group">
                                                    <label>Name:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-font" aria-hidden="true"></i>
                                                        </div>
                                                        @if(isset($userRezume['name']['firstName']))<input value="{{ $userRezume['name']['firstName'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>

                                                <div class="form-group">
                                                    <label>Last Name:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-font" aria-hidden="true"></i>
                                                        </div>
                                                        @if(isset($userRezume['name']['lastName']))<input value="{{ $userRezume['name']['lastName'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>

                                                <div class="form-group">
                                                    <label>Headline:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-header" aria-hidden="true"></i>
                                                        </div>
                                                        @if(isset($userRezume['name']['headline'])) <input value="{{ $userRezume['name']['headline'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>

                                                <div class="form-group">
                                                    <label>Industry:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-industry" aria-hidden="true"></i>
                                                        </div>
                                                        @if(isset($userRezume['name']['industry'])) <input value="{{ $userRezume['name']['industry'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>

                                                <div class="form-group">
                                                    <label>Country:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-globe" aria-hidden="true"></i>
                                                        </div>
                                                        @if(isset($userRezume['name']['location']['name']))  <input value="{{ $userRezume['name']['location']['name'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Country code:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-globe" aria-hidden="true"></i>
                                                        </div>
                                                        @if(isset($userRezume['name']['location']['country']['code']))<input value="{{ $userRezume['name']['location']['country']['code'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                                @if(isset($userRezume['name']['positions']['values']))
                                                @foreach( $userRezume['name']['positions']['values'] as $position)
                                                    <div class="form-group">
                                                        <label>Position:</label>

                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                            </div>
                                                            @if(isset($position['company']['name']))Name:<input value="{{ $position['company']['name']}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                            @if(isset($position['location']['name']))Location:<input value="{{ ($position['location']['name'])?$position['location']['name']:'-'}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                            @if(isset($position['startDate']['year']))Year:<input value="{{ $position['startDate']['year']}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                            @if(isset($position['startDate']['month']))Month:<input value="{{ $position['startDate']['month']}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                            @if(isset($position['title']))Title:<input value="{{ $position['title']}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                        </div>
                                                        <!-- /.input group -->
                                                    </div>
                                                @endforeach
                                                @endif

                                                <div class="form-group">
                                                    <label>positions Total:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                        </div>
                                                        @if(isset( $userRezume['name']['positions']['_total']))
                                                         <input value="{{ $userRezume['name']['positions']['_total'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                                        @endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>

                                                @if(isset($subBillingInfo))
                                                    @foreach( $subBillingInfo as $subInfo)
                                                        <div class="form-group">
                                                            <label>Position:</label>

                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                                </div>
                                                                @if(isset($subInfo['name']))
                                                                    <p value="{{ $subInfo['name']}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>{{ $subInfo['name']}}</p>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                @endif

                                                @if(isset($domainName))

                                                    <div class="form-group">
                                                        <label>Domain Name:</label>

                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                            </div>
                                                            <p class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>

                                                                @if($domainName->name=='null' || $domainName->name=='')
                                                                    @php
                                                                        $name =  explode(' ',$user->name);
                                                                        $email =  implode('',$name).'.hiprez.com';
                                                                        $email = strtolower($email);
                                                                    @endphp
                                                                    {{ $email }}
                                                                @else
                                                                    {{ $domainName->name }}
                                                                @endif

                                                            </p>
                                                        </div>

                                                    </div>

                                                @endif

                                                <div class="form-group">
                                                    <label>Image:</label>

                                                    {{--<div class="input-group" style="width: 100px;height: auto">--}}
                                                        {{--@if(isset( $userRezume['name']['pictureUrls']['values'][0]))--}}
                                                            {{--<img src="{{ $userRezume['name']['pictureUrls']['values'][0] }}" style="width: 100%;height: 100%;">--}}
                                                        {{--@endif--}}
                                                    {{--</div>--}}
                                                    <!-- /.input group -->
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else

                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">User Rezume Info</h3>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="box box-danger">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label>ID:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-laptop"></i>
                                                        </div>
                                                        @if(isset( $userRezume['user_id'])) <input value="{{ $userRezume['user_id'] }}" type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask>@endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>

                                                <div class="form-group">
                                                    <label>Provider:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-share-square-o" aria-hidden="true"></i>
                                                        </div>
                                                        {{--<input value="{{ ($userRezume['provider'])?$userRezume['provider']:'User Resume' }}" type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask>--}}
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>

                                                <div class="form-group">
                                                    <label>Date:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        @if(isset( $userRezume['created_at'])) <input value="{{ $userRezume['created_at'] }}" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>@endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box box-info">
                                            <div class="box-body">

                                                <div class="form-group">
                                                    <label>Email:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                        </div>
                                                      @if(isset( $userRezume['name'][0]['emailAddress']))  <input value="{{ $userRezume['name'][0]['emailAddress'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                      @if(isset( $userRezume['name']['emailAddress']))  <input value="{{ $userRezume['name']['emailAddress'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>

                                                <div class="form-group">
                                                    <label>Name:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-font" aria-hidden="true"></i>
                                                        </div>
                                                        @if(isset( $userRezume['name'][0]['firstName'])) <input value="{{ $userRezume['name'][0]['firstName'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                        @if(isset( $userRezume['name']['firstName'])) <input value="{{ $userRezume['name']['firstName'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>

                                                <div class="form-group">
                                                    <label>Headline:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-header" aria-hidden="true"></i>
                                                        </div>
                                                        @if(isset( $userRezume['name'][0]['headline'])) <input value="{{ $userRezume['name'][0]['headline'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask> @endif
                                                        @if(isset( $userRezume['name']['headline'])) <input value="{{ $userRezume['name']['headline'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask> @endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>

                                                <div class="form-group">
                                                    <label>Country:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-globe" aria-hidden="true"></i>
                                                        </div>
                                                        @if(isset( $userRezume['name'][0]['location']['name'] )) <input value="{{ $userRezume['name'][0]['location']['name'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                        @if(isset( $userRezume['name']['location']['name'] )) <input value="{{ $userRezume['name']['location']['name'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Country code:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-globe" aria-hidden="true"></i>
                                                        </div>
                                                        @if(isset( $userRezume['name'][0]['location']['country']['code'])) <input value="{{ $userRezume['name'][0]['location']['country']['code'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                        @if(isset( $userRezume['name']['location']['country']['code'])) <input value="{{ $userRezume['name']['location']['country']['code'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>

                                                {{--<div class="form-group">--}}
                                                {{--<label>Email:</label>--}}

                                                {{--<div class="input-group">--}}
                                                {{--<div class="input-group-addon">--}}
                                                {{--<i class="fa fa-envelope-o" aria-hidden="true"></i>--}}
                                                {{--</div>--}}
                                                {{--<input value="{{ $userRezume['name'][0]['pictureUrls'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>--}}
                                                {{--</div>--}}
                                                {{--<!-- /.input group -->--}}
                                                {{--</div>--}}
                                                @if(isset( $userRezume['name'][0]['positions']['values']))
                                                @foreach( $userRezume['name'][0]['positions']['values'] as $position)
                                                    <div class="form-group">
                                                        <label>Position:</label>

                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                            </div>
                                                            @if(isset( $position['company']['name']))<input value="{{ $position['company']['name']}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                            @if(isset( $position['location']['name']))<input value="{{ ($position['location']['name'])?$position['location']['name']:'-'}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                            @if(isset($position['startDate']['year'] )) <input value="{{ $position['startDate']['year']}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                            @if(isset($position['startDate']['month'] )) <input value="{{ $position['startDate']['month']}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                            @if(isset($position['title'] )) <input value="{{ $position['title']}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                        </div>
                                                        <!-- /.input group -->
                                                    </div>
                                                @endforeach
                                                @endif

                                                @if(isset( $userRezume['name']['positions']['values']))
                                                @foreach( $userRezume['name']['positions']['values'] as $position)
                                                    <div class="form-group">
                                                        <label>Position:</label>

                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                            </div>
                                                            @if(isset( $position['company']['name']))<input value="{{ $position['company']['name']}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                            @if(isset( $position['location']['name']))<input value="{{ ($position['location']['name'])?$position['location']['name']:'-'}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                            @if(isset($position['startDate']['year'] )) <input value="{{ $position['startDate']['year']}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                            @if(isset($position['startDate']['month'] )) <input value="{{ $position['startDate']['month']}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                            @if(isset($position['title'] )) <input value="{{ $position['title']}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>@endif
                                                        </div>
                                                        <!-- /.input group -->
                                                    </div>
                                                @endforeach
                                                @endif


                                                <div class="form-group">
                                                    <label>positions Total:</label>

                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                        </div>
                                                        @if(isset( $userRezume['name'][0]['positions']['_total'] ))
                                                            <input value="{{ $userRezume['name'][0]['positions']['_total'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                                        @endif

                                                        @if(isset( $userRezume['name']['positions']['_total'] ))
                                                            <input value="{{ $userRezume['name']['positions']['_total'] }}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                                        @endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>

                                                @if(isset($subBillingInfo))
                                                    @foreach( $subBillingInfo as $subInfo)
                                                        <div class="form-group">
                                                            <label>Position:</label>

                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                                </div>
                                                                @if(isset($subInfo['name']))
                                                                    <p value="{{ $subInfo->name}}" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>{{ $subInfo->name}}</p>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                @endif

                                                @if(isset($domainName))

                                                    <div class="form-group">
                                                        <label>Domain Name:</label>

                                                        <div class="input-group">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                                            </div>
                                                            <p class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                                                @if($domainName->name=='null' || $domainName->name=='')
                                                                    @php
                                                                        $name =  explode(' ',$user->name);
                                                                        $email =  implode('',$name).'.hiprez.com';
                                                                        $email = strtolower($email);
                                                                    @endphp
                                                                    {{ $email }}
                                                                @else
                                                                    {{ $domainName->name }}
                                                                @endif
                                                            </p>
                                                        </div>

                                                    </div>

                                                @endif

                                                <div class="form-group">
                                                    <label>Image:</label>

                                                    <div class="input-group" style="width: 100px;height: auto">
                                                        @if(isset( $userRezume['name'][0]['pictureUrls']['values'][0]))
                                                        <img src="{{ $userRezume['name'][0]['pictureUrls']['values'][0] }}" style="width: 100%;height: 100%;">
                                                        @endif
                                                    </div>
                                                    <!-- /.input group -->
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                @endif
            </div>
        </div>
    </section>

@endsection