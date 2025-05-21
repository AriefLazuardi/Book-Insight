<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
      padding: 14px 20px;
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

    .filter-form {
      margin-bottom: 20px;
    }

    .form-row {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .form-row label {
      width: 100px;
    }

    .form-row select,
    .form-row input[type="text"] {
      padding: 5px;
      width: 200px;
    }

    .form-row button {
      margin-left: 104px;
      padding: 5px 20px;
      background-color: #4d90fe;
      color: white;
      border: none;
      cursor: pointer;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid #aaa;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
    .pagination {
            text-align: center;
            margin-top: 20px;
    }
  </style>
</head>
<body>
    <div class="navbar">
        <a href="{{ route('books.index') }}" class="active">Home</a>
        <a href="{{ route('authors.top') }}">Top Authors</a>
        <a href="{{ route('books.rating') }}">Rate Book</a>
    </div>
    <h1 style="text-align: center;" class="text-4xl mt-5">WELCOME TO BOOK INSIGHT</h1>
    @if (session('success'))
    <div id="notif-success" style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 10px; border: 1px solid #c3e6cb; border-radius: 5px;">
        {{ session('success') }}
    </div>
    @endif
    <form method="GET" action="" class="filter-form" style="padding-top: 20px;">
        <div class="form-row">
          <label for="limit">List shown :</label>
            <select name="limit" id="limit">
              @foreach ([10, 20, 30, 40, 50, 60, 70, 80, 90, 100] as $option)
                  <option value="{{ $option }}" {{ request('limit', 10) == $option ? 'selected' : '' }}>{{ $option }}</option>
              @endforeach
          </select>
        </div>
        <div class="form-row">
          <label for="search">Search :</label>
          <input type="text" name="search" id="search" placeholder="Search Book or Author..." value="{{ request('search') }}">
        </div>
        <div class="form-row">
        <button type="submit">SUBMIT</button>
        </div>
    </form>

    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Book Name</th>
            <th>Category Name</th>
            <th>Author Name</th>
            <th>Average Rating</th>
            <th>Voter</th>
        </tr>
        </thead>
        <tbody>
             @foreach ($books as $index => $book)
              <tr>
                  <td>{{ ($books->currentPage() - 1) * $books->perPage() + $index + 1 }}</td>
                  <td>{{ $book->title }}</td>
                  <td>{{ $book->category->name ?? 'N/A' }}</td>
                  <td>{{ $book->author->name ?? 'N/A' }}</td>
                  <td>{{ $book->rating->average_rating ?? '-' }}</td>
                  <td>{{ $book->rating->voter ?? '-' }}</td>
              </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $books->links() }}
    </div>
  <script>
    setTimeout(() => {
        const notif = document.getElementById('notif-success');
        if (notif) {
            notif.style.transition = 'opacity 0.5s ease';
            notif.style.opacity = '0';
            setTimeout(() => notif.remove(), 500);
        }
    }, 3000);
  </script>
</body>
</html>