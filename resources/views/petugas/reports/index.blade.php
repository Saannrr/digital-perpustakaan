@extends('admin-lte.app')
@section('active-reports', 'active')

@section('content')
    <div class="container">
        <h1>Laporan</h1>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('reports.filter') }}" method="GET">
            <div class="form-group">
                <label for="report_type">Jenis Laporan</label>
                <select name="report_type" id="report_type" class="form-control">
                    <option value="" disabled selected>Pilih Jenis Laporan</option>
                    <option value="books">Laporan Buku</option>
                </select>
            </div>
            <div class="form-group">
                <label for="filter_type">Filter Berdasarkan</label>
                <select name="filter_type" id="filter_type" class="form-control">
                    <option value="" disabled selected>Filter Laporan</option>
                    <option value="month">Bulan</option>
                    <option value="year">Tahun</option>
                </select>
            </div>
            <div class="form-group" id="form-month" style="display: none;">
                <label for="month">Bulan</label>
                <select name="month" id="month" class="form-control">
                    <option value="" disabled selected>Pilih Bulan</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group" id="form-year" style="display: none;">
                <label for="year">Tahun</label>
                <select name="year" id="year" class="form-control">
                    <option value="" disabled selected>Pilih Tahun</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Buat Laporan</button>
        </form>
    </div>

    <script>
        document.getElementById('filter_type').addEventListener('change', function () {
            var formMonth = document.getElementById('form-month');
            var formYear = document.getElementById('form-year');

            if (this.value === 'month') {
                formMonth.style.display = 'block';
                formYear.style.display = 'block';
            } else {
                formMonth.style.display = 'none';
                formYear.style.display = 'block';
            }
        });
    </script>
@endsection
