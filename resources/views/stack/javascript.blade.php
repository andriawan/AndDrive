@if (App::environment('local'))
  
  @push('global-scripts')
    <script src="vendor/jquery/v2/jquery-2.1.4.js"></script>
    <script src="vendor/bootstrap/v4/js/bootstrap.min.js"></script>
  @endpush

  @push('custom-js')
    <script>
      $(document).ready(
        function () 
        {
          if ($('#fileupload').prop('files').length == 0) {
            $('#submit-local').attr('disabled','true');
          }  
        }

      );

      $('#fileupload').change(
        function()
        {
          $('#label-upload').text($('#fileupload').prop('files')[0].name);
          $('#submit-local').removeAttr('disabled');
        }
      );

      $('#submit-local').click(
        function()
        {
          var formData = new FormData($('#local-form'));
          $.ajax(
            {
              url: '{{ route('local_upload') }}',
              headers: 
              {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              type: 'POST',
              data: $('#fileupload').prop('files'),
              success: 
              function(res) 
              {
                console.log(res);
                console.log("cvcv");
              },
              error: 
              function(xhr,status,error)
              {
                console.log(xhr);
                console.log(status);
                console.log(error);
              }
            }

          );
        }
      );

    </script>
  @endpush

@else

  @push('global-scripts')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  @endpush

@endif