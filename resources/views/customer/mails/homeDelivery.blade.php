@extends('layouts.customer.app')
@section('page') International Mails @endsection
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">International Mails</h4>
                <p class="card-title-desc text-muted">List of all international mails</p>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tracking Number</th>
                                <th>Courier No</th>
                                <th>Origin</th>
                                <th>Expected Delivery Date</th>
                                <th>Amount Paid</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($deliveries as $delivery)
                            <tr>
                                <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $delivery->curier->intracking }}</td>
                                <td>{{ $delivery->curier->innumber }}</td>
                                <td>{{ $delivery->curier->orgcountry }}</td>
                                <td>{{ $delivery->expectedDateOfDelivery }}</td>
                                <td>{{ $delivery->amount }}</td>
                                <td>
                                    @if($delivery->status == 0)
                                    <span class="badge bg-primary">Pending</span>
                                    @elseif($delivery->status == 1)
                                    <span class="badge bg-info">In Transit</span>
                                    @elseif($delivery->status == 2)
                                    <span class="badge bg-success">Delivered</span>
                                    @endif
                                </td>
                                <td> </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection
