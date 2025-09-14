<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Form Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body class="container">
   <form action="#" method="post" class="row g-3">
  <div class="col-md-6">
    <label for="inputFirstName" class="form-label">First Name</label>
    <input type="name" name="First Name" class="form-control" id="inputFirstName">
  </div>
  <div class="col-md-6">
    <label for="inputLastName" class="form-label">Last Name</label>
    <input type="name" name="Last Name" class="form-control" id="inputLastName">
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" name="address" class="form-control" id="inputAddress">
  </div>
  <div class="col-md-6">
    <label for="inputCity" class="form-label">City</label>
    <input type="text" name="city" class="form-control" id="inputCity">
  </div>
  <div class="col-md-4">
    <label for="inputState" class="form-label">State</label>
    <select id="inputState" name="state" class="form-select">
      <option>Arizona</option>
      <option>Maine</option>
      <option selected>Michigan</option>
      <option>Nevada</option>
      <option>Utah</option>
    </select>
  </div>
  <div class="col-md-2">
    <label for="inputZip" class="form-label">Zip</label>
    <input type="text" name="zip" class="form-control" id="inputZip">
  </div>
  <div class="col-md-6">
    <label for="inputPhone" class="form-label">Phone</label>
    <input type="text" name="Phone" class="form-control" id="inputPhone">
  </div>
  <div class="col-md-6">
    <label for="inputEmail" class="form-label">Email</label>
    <input type="text" name="Email" class="form-control" id="inputEmail">
  </div>
  <p>Preferred Method of Contact</p>
  <div class="col-md-1">
    <div class="form-check">
      <input class="form-check-input" name="Email" type="radio" id="Email">
      <label class="form-check-label" for="Email">
        Email
      </label>
    </div>
  </div>
  <div class="col-md-11">
      <input class="form-check-input" name="Text" type="radio" id="Text">
        <label class="form-check-label" for="Text">
         Text
        </label>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Sign in</button>
  </div>
</form>
</body>
</html>