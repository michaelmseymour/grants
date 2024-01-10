<?php
    use Carbon\Carbon;
?>
@extends('app')

@section('content')
    <h1>All Applications
        @if(in_array(Auth::user()->role, ['admin']))
            <div class="pull-right" style="font-size:0.4em; margin-top: 1.4em;"><a href="/recalcscores">Recalculate Scores</a></div>
        @endif
    </h1>
    @foreach($rounds as $round)
        <hr>
        <h2 class="appTitle"> {{ $round->name }} </h2>

        <!--check to see if the round end_date is a year old from today-->

        @if(Carbon::parse($round->end_date)->diffInYears(Carbon::now())>=1)
            <div class="scrollable hidden">
        @else
            <div class="scrollable">
        @endif
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Applicant</th>
                        <th>Requested Budget</th>
                        <th>Approved Budget</th>
                        <th>Status</th>
                        <th>Judge Status</th>
                        <th>Objective Score</th>
                        <th>Subjective Score</th>
                        <th>Total Score</th>
                        <th>Created</th>
                        <th>Last Modified</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($applications as $application)
                        @if($application->round_id == $round->id)
                            <tr>
                                <td>
                                    @if($application->status == 'new')
                                        <a href="/applications/{{ $application->id }}">{{ $application->name }}</a>
                                    @else
                                        <a href="/applications/{{ $application->id }}/review">{{ $application->name }}</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="/users/{{ $application->user->id }}">{{ $application->user->name }}</a>
                                </td>
                                <td>${{ $application->requested_budget }}</td>
                                <td>${{ $application->approved_budget }}</td>
                                <td>{{ $application->status }}</td>
                                <td>{{ $application->judge_status }}</td>
                                <td>{{ $application->objective_score }}</td>
                                <td>{{ $application->subjective_score }}</td>
                                <td>{{ $application->total_score }}</td>
                                <td>{{ $application->created_at->format('Y-m-d H:i:s e') }}</td>
                                <td>{{ $application->updated_at->format('Y-m-d H:i:s e') }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <br>
        </div>
    @endforeach
@endsection
