<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Template</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
      .maintxt {
        <img src="{{ public_path().'/images/tsm.png'}}" width="80" height="80"/>
          background-image: url(images/background.png);
          background-size: cover;
      }
    </style>
  </head>
  <body>
    <button class="btn btn-info"> TEST</button>
    <hr>
    <div class="row">
      <div class="col-xs-1-12">
        <div class="card">
          <div class="card-header">
            Test
          </div>
          <div class="card-body bg-info">
            <div class="maintxt">
              My great text.
            </div>
            <h3 class="card-title">Title</h3>
            <p class="card-text">Text</p>
          </div>
          <div class="card-footer">
            Test
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
  </body>
</html>