<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Author Page</title>
    <style>
    .navbar {
      background-color: #333;
      overflow: hidden;
    }

    .navbar a {
      float: left;
      display: block;
      color: white;
      text-align: center;
      padding: 10px 20px;
      text-decoration: none;
    }

    .navbar a:hover {
      background-color: #575757;
    }

    .navbar .active {
      background-color: #4CAF50;
    }
    body {
      font-family: Arial, sans-serif;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 50px;
      align-items: center;
    }

    th, td {
      border: 1px solid #aaa;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    .table-container {
      width: fit-content;
      margin: 0 auto;
      text-align: center;
    }
  </style>
</head>
<body>
    <div class="navbar">
        <a href="{{ route('books.index') }}" >Home</a>
        <a href="{{ route('authors.top') }}" class="active">Top Authors</a>
        <a href="{{ route('books.rating') }}">Rate Book</a>
    </div>
    <h1 style="text-align: center;">TOP 10 MOST FAMOUS AUTHOR</h1>

   <div class="table-container">
     <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Author Name</th>
            <th>Voter</th>
        </tr>
        </thead>
        <tbody>
          @foreach ( $authors as $index => $author)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $author->name ?? 'N/A' }}</td>
              <td>{{ $author->total_voter ?? '-' }}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
   </div>
</body>
</html>