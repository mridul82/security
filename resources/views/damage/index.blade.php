@extends('layouts.master_template', ['title'=> 'Damage'])

@section('title', 'Damage')

@section('header')
<div class="pagetitle">
    <h1>Damage</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Damage</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection

@section('content')
<div class="col-lg-12">
    <div class="row">
        <div class="col-12">
            <div class="row mb-4">
                <div class="col-lg-6">
                    <select id="branchDropdown" class="form-control mb-3">
                        <option value="admin">Admin Branch</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Damage Records</h5>
                    <table class="table table-bordered table-striped datatable" id="damageTableBody">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Supplier</th>
                                <th>Damage Quantity</th>
                                <th>Damage Type</th>
                                <th>Description</th>
                                <th>Date Recorded</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($damages as $damage)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $damage->product_name }}</td>
                                    <td>{{ $damage->purchaseOrderItem->purchaseOrder->supplier->company_name ?? 'Unknown Supplier' }}</td>
                                    <td>{{ $damage->quantity }}</td>
                                    <td>{{ $damage->type }}</td>
                                    <td>{{ $damage->notes ?? 'No description' }}</td>
                                    <td>{{ $damage->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
   $(document).ready(function () {
        $('#branchDropdown').on('change', function () {
            var branchId = $(this).val();
            var url = '/admin/branch-damages/' + branchId;

            var damageTableBody = document.querySelector('#damageTableBody');
            // Clear the table
        damageTableBody.innerHTML = '<tr><td colspan="11" class="text-center">Loading...</td></tr>';

            $.ajax({
                url: url,
                method: 'GET',
                success: function (data) {
                    console.log(data);
                    if (data.length > 0) {
                        var rows = `
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Supplier</th>
                                <th>Damage Quantity</th>
                                <th>Damage Type</th>
                                <th>Description</th>
                                <th>Date Recorded</th>
                            </tr>
                        </thead>
                        `;
                        $.each(data, function (index, damage) {
                            rows += `

                        <tbody >
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${damage.product_name || damage.product?.name}</td>
                                    <td>${damage.supplier?.company_name || 'Unknown Supplier'}</td>
                                    <td>${damage.quantity || damage.damaged_quantity}</td>
                                    <td>${damage.type || damage.damage_type || 'N/A'}</td>
                                    <td>${damage.notes || damage.damage_notes || 'No description'}</td>
                                    <td>${new Date(damage.created_at || damage.updated_at).toLocaleDateString('en-GB')} ${new Date(damage.created_at || damage.updated_at).toLocaleTimeString('en-GB')}</td>
                                </tr>
                            </tbody>`;
                        });
                        console.log(rows);
                        $('#damageTableBody').html(rows);
                    } else {
                        $('#damageTableBody').html('<tr><td colspan="7" class="text-center">No damages found for this branch.</td></tr>');
                    }
                },
                error: function () {
                    alert('Error fetching damage records. Please try again.');
                },
            });
        });
    });
</script>
@endpush
