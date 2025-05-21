<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating Book Page</title>
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
    .form-row button {
      margin-left: 104px;
      padding: 5px 20px;
      background-color: #4d90fe;
      color: white;
      border: none;
      cursor: pointer;
    }
   .form-row {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    }

    .form-row label {
    width: 120px; 
    font-weight: bold;
    }

    .form-row select {
    padding: 6px;
    width: 200px;
    height: 36px;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
    <div class="navbar">
        <a href="{{ route('books.index') }}" >Home</a>
        <a href="{{ route('authors.top') }}">Top Authors</a>
        <a href="{{ route('books.rating') }}" class="active">Rate Book</a>
    </div>
    <h1 style="text-align: center;">INSERTING RATING</h1>
    <form action="{{ route('books.rating.submit') }}" method="POST">
        @csrf
        <div class="form-row">
            <label for="author">Book Author :</label>
            <select name="author_id" id="author" required>
                <option value="">-- Select Author --</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-row">
            <label for="book_id">Book Name :</label>
            <select name="book_id" id="book" required>
                <option value="">-- Select Book --</option>
            </select>
        </div>

        <div class="form-row">
            <label for="rating">Rating :</label>
            <select name="rating" id="rating" required>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="form-row">
            <button type="submit">SUBMIT</button>
        </div>
    </form>
    <script>
    $('#author').on('change', function() {
        const authorId = $(this).val();
        if (authorId) {
            $.ajax({
                url: '/books/by-author/' + authorId,
                method: 'GET',
                success: function(data) {
                    $('#book').empty().append('<option value="">-- Select Book --</option>');
                    data.forEach(book => {
                        $('#book').append(`<option value="${book.id}">${book.title}</option>`);
                    });
                }
            });
        } else {
            $('#book').empty().append('<option value="">-- Select Book --</option>');
        }
    });
</script>
</body>
</html>