Calls = {
  test: function()
  {
    console.log('is clicked yeh.');
  },
  request: function()
  {
    $.ajax({
      type:'GET',
      url:'http://localhost/bms/suffer/search',
      dataType:'JSON',
      data: $('#search-form').serialize(),
      success: function(data)
      {
        console.log(data);
        if(data.length != 0)
          Calls.data_results_formatter(data);
      }
    });
  },
  data_results_formatter: function(data)
  {
    var tableArray = [];
    for(var i=0; i < data.length; i++)
    {
        tableArray.push('<tr>');
        tableArray.push('<td>'+ data.ac_no +'</td>');
        tableArray.push('<td>'+ data.log_time +'</td>');
        tableArray.push('<td>'+ data.log_type +'</td>');
        tableArray.push('</tr>');
    }
    $('#results-data').html(tableArray.join(''));
  },
  click_events: function()
  {
    $('#submit-form').on('click', function(e){
      e.preventDefault();
      Calls.request();
    });
  }
}
