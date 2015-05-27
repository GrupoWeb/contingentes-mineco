<select name="{{ $nombre }}" class="selectpicker form-control" id="{{ $id }}">
  @foreach($contingentes as $contingente)
    <option value="{{ Crypt::encrypt($contingente->contingenteid) }}">{{ $contingente->producto }}</option>
  @endforeach
</select>

<script type="text/javascript">
  $(function() {
    $('.selectpicker').selectpicker();

    $('#{{ $id }}').change(function() {
      $.get('utilizacion/empresas/' + $(this).find('option:selected').val(), function(data){
        $('#empresadiv').html(data);
      });
    });

    $('#{{ $id }}').change();
  });
</script>