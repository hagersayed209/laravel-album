<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel CRUD With Multiple Image Upload</title>

      <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
     <!-- Font-awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    </head>
    <body>

        <div class="container" style="margin-top: 50px;">

            <h3 class="text-center text-danger"><b>Laravel Album With  Image Upload</b> </h3>
            <a href="/create" class="btn btn-outline-success">Add New Album</a>

            <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                     <th>Update</th>
                    <th>Delete Album and Pictures </th>
                    <th>Just delete the album</th>
                  </tr>
                </thead>
                <tbody>


                    @foreach ($albums as $album)
                 <tr>
                       <th scope="row">{{ $album->id }}</th>
                       <td>{{ $album->name }}</td>
                       <td><a href="/edit/{{ $album->id }}" class="btn btn-outline-primary">Update</a></td>
                       <td>
                           <form action="/delete/{{ $album->id }}" method="post">
                            <button class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete the album and pictures? ?');" type="submit">Delete Album and Pictures </button>
                            @csrf
                            @method('delete')
                        </form>
</td>
                        <td>
                           <form action="/deletepictures/{{ $album->id }}" method="post">
                            <button class="btn btn-outline-danger" onclick="return confirm('Only the album will be deleted and the pictures will be moved to another album?');" type="submit">Just delete the album</button>
                            @csrf
                            @method('delete')
                        </form>
                       </td>

                   </tr>
                   @endforeach

                </tbody>
              </table>
        </div>




    </body>
</html>
