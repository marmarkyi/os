@extends('frontendtemplate')
@section('sidebar')
@include('frontend.sidebar')

@endsection

@section('content')
	<div class="col-lg-9">
        <h2>Item Page Filter By brand and subcategory</h2>
        <div id="myItems" class="row">
          
        </div>
	
	</div>
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function () {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      showItems(0);
      
      function showItems(id) {
        $.post("{{route('getitems')}}",{sid:id},function (response) {
        // console.log(response);
        var html ='';
        $.each(response,function (i,v) {
          var url = '/itemdetail/'+v.id;
          html +=`<div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
          <img src="${v.photo}" alt="" class="card-img-top">
          <div class="card-body">
          <h4 class="card-title">
          <a href="#">${v.name}</a>
          </h4>
          <h5>${v.price} MMK</h5>
          <p class="card-text">${v.description}</p>
          </div>
          <div class="card-footer">
          <a href="#" class="btn btn-info btn-sm cart" data-id="${v.id}" data-name="${v.name}" data-photo="${v.photo}" data-price="${v.price}" data-discount="${v.discount}">Add To Card</a>
          <a href="${url}" class="btn btn-info btn-sm " >Detail</a>
          </div>
          </div>
          </div>`
        })
        $('#myItems').html(html);
      })
      }


      $('.filter').click(function () {
        var id = $(this).data('id');
        var name = $(this).data('name');
        showItems(id);
      })
      
    })
  </script>

  <script type="text/javascript" src="{{asset('frontend/js/script.js')}}"></script>
@endsection