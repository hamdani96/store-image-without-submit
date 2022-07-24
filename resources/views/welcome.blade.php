<html>
<head>
  <title></title>

  <meta name="csrf-token" content="{{csrf_token()}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

</head>
<body>

<div class="container">
    <div class="col-12">
        @foreach ($user as $item)
            <img src="{{ asset('storage/images/'. $item->image) }}" style="width: 100px" alt="">
        @endforeach
    </div>
    <div class="col-12">
        <form action="{{ route('store') }}" method="post"> @csrf
            <div class="row">
                <input type="hidden" name="user_id" id="user_id">
                <div class="form-group col-md-12">
                    <label for="">Nama</label>
                    <input type="text" name="name" id="" class="form-control">
                </div>
                <div class="col-12">
                  <label>Image upload</label>
                  <input type="file" name="image" id="img_file_upid">

                  <span id="error"></span>
                  <img id="img_prv" style="max-width: 150px;max-height: 150px" class="img-thumbnail" src="https://pertaniansehat.com/v01/wp-content/uploads/2015/08/default-placeholder.png">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>



<script type="text/javascript">
$('#img_file_upid').on('change',function(ev){
    console.log("here inside");

    var filedata=this.files[0];
    var imgtype=filedata.type;

    //---image preview

    var reader=new FileReader();

    reader.onload=function(ev){
      $('#img_prv').attr('src',ev.target.result).css('width','150px').css('height','150px');
    }
    reader.readAsDataURL(this.files[0]);
    /// preview end
    //upload

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // var user_id = document.getElementById('user_id').value;

    var postData=new FormData();
    postData.append('file',this.files[0]);

    var url="{{url('ajaxuploadimg')}}";

    $.ajax({
        async:true,
        type:"post",
        contentType:false,
        url:url,
        data:postData,
        processData:false,
        success:function(response){
            console.log(response.users);
            // $('#user_id').val(response.users.id);
        }
    });

});

</script>

</body>
</html>
