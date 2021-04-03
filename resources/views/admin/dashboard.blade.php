@extends('layouts.admin')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Complaints
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Type</th>
                        <th>Days</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Image</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>User</th>
                        <th>Type</th>
                        <th>Days</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Screenshot</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($complaints as $complaint)
                        <tr>
                            <td>{{$complaint->user->name}}</td>
                            <td>{{json_decode($complaint->type)}}</td>
                            <td>{{json_decode($complaint->days)}}</td>
                            <td>{{$complaint->description}}</td>
                            <td>{{$complaint->location}}</td>
                            <td>{{$complaint->time}}</td>
                            <td class="@if($complaint->status == 'pending') alert-warning @elseif($complaint->status == 'dismissed') alert-info @else alert-success @endif">
                                <form action="{{route('update.complaint', $complaint->id)}}" method="get">
                                    @csrf
                                    <select name="status">
                                        <option value="pending" @if($complaint->status == 'pending') selected @endif>
                                            Pending
                                        </option>
                                        <option value="dismissed"
                                                @if($complaint->status == 'dismissed') selected @endif>
                                            Dismissed
                                        </option>
                                        <option value="resolved" @if($complaint->status == 'resolved') selected @endif>
                                            Resolved
                                        </option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </td>
                            <td><img src="{{Storage::disk('s3')->url($complaint->image)}}" width="45" height="45"
                                     alt=""></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
