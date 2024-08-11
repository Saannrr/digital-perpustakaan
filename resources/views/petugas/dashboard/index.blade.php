@extends('admin-lte/app')
@section('title', 'Dashboard')
@section('active-dashboard', 'active')


@section('content')
    <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$count_buku}}</h3>

                <p>Buku</p>
              </div>
              <div class="icon">
                <i class="fas fa-book"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$count_user}}</h3>

                <p>User Pembaca</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$count_buku_terbaca}}</h3>

                <p>Buku Terbaca</p>
              </div>
              <div class="icon">
                 <i class="far fa-check-circle"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

{{--        <div class="row my-4">--}}
{{--          <div class="col-md-12">--}}
{{--            <div class="card">--}}
{{--              <div class="card-body">--}}
{{--                 <canvas id="myChart" height="125"></canvas>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}

        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h5>Buku Terbaru</h5>
                 <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Judul</th>
                      <th>Tanggal</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($buku as $item)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->judul}}</td>
                        <td>{{$item->created_at->diffForHumans()}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h5>User Terbaru</h5>
                 <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama</th>
                      <th>Tanggal</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($user as $item)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->created_at->diffForHumans()}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h5>Most Read Books</h5>
                 <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Judul</th>
                      <th>Total Terbaca</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($buku_terbaca as $item)
                        <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->judul}}</td>
                        <td>{{$item->total_pembaca}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
@endsection

@section('script')
    @include('admin-lte/script/chart')
@endsection

{{--@section('reports-script')--}}
{{--    <livewire:petugas.reports-script></livewire:petugas.reports-script>--}}
{{--@endsection--}}
