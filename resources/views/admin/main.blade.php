@extends('admin.app')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Users List</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Template</th>
                                <th>Upload Option</th>
                                <th>Provider</th>
                                <th>Date</th>
                                <th>Hosting Plan</th>
                                <th>Domain</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php
                                $i =1;
                            @endphp
                            @foreach($users as $user)
                                <tr class="append_td_in_tr">
                                    <td>{{ $i }}</td>
                                    <td data-id="{{ $user->id }}" class="current_user_info"><a href="{{ url('/administrate/user/'.$user->id.'') }}">{{ $user->name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{$user->template_id}}</td>
                                    <td>{{$user->upload}}</td>
                                    <td>
                                        @if($user->provider == '')
                                            {{ "Email" }}
                                            @else
                                            {{ $user->provider }}
                                        @endif
                                    </td>
                                    {{--<td>{{ $user->created_at }}</td>--}}
                                    {{--<td>{{str_replace('-', '/',  $user->created_at)}}</td>--}}
                                    <td>
                                        @if($user->created_at)
                                            @php
                                                $numPPTT = $user->created_at;
                                                $timeHalf= explode('-',$numPPTT);

                                                $month = $timeHalf[1];
                                                $almostAll = $timeHalf[2];
                                                $timeHalfff= explode(' ',$almostAll);
                                                $day = $timeHalfff[0];
                                                $year = $timeHalf[0];
                                                $time = $timeHalfff[1];
                                            @endphp

                                            {{ $month.'/'.$day.'/'.$year.' '.$time }}

                                        @endif
                                    </td>
                                    <td>
                                        @foreach($user->plan as $userPlan)
                                            @if($userPlan->stripe_plan != '1999')
                                                @php
                                                    $numPP = $userPlan->stripe_plan;
                                                    $rr =  substr($numPP, -2);
                                                    $strLength = strlen($numPP) - 2;
                                                    $rrSt =  substr($numPP, 0,$strLength);
                                                    $numC = $rrSt.'.'.$rr;
                                                @endphp
                                                @if($numC == '14.99')
                                                    {{ 'Monthly ' }}
                                                    @else
                                                    {{ 'Annual ' }}
                                                @endif

                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($user->domain['name']=='')
                                            @php
                                                $name =  explode(' ',$user->name);
                                                $email =  implode('',$name).'.hiprez.com';
                                                $email = strtolower($email);
                                            @endphp
                                            {{ $email }}
                                            @else
                                            {{ $user->domain['name'] }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->status == '')
                                            New
                                            @else
                                            {{ $user->status }}
                                        @endif
                                    </td>
                                    <td class="last_td_in_tr">
                                        <i data-id="{{ $user->id }}" class="fa fa-trash text-danger delete_user_icon" aria-hidden="true"></i>
                                        <i data-id="{{ $user->id }}" class="fa fa-archive text-success archive_user_icon" aria-hidden="true"></i>
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp

                           @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

@endsection