Calls = {
  test: function()
  {
    console.log('is clicked yeh.');
  },
  request: function()
  {
    $.ajax({
      type:'POST',
      url:'http://localhost/bridges/wister/alpha',
      dataType:'JSON',
      data:
      {
        table:$('#table').val(),
        column:$('#column').val(),
        colval:$('#colval').val(),
        func:$('#func').val(),
        date:$('#date').val(),
        start_date:$('#datepicker-start').val(),
        end_date:$('#datepicker-end').val()
      },
      success: function(data)
      {
        console.log(data);
      }
    });
  },
  click_events: function()
  {
    $('#send_date').on('click', function(){
      Calls.request();
      // Calls.test();
    });
  }
}