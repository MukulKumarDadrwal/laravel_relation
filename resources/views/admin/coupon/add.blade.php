<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <!-- Select2 CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
  <h2>Coupon add form</h2>
  <form action="{{route('submit_coupon')}}" method="post">
    @csrf
    <div class="form-group">
      <label for="code">Code:</label>
      <input type="text" class="form-control" id="code" placeholder="Enter code" name="code">
      @error('code')
       <span>{{$message}}</span>
      @enderror
    </div>
    <div class="form-group">
      <label for="sel1">Select type:</label>
      <select class="form-control" name="type" id="type">
        <option value="normal"  id="normal">Normal</option>
        <option value="product_wise" id="pro_wise">product wise</option>
        <option value="category_wise">category wise</option>
        <option value="user_wise">user wise</option>
      </select>
      @error('type')
       <span>{{$message}}</span>
      @enderror
    </div>
     <!-- Multiselect dropdowns -->
     <div class="form-group" id="product_id" style="display: none">
      <label for="pro_id[]">Product:</label>
      <select class="form-control select2-multi" name="pro_id[]"  multiple="multiple">
        @foreach($products as $product)
          <option value="{{$product->id}}">{{$product->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group" id="category_id" style="display: none;">
      <label for="category_id">Category:</label>
      <select class="form-control select2-multi" name="cat_id[]" multiple="multiple">
        @foreach($categories as $category)
          <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group" id="user_id" style="display: none;">
      <label for="user_id">User:</label>
      <select class="form-control select2-multi" name="user_id[]" multiple="multiple">
        @foreach($users as $user)
          <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
      </select>
    </div>
    <!-- Add other form fields -->

    <div class="form-group">
      <label for="sel1">Select Amount type:</label>
      <select class="form-control" name="amount_type" id="amount_type">
        <option value="flate" >Flate</option>
        <option value="percentage">percentage</option>
      </select>
    </div>
    
    <div class="form-group">
      <label for="amount">Amount:</label>
      <input type="number" class="form-control" id="amount" placeholder="Enter amount" name="amount">
    </div>
    <div class="form-group" id="min_amount" >
      <label for="pro_min_amount">Min. Amount of Product:</label>
      <input type="number" class="form-control" id="pro_min_amount" placeholder="Enter pro_min_amount" name="pro_min_amount">
    </div>
    <div class="form-group">
      <label for="max_uses">MAX. uses:</label>
      <input type="number" class="form-control" id="max_uses" placeholder="Enter max_uses" name="max_uses">
    </div>


    <div class="form-group">
      <label for="start_at">Start_at:</label>
      <input type="datetime-local" class="form-control" id="start_at" placeholder="Enter start date" name="start_at">
    </div>
    <div class="form-group">
      <label for="expire_at">Expire At:</label>
      <input type="datetime-local" class="form-control" id="expire_at" placeholder="Enter amount" name="expire_at">
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

<!-- Include jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Select2 JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- JavaScript to initialize Select2 -->
<script>
$(document).ready(function() {

  $('#type').change(function(){
      if($(this).val() == "product_wise"){
        $('#product_id').show();
         $('#category_id').hide();
         $('#user_id').hide();
         $('.select2-multi').select2({
            closeOnSelect: false // Keeps the dropdown open after selection
         });
      }
      else if($(this).val() == "category_wise"){
        $('#category_id').show();
        $('#product_id').hide();
        $('#user_id').hide();
        $('.select2-multi').select2({
          closeOnSelect:false
        })
      }
      else if($(this).val() == "user_wise"){
        $('#user_id').show();
        $('#product_id').hide();
        $('#category_id').hide();
        $('.select2-multi').select2({
           closeOnSelect:false
        });
      }else{
        $('#user_id').hide();
        $('#product_id').hide();
        $('#category_id').hide();
        $('.select2-multi').select2({
          closeOnSelect:false
        })
      }
    });




    $('#amount_type').change(function(){
      if($(this).val() == "flate"){
        $('#min_amount').show();
      }else{
        $('#min_amount').hide();
      }
    });

   
});
</script>
</body>
</html>
