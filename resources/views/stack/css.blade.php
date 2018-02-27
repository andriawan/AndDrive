@if (App::environment('local'))
  
  @push('global-styles')
    <link rel="stylesheet" href="vendor/bootstrap/v4/css/bootstrap.min.css"></script>
    <link rel="icon" href="drive.png">
  @endpush

  @push('custom-css')
    <link rel="stylesheet" href="css/styles.css"></script>
  @endpush

@else

  @push('global-styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" href="drive.png">
  @endpush

  @push('custom-css')
    <link rel="stylesheet" href="css/styles.css"></script>
  @endpush

@endif