@extends('admin.app')

@section('content')

    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Users Prospects List</h3>
                    </div>
                    <div class="box-body">
                        <table id="example3" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>

                                <th>Template</th>
                                <th>Status</th>

                                <th>Upload Option</th>
                                <th>Provider</th>

                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php
                                $i = 1;
                            @endphp
                            @foreach($pasiveUsers as $pasiveUser)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td data-id="{{ $pasiveUser->id }}" class="current_user_info"><a href="{{ url('/administrate/user/'.$pasiveUser->id.'') }}">{{ $pasiveUser->name }}</a></td>
                                    <td>{{ $pasiveUser->email }}</td>


                                    <td>{{ $pasiveUser->template_id }}</td>
                                    <td>
                                        @if($pasiveUser->status == '')
                                            New
                                        @else
                                            {{ $pasiveUser->status }}
                                        @endif
                                    </td>
                                    <td>{{$pasiveUser->upload}}</td>
                                    <td>
                                        @if($pasiveUser->provider == '')
                                            {{ "Email" }}
                                        @else
                                            {{ $pasiveUser->provider }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($pasiveUser->created_at)
                                            @php
                                                $numPPTT = $pasiveUser->created_at;
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
                                        <i data-id="{{ $pasiveUser->id }}" class="fa fa-trash text-danger text-center delete_fromProspects" aria-hidden="true"></i>
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

        </div>
    </section>

@endsection