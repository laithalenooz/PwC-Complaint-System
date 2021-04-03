@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Send Us Your Complaint') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('complaint.submit') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"><strong>Select Type
                                        :</strong></label><br/>
                                <div class="col-md-6">
                                    <select class="form-control" name="type[]" multiple required>
                                        <option value="Noise">Noise</option>
                                        <option value="Electricity Issue">Electricity Issue</option>
                                        <option value="Broken Hardware">Broken Hardware</option>
                                        <option value="Software Related">Software Related</option>
                                        <option value="Payments">Payments</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Days that Occurred</label>
                                <div class="col-md-6">
                                    <label>Sunday
                                        <input type="checkbox" name="days[]" value="Sunday" multiple>
                                    </label>
                                    <label>Monday
                                        <input type="checkbox" name="days[]" value="Monday" multiple>
                                    </label>
                                    <label>Tuesday
                                        <input type="checkbox" name="days[]" value="Tuesday" multiple>
                                    </label>
                                    <label>Wednesday
                                        <input type="checkbox" name="days[]" value="Wednesday" multiple>
                                    </label>
                                    <label>Thursday
                                        <input type="checkbox" name="days[]" value="Thursday" multiple>
                                    </label>
                                    <label>Friday
                                        <input type="checkbox" name="days[]" value="Friday" multiple>
                                    </label>
                                    <label>Saturday
                                        <input type="checkbox" name="days[]" value="Saturday" multiple>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Description</label>
                                <div class="col-md-6">
                                    <textarea name="description" cols="38" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Location</label>
                                <div class="col-md-6">
                                    <input name="location" type="text"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Time</label>
                                <div class="col-md-6">
                                    <input name="time" type="time"/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Include a Screenshot</label>
                                <div class="col-md-6">
                                    <input name="image" type="file"/>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit Complaint') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Days</th>
                        <th scope="col">Description</th>
                        <th scope="col">Location</th>
                        <th scope="col">Time</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($complaints as $complaint)
                        <tr>
                            <td>{{json_decode($complaint->type)}}</td>
                            <td>{{json_decode($complaint->days)}}</td>
                            <td>{{$complaint->description}}</td>
                            <td>{{$complaint->location}}</td>
                            <td>{{$complaint->time}}</td>
                            <td class="@if($complaint->status == 'pending') alert-warning @elseif($complaint->status == 'dismissed') alert-info @else alert-success @endif">
                                <strong>{{$complaint->status}}</strong></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
