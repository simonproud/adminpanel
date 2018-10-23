@extends('layouts.default')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6 ui-sortable" >
            <!-- end widget-stats -->
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                </div>
            </div>

        </div>

        <div class="col-md-3 ui-sortable">
            <!-- begin widget-stats -->
            <div class="widget widget-stats bg-gradient-teal m-b-10">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">TODAY'S VISITS</div>
                    <div class="stats-number">7,842,900</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 70.1%;"></div>
                    </div>
                    <div class="stats-desc">Better than last week (70.1%)</div>
                </div>
            </div>

        </div>
        <div class="col-md-3 ui-sortable">
            <!-- begin widget-stats -->
            <div class="widget widget-stats bg-gradient-blue m-b-10">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-lock fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">TODAY'S BLOCKS</div>
                    <div class="stats-number">7,842,900</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 5%;"></div>
                    </div>
                    <div class="stats-desc">Better than last week (5%)</div>
                </div>
            </div>

        </div>
        </div>

@endsection
