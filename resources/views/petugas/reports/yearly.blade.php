<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        h1 {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
        }
        table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        table th {
            background-color: #4CAF50;
            color: white;
            text-align: left;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>{{ $title }}</h1>
<table>
    <thead>
    <tr>
        <th>No.</th>
        <th>Judul Buku</th>
        <th>Kategori Buku</th>
        <th>Penerbit Buku</th>
        <th>Total Pembaca</th>
    </tr>
    </thead>
    <tbody>
    @foreach($books as $index => $book)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $book->judul }}</td>
            <td>{{ $book->kategori->nama }}</td>
            <td>{{ $book->penerbit->nama }}</td>
            <td>{{ $book->total_pembaca }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
