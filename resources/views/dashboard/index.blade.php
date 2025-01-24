@extends('layouts.master_template', ['title'=> 'Dashboard'])

@section('title', 'Dashboard')
@section('header')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection
<style>
    /* Card Container Styling */
.card {
    border: none;
    border-radius: 15px;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
}

/* Adding hover effect */
.card:hover {
    transform: scale(1.05);
    box-shadow: 0px 6px 25px rgba(0, 0, 0, 0.15);
}

/* Styling the filter icon */
.filter a.icon {
    color: #6c757d;
    transition: color 0.3s ease;
}

.filter a.icon:hover {
    color: #495057;
}

/* Card Header Styling */
.card-title {
    font-size: 1.1rem;
    font-weight: bold;
    color: #fff;

}

/* Card Icon Styling */
.card-icon {
    font-size: 2rem;
    color: #fff;
    width: 60px;
    height: 60px;
    background: linear-gradient(45deg, #ff5f6d, #ffc371);
    box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.2);
    transition: background 0.3s ease;
}

/* Color Customization for Each Card */
.sales-card .card-icon {
    background: linear-gradient(45deg, #28a745, #7dcea0);
}

.revenue-card .card-icon {
    background: linear-gradient(45deg, #3498db, #85c1e9);
}

.customers-card .card-icon {
    background: linear-gradient(45deg, #f39c12, #f7dc6f);
}

/* Number Count Styling */
.card-body h6 {
    font-size: 1.6rem;
    font-weight: bold;
    margin: 0;
    color: #fff
}

/* Percentage Increase/Decrease Styling */
.text-success {
    color: #28a745 !important;
}

.text-danger {
    color: #dc3545 !important;
}

.small {
    font-size: 0.875rem;
    color: #666;
}

.dropdown-menu {
    border-radius: 10px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
}

/* Sales Card Background */
.sales-card {
    background: linear-gradient(135deg, #28a745, #1abc9c);
}

/* Revenue Card Background */
.revenue-card {
    background: linear-gradient(135deg, #3498db, #5dade2);
}

/* Customers Card Background */
.customers-card {
    background: linear-gradient(135deg, #f39c12, #f1c40f);
}
.user-card {
    background: linear-gradient(135deg, #8e548c, #9e709c);
}

</style>
@section('content')
<section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-md-3">
            <div class="card info-card user-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Users <span>| OverAll</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$userCount}}</h6>
                    {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-md-3">
            <div class="card info-card revenue-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Sub admin <span>| OverAll</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-buildings"></i>
                  </div>
                  <div class="ps-3">
                    <h6>-</h6>
                    <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-md-3">

            <div class="card info-card customers-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Products <span>| This Year</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-book"></i>
                  </div>
                  <div class="ps-3">
                    <h6>-</h6>
                    <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

                  </div>
                </div>

              </div>


            </div>


          </div><!-- End Customers Card -->


          <!-- Sales Card -->
          <div class="col-md-3">
            <div class="card info-card sales-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Employee <span>| OverAll</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-coin"></i>
                  </div>
                  <div class="ps-3">
                    <h6>120000</h6>
                    {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->


<!-- Reports -->
<div class="col-12">
    <div class="card">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Filter</h6>
          </li>

          <li><a class="dropdown-item" href="#">Today</a></li>
          <li><a class="dropdown-item" href="#">This Month</a></li>
          <li><a class="dropdown-item" href="#">This Year</a></li>
        </ul>
      </div>

      <div class="card-body">
        <h5 class="card-title">Reports <span>/Today</span></h5>

        <!-- Line Chart -->
        <div id="reportsChart"></div>

        <script>
          document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#reportsChart"), {
              series: [{
                name: 'Sales',
                data: [31, 40, 28, 51, 42, 82, 56],
              }, {
                name: 'Revenue',
                data: [11, 32, 45, 32, 34, 52, 41]
              }, {
                name: 'Customers',
                data: [15, 11, 32, 18, 9, 24, 11]
              }],
              chart: {
                height: 350,
                type: 'area',
                toolbar: {
                  show: false
                },
              },
              markers: {
                size: 4
              },
              colors: ['#4154f1', '#2eca6a', '#ff771d'],
              fill: {
                type: "gradient",
                gradient: {
                  shadeIntensity: 1,
                  opacityFrom: 0.3,
                  opacityTo: 0.4,
                  stops: [0, 90, 100]
                }
              },
              dataLabels: {
                enabled: false
              },
              stroke: {
                curve: 'smooth',
                width: 2
              },
              xaxis: {
                type: 'datetime',
                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
              },
              tooltip: {
                x: {
                  format: 'dd/MM/yy HH:mm'
                },
              }
            }).render();
          });
        </script>
        <!-- End Line Chart -->

      </div>

    </div>
  </div><!-- End Reports -->

  <!-- Recent Sales -->
  <div class="col-12">
    <div class="card recent-sales overflow-auto">

      <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <li class="dropdown-header text-start">
            <h6>Filter</h6>
          </li>

          <li><a class="dropdown-item" href="#">Today</a></li>
          <li><a class="dropdown-item" href="#">This Month</a></li>
          <li><a class="dropdown-item" href="#">This Year</a></li>
        </ul>
      </div>

      <div class="card-body">
        <h5 class="card-title">Recent Sales <span>| Today</span></h5>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Customer</th>
              <th scope="col">Product</th>
              <th scope="col">Price</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row"><a href="#">#2457</a></th>
              <td>Brandon Jacob</td>
              <td><a href="#" class="text-primary">At praesentium minu</a></td>
              <td>$64</td>
              <td><span class="badge bg-success">Approved</span></td>
            </tr>
            <tr>
              <th scope="row"><a href="#">#2147</a></th>
              <td>Bridie Kessler</td>
              <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
              <td>$47</td>
              <td><span class="badge bg-warning">Pending</span></td>
            </tr>
            <tr>
              <th scope="row"><a href="#">#2049</a></th>
              <td>Ashleigh Langosh</td>
              <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
              <td>$147</td>
              <td><span class="badge bg-success">Approved</span></td>
            </tr>
            <tr>
              <th scope="row"><a href="#">#2644</a></th>
              <td>Angus Grady</td>
              <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
              <td>$67</td>
              <td><span class="badge bg-danger">Rejected</span></td>
            </tr>
            <tr>
              <th scope="row"><a href="#">#2644</a></th>
              <td>Raheem Lehner</td>
              <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
              <td>$165</td>
              <td><span class="badge bg-success">Approved</span></td>
            </tr>
          </tbody>
        </table>

      </div>

    </div>
  </div><!-- End Recent Sales -->



</div>
</div><!-- End Left side columns -->

       @endsection
        </div>
      </div><!-- End Right side columns -->

    </div>

</section>
