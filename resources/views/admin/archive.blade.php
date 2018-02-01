@extends('admin.app')

@section('content')

    <section class="content">
        <div class="row">

            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Users Archived List</h3>
                    </div>
                    <div class="box-body">
                        <table id="example4" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>

                                <th>Template</th>
                                <th>Status</th>

                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php
                                $i = 1;
                            @endphp
                            @foreach($archiveUsers as $archiveUser)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td data-id="{{ $archiveUser->id }}" class="current_user_info"><a href="{{ url('/administrate/user/'.$archiveUser->id.'') }}">{{ $archiveUser->name }}</a></td>
                                    <td>{{ $archiveUser->email }}</td>

                                    <td>{{ $archiveUser->template_id }}</td>
                                    <td>
                                        @if($archiveUser->status == '')
                                            New
                                        @else
                                            {{ $archiveUser->status }}
                                        @endif
                                    </td>

                                    <td>
                                        <i data-id="" class="fa fa-trash text-danger text-center" aria-hidden="true"></i>
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